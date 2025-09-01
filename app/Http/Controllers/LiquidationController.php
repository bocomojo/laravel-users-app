<?php

namespace App\Http\Controllers;

use App\Models\Liquidation;
use Illuminate\Http\Request;
use App\Models\Sdo;
use App\Models\CashAdvance;
use App\Models\PreAuditor;
use App\Exports\LiquidationsExport;
use App\Models\LiquidationActivity;
use App\Exports\CondensedLiquidationExport;
use App\Models\PreAuditorLiquidationEntry;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LiquidationImport;
use Illuminate\Support\Facades\DB;

class LiquidationController extends Controller
{
    public function condensedExport(Request $request)
    {
        $query = Liquidation::query();

        if ($request->filled('type')) {
            $query->where('liquidation_type', $request->type);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('liq_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('liq_date', '<=', $request->date_to);
        }

        if ($request->filled('received_date_from')) {
            $query->whereDate('liq_date_received', '>=', $request->received_date_from);
        }

        if ($request->filled('received_date_to')) {
            $query->whereDate('liq_date_received', '<=', $request->received_date_to);
        }

        if ($request->filled('sdo_name')) {
            $query->where('sdo_name', 'like', '%' . $request->sdo_name . '%');
        }

        if ($request->filled('number')) {
            $query->where(function ($q) use ($request) {
                $q->where('check_number', 'like', '%' . $request->number . '%')
                    ->orWhere('liq_number', 'like', '%' . $request->number . '%');
            });
        }

        $liquidations = $query->with(['cashAdvance', 'cashAdvance.sdo', 'cashAdvance.pap'])->get();

        return Excel::download(new CondensedLiquidationExport($liquidations), 'condensed_liquidation.xlsx');
    }

    public function export($cashAdvanceId)
    {   
        return Excel::download(new LiquidationsExport($cashAdvanceId), 'liquidation.xlsx');
    }

    public function exportTransmittal()
    {
        // Example logic: export to Excel or PDF
        return response()->json(['message' => 'Export not yet implemented']);
    }

    public function assignSack(Request $request)
    {
        $request->validate([
            'sack_number' => 'required|string',
            'liq_numbers' => 'required|array',
        ]);

        foreach ($request->liq_numbers as $liq_number) {
            DB::table('sack_assignment')->updateOrInsert(
                ['liq_number' => $liq_number],
                ['sack_number' => $request->sack_number, 'updated_at' => now(), 'created_at' => now()]
            );
        }

        return redirect()->back()->with('success', 'Sack number assigned successfully.');
    }

    public function bulkTransmit()
    {
        DB::table('liquidation')
            ->where('status', '!=', 'Transmitted')
            ->update(['status' => 'Transmitted']);

        return redirect()->back()->with('success', 'All visible liquidations marked as Transmitted.');
    }

    public function index(Request $request)
    {
        $query = Liquidation::with([
            'cashAdvance',
            'cashAdvance.sdo',
            'cashAdvance.pap',
            'preAuditEntries',
            'preAuditor',
        ]);

        if ($request->filled('type')) {
            $query->where('liquidation_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('liq_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('liq_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('sdo_name', 'like', "%{$search}%")
                    ->orWhere('liq_number', 'like', "%{$search}%")
                    ->orWhere('liq_date_received', 'like', "%{$search}%")
                    ->orWhere('check_number', 'like', "%{$search}%");
            });
        }

        $liquidations = $query->latest()->paginate(15)->appends($request->query());

        // ✅ Override status ONLY IF it's still in progress (not already Approved or Completed)
        foreach ($liquidations as $liq) {
            if (in_array($liq->status, ['For Checking', 'Processing'])) {
                if ($liq->status === 'For Checking' && $liq->preAuditEntries->isNotEmpty()) {
                    $liq->status = 'Processing';
                }

                $totalPreAudit = $liq->preAuditEntries->sum('amount');
                $expectedTotal = abs($liq->for_liquidation_amount);
                $complianceAmount = $liq->for_compliance_amount ?? 0;

                if (abs($totalPreAudit + $complianceAmount - $expectedTotal) < 0.01) {
                    $liq->status = 'For Approval';
                }
            }
            if (!empty($liq->jev_no) && $liq->status !== 'For Transmittal') {
                $liq->status = 'For Transmittal';
                $liq->save();
            }
        }

        $sdos = Sdo::orderBy('name')->get();

        return view('liquidation.index', compact('liquidations', 'sdos'));
    }

    public function show($id, Request $request)
    {
        $cashAdvance = CashAdvance::with(['sdo', 'liquidation'])->findOrFail($id);

        $liquidations = Liquidation::where('cash_advance_id', $cashAdvance->id)
            ->whereIn('status', ['Approved', 'For Transmittal', 'Transmitted'])
            ->when($request->filled('type'), fn($q) => $q->where('liquidation_type', $request->type))
            ->orderBy('created_at', $request->get('sort', 'desc'))
            ->get();

        return view('liquidation.show', [
            'cashAdvance' => $cashAdvance,
            'liquidations' => $liquidations,
            'sortOrder' => $request->get('sort', 'desc'),
            'filterType' => $request->get('type'),
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            $import = new LiquidationImport();
            Excel::import($import, $request->file('import_file'));

            $skipped = $import->getSkipped();

            if (!empty($skipped)) {
                return redirect()
                    ->route('liquidation.index')
                    ->with([
                        'warning' => 'Some liquidations were skipped because no matching Cash Advance was found or the related CA is Cancelled.',
                        'skippedLiquidations' => $skipped,
                    ]);
            }

            return redirect()
                ->route('liquidation.index')
                ->with([
                    'success' => 'All liquidations imported successfully.'
                ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'import_error' => 'Import failed: ' . $e->getMessage()
            ]);
        }
    }

    public function markComplete(Liquidation $liquidation)
    {
        $liquidation->update(['status' => 'Completed']);
        return back()->with('success', 'Marked as completed.');
    }

    public function updateJev(Request $request, $id)
    {
        $request->validate([
            'jev_no' => 'required|string|max:255',
        ]);

        $liquidation = \App\Models\Liquidation::findOrFail($id);
        $liquidation->jev_no = $request->jev_no;
        $liquidation->save();

        \App\Models\LiquidationActivity::create([
            'liquidation_id' => $liquidation->id,
            'user_id' => auth()->id(),
            'action' => $liquidation->jev_no ? 'JEV Updated' : 'JEV Added',
            'details' => "JEV number set to {$liquidation->jev_no}",
        ]);

        return response()->json([
            'success' => true,
            'jev_no' => $liquidation->jev_no
        ]);
    }

    public function markForApproval($id)
    {
        $liq = \App\Models\Liquidation::findOrFail($id);

        if ($liq->status === 'Draft') {
            $entries = $liq->preAuditEntries;

            $totalComplied = $entries->sum('amount');
            $totalCompliance = $entries->sum('for_compliance');
            $totalCombined = $totalComplied + $totalCompliance;
            $expectedAmount = abs($liq->for_liquidation_amount);

            if ($entries->isEmpty()) {
                $liq->status = 'For Checking';
            } elseif (round($totalCombined, 2) === round($expectedAmount, 2)) {
                $liq->status = 'For Approval';
            } else {
                $liq->status = 'Processing';
            }

            $liq->pre_audited_amount = $totalComplied;
            $liq->for_compliance_amount = $totalCompliance;
            $liq->save();

            \App\Models\LiquidationActivity::create([
                'liquidation_id' => $liq->id,
                'user_id' => auth()->id(),
                'action' => 'Marked as Done',
                'details' => "Status changed to {$liq->status}",
            ]);
        }

        return redirect()->back()->with('success', 'Marked as ' . $liq->status . '.');
    }

    public function create(Request $request)
    {
        $cashAdvance = null;

        $preAuditors = PreAuditor::withSum(['liquidation' => function ($query) {
            $query->where('status', 'For Checking');
        }], 'for_liquidation_amount')
            ->get()
            ->sortBy(function ($auditor) {
                return abs($auditor->liquidation_sum_for_liquidation_amount ?? 0);
            });

        if ($request->has('cash_advance_id')) {
            $cashAdvance = CashAdvance::with('sdo')->findOrFail($request->get('cash_advance_id'));
            $sdoList = collect([$cashAdvance->sdo]);
        } else {
            $sdoList = Sdo::orderBy('name')->get();
        }

        return view('liquidation.create', compact('cashAdvance', 'sdoList', 'preAuditors'));
    }

    public function approve($id)
    {
        $liq = \App\Models\Liquidation::findOrFail($id);

        $liq->status = 'Approved';

        // Only set liq_date if it's currently null
        if (is_null($liq->liq_date)) {
            $liq->liq_date = now(); // or Carbon::now() if not using the global helper
        }

        $liq->save();

        \App\Models\LiquidationActivity::create([
            'liquidation_id' => $liq->id,
            'user_id' => auth()->id(),
            'action' => 'Approved',
            'details' => 'Status changed to Approved by button click',
        ]);

        return redirect()->back()->with('success', 'Liquidation marked as Approved.');
    }

    public function forTransmittal(Request $request)
    {
        $search = $request->input('search');

        $liquidations = Liquidation::where('status', 'For Transmittal')
            ->when($search, function ($query, $search) {
                $query->where('liq_number', 'like', "%{$search}%")
                    ->orWhere('sdo_name', 'like', "%{$search}%");
            })
            ->get();

        return view('liquidation.for-transmittal', compact('liquidations'));
    }

    public function getNextLrNumber()
    {
        $currentYear = now()->format('y'); 
        $currentMonth = now()->format('m');

        // ✅ Always get the highest liq_number regardless of year/month
        $latest = Liquidation::where('liquidation_type', 'Liquidation')
            ->orderByDesc('id')
            ->lockForUpdate()
            ->pluck('liq_number')
            ->first();

        if ($latest) {
            $lastNumber = intval(substr($latest, -5)); // extract last 5 digits
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001';
        }

        return response()->json([
            'next_number' => "L-{$currentYear}-{$currentMonth}-{$newNumber}"
        ]);
    }

    public function store(Request $request)
    {
        $isRefund = $request->input('liquidation_type') === 'Refund';

        $rules = [
            'cash_advance_id' => 'nullable|exists:cash_advance,id',
            'sdo_id' => 'required|exists:sdo,id',
            'check_number' => 'required|string|max:255',
            'granted_amount' => 'required|numeric|min:0',
            'for_liquidation_amount' => 'required|numeric|min:0',
            'liquidation_type' => 'required|string|max:255',
            'liq_date_received' => 'nullable|date',
        ];

        if ($isRefund) {
            $rules['or_number'] = 'required|string|max:255';
            $rules['or_date'] = 'required|date';
        }

        $validated = $request->validate($rules);

        // ✅ Generate liq_number only for Liquidation (not Refund)
        if (!$isRefund) {
            $currentYear = now()->format('y');   // e.g. 25
            $currentMonth = now()->format('m');  // e.g. 09

            // ✅ Always get the highest liq_number regardless of year/month
            $latest = Liquidation::where('liquidation_type', 'Liquidation')
                ->orderByDesc('id')
                ->lockForUpdate()
                ->pluck('liq_number')
                ->first();

            if ($latest) {
                $lastNumber = intval(substr($latest, -5)); // last 5 digits
                $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '00001';
            }

            $validated['liq_number'] = "L-{$currentYear}-{$currentMonth}-{$newNumber}";
            $validated['liq_date'] = now();
        } else {
            $validated['liq_number'] = null;
            $validated['liq_date'] = null;
        }

        $sdo = Sdo::findOrFail($validated['sdo_id']);
        $validated['sdo_name'] = $sdo->name;
        $validated['pre_audited_amount'] = $validated['for_liquidation_amount'] + $request->input('for_compliance_amount', 0);
        $validated['status'] = $isRefund ? 'Approved' : 'For Checking';

        if ($request->has('pre_auditor')) {
            $auditor = PreAuditor::find($request->pre_auditor);
            $validated['pre_auditor'] = $auditor?->name ?? null;
        }

        $liquidation = Liquidation::create($validated);

        if ($request->filled('pre_auditor')) {
            $liquidation->preAuditors()->sync([$request->pre_auditor]);
        }

        if ($validated['cash_advance_id']) {
            $cashAdvance = CashAdvance::with('liquidation')->find($validated['cash_advance_id']);
            $totalPreAudited = $cashAdvance->liquidation->sum('pre_audited_amount');

            $cashAdvance->status = round($totalPreAudited, 2) == round($cashAdvance->granted_amount, 2)
                ? 'Fully Liquidated'
                : 'Ongoing';
            $cashAdvance->save();
        }

        return redirect()->route('liquidation.index')->with('success', 'Liquidation added successfully.');
    }

        public function getOngoingCashAdvance($sdoId)
        {
            $cashAdvances = CashAdvance::where('sdo_id', $sdoId)
                ->where('status', 'Ongoing')
                ->get();

            if ($cashAdvances->isEmpty()) {
                return response()->json(['status' => 'none']);
            }

            if ($cashAdvances->count() > 1) {
                return response()->json(['status' => 'multiple']);
            }

            $cashAdvance = $cashAdvances->first();

            return response()->json([
                'status' => 'single',
                'data' => [
                    'id' => $cashAdvance->id,
                    'check_number' => $cashAdvance->check_number,
                    'granted_amount' => $cashAdvance->granted_amount,
                ]
            ]);
        }

        public function setAsDraft($id)
        {
            $liquidation = \App\Models\Liquidation::findOrFail($id);

            if (in_array($liquidation->status, ['Approved', 'For Approval', 'For Checking', 'Processing'])) {
                $previousStatus = $liquidation->status;

                $liquidation->status = 'Draft';
                $liquidation->save();

                LiquidationActivity::create([
                    'liquidation_id' => $liquidation->id,
                    'user_id' => auth()->id(),
                    'action' => 'Draft',
                    'details' => "Status changed to Draft from {$previousStatus}",
                ]);

                return redirect()->back()->with('success', 'Liquidation set as Draft.');
            }

            return redirect()->back()->with('error', 'Cannot set as Draft from current status.');
        }

        public function edit($id)
        {
            $liquidation = Liquidation::findOrFail($id);
            $sdo = Sdo::where('name', $liquidation->sdo_name)->first();

            return view('liquidation.edit', compact('liquidation', 'sdo'));
        }

        public function update(Request $request, $id)
{
    $liquidation = Liquidation::findOrFail($id);

    $rules = [
        'for_liquidation_amount' => 'required|numeric',
        'for_compliance_amount' => 'nullable|numeric|min:0',
        'liquidation_type' => 'required|string|max:255',
        'liq_date_received' => 'required|date',
    ];

    if ($request->input('liquidation_type') === 'Refund') {
        $rules['or_number'] = 'required|string|max:255';
        $rules['or_date'] = 'required|date';
        $rules['liq_number'] = 'nullable|string|max:255';
        $rules['liq_date'] = 'nullable|date';
    } else {
        $rules['liq_number'] = 'required|string|max:255';
        $rules['liq_date'] = 'required|date';
    }

    $validated = $request->validate($rules);

    if ($validated['liquidation_type'] === 'Refund') {
        $validated['liq_number'] = null;
        $validated['liq_date'] = null;
    } else {
        $validated['or_number'] = null;
        $validated['or_date'] = null;
    }

    // ⛔ Manually entered values only — no syncing with pre-audit entries
    $validated['pre_audited_amount'] = $validated['for_liquidation_amount'] + ($validated['for_compliance_amount'] ?? 0);

    $liquidation->update($validated);

    if ($liquidation->cash_advance_id) {
        $cashAdvance = CashAdvance::with('liquidation')->find($liquidation->cash_advance_id);
        $totalPreAudited = $cashAdvance->liquidation->sum('pre_audited_amount');

        $cashAdvance->status = round($totalPreAudited, 2) == round($cashAdvance->granted_amount, 2) ? 'Fully Liquidated' : 'Ongoing';
        $cashAdvance->save();
    }
    LiquidationActivity::create([
            'liquidation_id' => $liquidation->id,
            'user_id' => auth()->id(),
            'action' => 'Approved',
            'details' => 'Status changed to Approved',
        ]);

    return redirect()->route('liquidation.index', $liquidation->cash_advance_id)
                     ->with('success', 'Liquidation updated successfully.');
}

        public function destroy($id)
        {
            $liquidation = Liquidation::findOrFail($id);
            $cashAdvanceId = $liquidation->cash_advance_id;
            $liquidation->delete();

            if ($cashAdvanceId) {
                $cashAdvance = CashAdvance::with('liquidation')->find($cashAdvanceId);
                $totalPreAudited = $cashAdvance->liquidation->sum('pre_audited_amount');

                $cashAdvance->status = round($totalPreAudited, 2) == round($cashAdvance->granted_amount, 2) ? 'Fully Liquidated' : 'Ongoing';
                $cashAdvance->save();
            }

            return redirect()->route('liquidation.show', $cashAdvanceId)
                            ->with('success', 'Liquidation deleted successfully.');
        }
    }
