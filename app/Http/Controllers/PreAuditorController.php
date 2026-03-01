<?php

namespace App\Http\Controllers;

use App\Models\{PreAuditor, Liquidation, PreAuditorLiquidationEntry};
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PreAuditorImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ComplianceFileSubmitted;
use App\Models\LiquidationActivity;


class PreAuditorController extends Controller
{
    public function index()
    {

        $preAuditors = PreAuditor::all();
        $pre_auditors = PreAuditor::with('user')->get();
        return view('pre_auditors.index', compact('preAuditors','pre_auditors'));
    }

    public function create()
    {
        if (!auth()->user()->hasAnyRole(['admin', 'reporting', 'verifier'])) {
            abort(403);
        }
        return view('pre_auditors.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['admin', 'reporting', 'verifier'])) {
            abort(403);
        }
        if ($request->hasFile('file')) {
            Excel::import(new PreAuditorImport, $request->file('file'));
            return back()->with('success', 'Pre-Auditors imported successfully.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PreAuditor::create(['name' => $request->name]);

        return back()->with('success', 'Pre-Auditor added successfully.');
    }

    public function edit(PreAuditor $preAuditor)
    {
        if (!auth()->user()->hasAnyRole(['admin', 'reporting', 'verifier'])) {
            abort(403);
        }
        return view('pre_auditors.edit', compact('preAuditor'));
    }

    public function showLiquidations($id)
{
    // Eager load auditor with relations
    $auditor = PreAuditor::with(['liquidations.preAuditEntries.preAuditor'])->findOrFail($id);

    // Sort liquidations: Completed at the bottom
    $liquidations = $auditor->liquidations
        ->sortBy(function ($liq) {
            return $liq->status === 'Completed' ? 1 : 0;
        })
        ->values();

    // Time frames for summary totals
    $yesterday = Carbon::yesterday();
    $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
    $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
    $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
    $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

    // Totals (still basic sums)
    $yesterdayTotal = $auditor->preAuditEntries()
        ->whereDate('created_at', $yesterday)
        ->sum(DB::raw('amount + for_compliance'));

    $lastWeekTotal = $auditor->preAuditEntries()
        ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
        ->sum(DB::raw('amount + for_compliance'));

    $lastMonthTotal = $auditor->preAuditEntries()
        ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
        ->sum(DB::raw('amount + for_compliance'));

    // Filters
    $startDate = request('start_date');
    $endDate   = request('end_date');
    $search    = request('search');

    $filteredEntries = collect();
    $grandTotalBalance = 0;

    // Base query for liquidations (always tied to this auditor)
    $query = Liquidation::whereHas('preAuditEntries', function ($q) use ($auditor) {
        $q->where('pre_auditor_id', $auditor->user_id);
    });

    // Apply date filter
    if ($startDate && $endDate) {
        $query->whereHas('preAuditEntries', function ($q) use ($auditor, $startDate, $endDate) {
            $q->where('pre_auditor_id', $auditor->user_id)
              ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        });
    }

    // Apply search filter
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('liq_number', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
        });
    }

    // Fetch filtered liquidations with entries
    $filteredLiquidations = $query->with(['preAuditEntries' => function ($q) use ($auditor, $startDate, $endDate) {
        $q->where('pre_auditor_id', $auditor->user_id)
          ->orderBy('created_at');

        if ($startDate && $endDate) {
            $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
    }])->get();

    // Group filtered entries and calculate balances
    if ($filteredLiquidations->isNotEmpty()) {
        $filteredEntries = $filteredLiquidations->flatMap(fn($liq) => $liq->preAuditEntries)
            ->groupBy(fn($entry) => $entry->liquidation->liq_number)
            ->map(function ($group) use (&$grandTotalBalance) {
                $liqRunningBalance = 0;
                $liqTotal = 0;
                $liqCompliance = 0;

                $group = $group->sortBy('created_at')->map(function ($entry) use (&$liqRunningBalance, &$liqTotal, &$liqCompliance) {
                    $isCompliance = $entry->for_compliance > 0;
                    $displayAmount = $isCompliance ? $entry->for_compliance : $entry->amount;
                    $liqRunningBalance += $isCompliance ? -$displayAmount : $displayAmount;
                    $liqTotal += $entry->amount;
                    $liqCompliance += $entry->for_compliance;

                    return [
                        'entry' => $entry,
                        'displayAmount' => $displayAmount,
                        'typeLabel' => $isCompliance ? 'For Compliance' : 'Pre-Audited',
                        'textColor' => $isCompliance ? 'text-yellow-600' : 'text-green-600',
                        'liqRunningBalance' => $liqRunningBalance
                    ];
                });

                $grandTotalBalance += $liqRunningBalance;

                return [
                    'entries' => $group,
                    'liqTotal' => $liqTotal,
                    'liqCompliance' => $liqCompliance,
                    'liqRunningBalance' => $liqRunningBalance
                ];
            });
    }

    // Default liquidations for display when no filters applied
    $auditorLiquidations = $liquidations->filter(function ($liq) use ($auditor) {
        return $liq->preAuditEntries->where('pre_auditor_id', $auditor->id)->count() > 0;
    });

    return view('pre_auditors.liquidations', compact(
        'auditor',
        'liquidations',
        'yesterdayTotal',
        'lastWeekTotal',
        'lastMonthTotal',
        'startDate',
        'endDate',
        'search',
        'filteredEntries',
        'grandTotalBalance',
        'auditorLiquidations',
        'filteredLiquidations',
    ));
}

public function addEntry(Request $request)
{
    // ✅ Normalize arrays before validation
    if ($request->boolean('for_compliance')) {
        $preAuditors = array_values(array_filter((array) $request->input('pre_auditors')));
        $amounts = array_values(array_filter((array) $request->input('amounts')));
        $request->merge([
            'pre_auditors' => $preAuditors,
            'amounts' => $amounts,
        ]);
    }

    // --- Validation rules ---
    $baseRules = [
        'liquidation_id'  => 'required|exists:liquidation,id',
        'for_compliance'  => 'required|boolean',
        'supporting_file' => 'required_if:for_compliance,1|file|mimes:pdf,jpg,jpeg,png|max:10048',
    ];

    if ($request->boolean('for_compliance')) {
        $baseRules['pre_auditors']   = 'required|array|min:1';
        $baseRules['pre_auditors.*'] = 'exists:users,id';
        $baseRules['amounts']        = 'required|array|min:1';
        $baseRules['amounts.*']      = 'numeric|min:0.01';
    } else {
        $baseRules['amount'] = 'required|numeric|min:0.01';
    }

    $validated = $request->validate($baseRules);

    // --- Load liquidation ---
    $liquidation = Liquidation::with(['preAuditEntries', 'cashAdvance.sdo'])
        ->findOrFail($request->liquidation_id);

    $liquidation->refresh();

    if ($liquidation->status === 'Draft') {
        return back()->with('error', 'Cannot add new entries while liquidation is in Draft status.');
    }
    
    $existingCompliance   = $liquidation->preAuditEntries->sum('for_compliance');
    $existingComplied     = $liquidation->preAuditEntries->sum('amount');
    $forLiquidationAmount = abs($liquidation->for_liquidation_amount);

    $currentTotal = $existingComplied + $existingCompliance;

    $newAmount = $request->boolean('for_compliance')
        ? array_sum($request->amounts)
        : $request->amount;

    if (round($currentTotal + $newAmount, 2) > round($forLiquidationAmount, 2)) {
        return back()->withErrors([
            'amount' => 'Total pre-audit entries exceed the liquidation amount.',
        ])->withInput();
    }

    // --- Handle file upload / deduplication ---
    $filePath = null;
    $originalName = null;

    if ($request->boolean('for_compliance') && $request->hasFile('supporting_file')) {
        $uploadedFile = $request->file('supporting_file');
        $uploadedName = $uploadedFile->getClientOriginalName();
        $uploadedSize = $uploadedFile->getSize();

        // ✅ Check for existing identical file in this liquidation
        $existingFile = PreAuditorLiquidationEntry::where('liquidation_id', $liquidation->id)
            ->whereNotNull('compliance_file')
            ->get()
            ->first(function ($entry) use ($uploadedFile, $uploadedName, $uploadedSize) {
                $path = storage_path('app/public/' . $entry->compliance_file);
                return file_exists($path)
                    && $entry->compliance_file_name === $uploadedName
                    && filesize($path) === $uploadedSize;
            });

        if ($existingFile) {
            // Reuse existing path
            $filePath = $existingFile->compliance_file;
            $originalName = $existingFile->compliance_file_name;
        } else {
            // Upload new
            $filePath = $uploadedFile->store('supporting_files', 'public');
            $originalName = $uploadedName;
        }
    }

    // ===============================
    // CASE 1: COMPLIED ENTRY
    // ===============================
    if (!$request->boolean('for_compliance')) {
        // $total = $existingComplied + $request->amount;
        // if ($total > $forLiquidationAmount) {
        //     return back()->withErrors([
        //         'amount' => 'Total pre-audited amount exceeds the liquidation amount.',
        //     ])->withInput();
        // }

        PreAuditorLiquidationEntry::create([
            'pre_auditor_id'        => auth()->id(),
            'liquidation_id'        => $request->liquidation_id,
            'amount'                => $request->amount,
            'for_compliance'        => 0.00,
            'compliance_file'       => null,
            'compliance_file_name'  => null,
        ]);

        $activityDetails = 'Complied Amount: ₱' . number_format($request->amount, 2);
    }

    // ===============================
    // CASE 2: FOR COMPLIANCE ENTRIES
    // ===============================
    else {
        $sumNewAmounts = array_sum($request->amounts);
        // $total = $existingCompliance + $sumNewAmounts;

        // if ($total > $forLiquidationAmount) {
        //     return back()->withErrors([
        //         'amounts' => 'Total for-compliance amount exceeds the liquidation amount.',
        //     ])->withInput();
        // }

        foreach ($request->pre_auditors as $index => $preAuditorId) {
            $amount = (float) ($request->amounts[$index] ?? 0);
            if ($amount <= 0) continue;

            PreAuditorLiquidationEntry::create([
                'pre_auditor_id'        => $preAuditorId,
                'liquidation_id'        => $request->liquidation_id,
                'amount'                => 0.00,
                'for_compliance'        => $amount,
                'compliance_file'       => $filePath,
                'compliance_file_name'  => $originalName,
            ]);
        }

        $activityDetails = 'For Compliance Total: ₱' . number_format($sumNewAmounts, 2);
    }

    // --- Update liquidation totals ---
    $liquidation->load('preAuditEntries');
    $totalComplied   = $liquidation->preAuditEntries->sum('amount');
    $totalCompliance = $liquidation->preAuditEntries->sum('for_compliance');
    $totalCombined   = $totalComplied + $totalCompliance;

    $liquidation->pre_audited_amount    = $totalComplied;
    $liquidation->for_compliance_amount = $totalCompliance;

    $forLiquidationAmount = abs($liquidation->for_liquidation_amount);

    if (round($totalCombined, 2) === round($forLiquidationAmount, 2)) {
        $liquidation->status = 'For Approval';
    } else {
        $liquidation->status = 'Processing';
    }

    $liquidation->save();

    // --- Log activity ---
    LiquidationActivity::create([
        'liquidation_id' => $liquidation->id,
        'user_id'        => auth()->id(),
        'action'         => 'Pre-Audit Entry Added',
        'details'        => $activityDetails,
    ]);

    // --- Send email for compliance ---
    if ($request->boolean('for_compliance') && $filePath) {
        $sdoEmail = optional($liquidation->cashAdvance->sdo)->email;
        if ($sdoEmail) {
            Mail::to($sdoEmail)->send(new ComplianceFileSubmitted($liquidation, $filePath));
        } else {
            \Log::warning("No email found for SDO of Liquidation ID {$liquidation->id}.");
        }
    }

    return back()->with('success', 'Pre-audit entry added and totals updated successfully.');
}
 
public function updateEntry(Request $request, $id)
{
    // =====================================================
    // LOAD ENTRY + RELATED LIQUIDATION
    // =====================================================
    $entry = PreAuditorLiquidationEntry::findOrFail($id);
    $liquidation = $entry->liquidation;

    $liquidation->refresh();

    if ($liquidation->status !== 'Draft') {
        return back()->with('error', 'Liquidation is no longer editable.');
    }

    $isCompliance = $entry->for_compliance > 0;
    $forLiquidationAmount = abs($liquidation->for_liquidation_amount);
    // =====================================================
    // VALIDATION
    // =====================================================
    if ($isCompliance) {

        $request->validate([
            'pre_auditor_id' => 'required|exists:users,id',
            'for_compliance' => 'required|numeric|min:0.01',
            'supporting_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10048',
        ]);

        $newAmount = (float) $request->for_compliance;

    } else {

        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $newAmount = (float) $request->amount;
    }

    // =====================================================
    // CALCULATE TOTALS EXCLUDING CURRENT ENTRY
    // =====================================================
    $existingComplied = $liquidation->preAuditEntries()
        ->where('id', '!=', $entry->id)
        ->sum('amount');

    $existingCompliance = $liquidation->preAuditEntries()
        ->where('id', '!=', $entry->id)
        ->sum('for_compliance');

    $currentTotal = $existingComplied + $existingCompliance;

    // =====================================================
    // PREVENT OVERFLOW OF LIQUIDATION AMOUNT
    // =====================================================
    if (round($currentTotal + $newAmount, 2) > round($forLiquidationAmount, 2)) {

        return back()->withErrors([
            $isCompliance ? 'for_compliance' : 'amount'
                => 'Total pre-audit entries exceed the liquidation amount.',
        ])->withInput();
    }

    // =====================================================
    // UPDATE ENTRY
    // =====================================================
    if ($isCompliance) {

        // Update auditor (now editable)
        $entry->pre_auditor_id = $request->pre_auditor_id;

        // Update compliance amount
        $entry->for_compliance = $newAmount;
        $entry->amount = 0.00;

        // Handle file replacement
        if ($request->hasFile('supporting_file')) {

            // Delete old file if exists
            if ($entry->compliance_file &&
                Storage::disk('public')->exists($entry->compliance_file)) {

                Storage::disk('public')->delete($entry->compliance_file);
            }

            // Store new file
            $path = $request->file('supporting_file')
                            ->store('supporting_files', 'public');

            $entry->compliance_file = $path;
            $entry->compliance_file_name =
                $request->file('supporting_file')->getClientOriginalName();
        }

    } else {

        // Complied entry
        $entry->amount = $newAmount;
        $entry->for_compliance = 0.00;
    }

    $entry->save();

    // =====================================================
    // RECALCULATE LIQUIDATION TOTALS (FRESH FROM DB)
    // =====================================================
    $liquidation->refresh();

    $totalComplied = $liquidation->preAuditEntries()->sum('amount');
    $totalCompliance = $liquidation->preAuditEntries()->sum('for_compliance');
    $totalCombined = $totalComplied + $totalCompliance;

    $liquidation->pre_audited_amount = $totalComplied;
    $liquidation->for_compliance_amount = $totalCompliance;

    // =====================================================
    // UPDATE STATUS
    // =====================================================
    if (round($totalCombined, 2) === round($forLiquidationAmount, 2)) {
        $liquidation->status = 'For Approval';
    } else {
        $liquidation->status = 'Processing';
    }

    $liquidation->save();

    // =====================================================
    // LOG ACTIVITY
    // =====================================================
    LiquidationActivity::create([
        'liquidation_id' => $liquidation->id,
        'user_id'        => auth()->id(),
        'action'         => 'Pre-Audit Entry Updated',
        'details'        => 'Entry ID: ' . $entry->id,
    ]);

    // =====================================================
    // RETURN SUCCESS
    // =====================================================
    return back()->with('success', 'Pre-audit entry updated successfully.');
}

public function destroyEntry($id)
{
    $entry = PreAuditorLiquidationEntry::findOrFail($id);
    $liquidation = $entry->liquidation;

    $liquidation->refresh();

    if ($liquidation->status !== 'Draft') {
        return back()->with('error', 'Liquidation is no longer editable.');
    }

    // Delete attached file if exists
    if ($entry->compliance_file && \Storage::disk('public')->exists($entry->compliance_file)) {
        \Storage::disk('public')->delete($entry->compliance_file);
    }

    // Delete entry
    $entry->delete();

    // Just recalc totals, DO NOT change status
    $liquidation->refresh();

    $liquidation->pre_audited_amount =
        $liquidation->preAuditEntries()->sum('amount');

    $liquidation->for_compliance_amount =
        $liquidation->preAuditEntries()->sum('for_compliance');

    $liquidation->save();

    // Log deletion
    LiquidationActivity::create([
        'liquidation_id' => $liquidation->id,
        'user_id'        => auth()->id(),
        'action'         => 'Pre-Audit Entry Deleted',
        'details'        => 'Entry ID: ' . $id,
    ]);

    return redirect()->back()->with('success', 'Pre-audit entry deleted successfully.');
}

public function dashboard()
{
    $preAuditors = PreAuditor::with(['preAuditEntries', 'liquidations'])->get();

    return view('pre_auditors.dashboard', compact('preAuditors'));
}


    public function update(Request $request, PreAuditor $preAuditor)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $preAuditor->update($request->only('name'));

        return redirect()->route('pre-auditors.index')->with('success', 'Pre-Auditor updated.');
    }

    public function destroy(PreAuditor $preAuditor)
    {
        if (!auth()->user()->hasAnyRole(['admin', 'reporting', 'verifier'])) {
            abort(403);
        }
        $preAuditor->delete();
        return redirect()->route('pre-auditors.index')->with('success', 'Pre-Auditor deleted.');
    }
    
}
