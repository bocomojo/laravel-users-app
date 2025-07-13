<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sdo;
use App\Models\CashAdvance;
use App\Models\Liquidation;
use App\Models\PreAuditor;
use App\Exports\LiquidationsExport;
use App\Exports\CondensedLiquidationExport;
use Maatwebsite\Excel\Facades\Excel;

class LiquidationController extends Controller
{
    public function condensedExport(Request $request)
    {
        $query = Liquidation::query();

        if ($request->filled('type')) {
            $query->where('liquidation_type', $request->type);
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

    public function index(Request $request)
    {
        $query = Liquidation::with(['cashAdvance', 'cashAdvance.sdo', 'cashAdvance.pap']);

        if ($request->filled('type')) {
            $query->where('liquidation_type', $request->type);
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
        $sdos = Sdo::orderBy('name')->get();

        return view('liquidation.index', compact('liquidations', 'sdos'));
    }

    public function show($id, Request $request)
    {
        $cashAdvance = CashAdvance::with(['sdo', 'liquidation'])->findOrFail($id);

        $sortOrder = $request->get('sort', 'desc');
        $filterType = $request->get('type');

        $liquidations = Liquidation::where('cash_advance_id', $cashAdvance->id)
            ->when($filterType, fn($query) => $query->where('liquidation_type', $filterType))
            ->orderBy('created_at', $sortOrder)
            ->get();

        return view('liquidation.show', compact('cashAdvance', 'liquidations', 'sortOrder', 'filterType'));
    }

    public function inlineUpdate(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:255',
        ]);

        $liq = Liquidation::findOrFail($id);
        $liq->jev_no = $request->value;
        $liq->save();

        return response()->json(['message' => 'JEV No. updated successfully']);
    }

    public function create(Request $request)
    {
        $cashAdvance = null;
        $preAuditors = PreAuditor::orderBy('name')->get();

        if ($request->has('cash_advance_id')) {
            $cashAdvance = CashAdvance::with('sdo')->findOrFail($request->get('cash_advance_id'));
            $sdoList = collect([$cashAdvance->sdo]);
        } else {
            $sdoList = Sdo::orderBy('name')->get();
        }

        return view('liquidation.create', compact('cashAdvance', 'sdoList', 'preAuditors'));
    }

    public function store(Request $request)
    {
        $rules = [
            'cash_advance_id' => 'nullable|exists:cash_advance,id',
            'sdo_id' => 'required|exists:sdo,id',
            'check_number' => 'required|string|max:255',
            'granted_amount' => 'required|numeric|min:0',
            'for_liquidation_amount' => 'required|numeric|min:0',
            'liquidation_type' => 'required|string|max:255',
            'liq_date_received' => 'required|date',
            'liq_number' => 'required|string|max:255',
            'liq_date' => 'required|date',
        ];

        if ($request->input('liquidation_type') === 'Refund') {
            $rules['or_number'] = 'required|string|max:255';
            $rules['or_date'] = 'required|date';
        }

        $validated = $request->validate($rules);

        if ($validated['liquidation_type'] !== 'Refund') {
            $validated['or_number'] = null;
            $validated['or_date'] = null;
        }

        $sdo = Sdo::findOrFail($validated['sdo_id']);
        $validated['sdo_name'] = $sdo->name;
        $validated['pre_audited_amount'] = $validated['for_liquidation_amount'];

        if ($request->has('pre_auditors')) {
            $names = PreAuditor::whereIn('id', $request->pre_auditors)->pluck('name')->toArray();
            $validated['pre_auditor'] = implode(', ', $names);
        } else {
            $validated['pre_auditor'] = null;
        }

        $liquidation = Liquidation::create($validated);

        if ($request->has('pre_auditors')) {
            $liquidation->preAuditors()->sync($request->pre_auditors);
        }

        if ($validated['cash_advance_id']) {
            $cashAdvance = CashAdvance::with('liquidation')->find($validated['cash_advance_id']);
            $totalPreAudited = $cashAdvance->liquidation->sum('pre_audited_amount');

            $cashAdvance->status = round($totalPreAudited, 2) == round($cashAdvance->granted_amount, 2) ? 'Fully Liquidated' : 'Ongoing';
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

    public function edit($id)
    {
        $liquidation = Liquidation::findOrFail($id);
        $sdoList = Sdo::orderBy('name')->get();

        return view('liquidation.edit', compact('liquidation', 'sdoList'));
    }

    public function update(Request $request, $id)
    {
        $liquidation = Liquidation::findOrFail($id);

        $rules = [
            'for_liquidation_amount' => 'required|numeric|min:0',
            'for_compliance_amount' => 'required|numeric|min:0',
            'liquidation_type' => 'required|string|max:255',
            'liq_date_received' => 'required|date',
            'liq_number' => 'required|string|max:255',
            'liq_date' => 'required|date',
        ];

        if ($request->input('liquidation_type') === 'Refund') {
            $rules['or_number'] = 'required|string|max:255';
            $rules['or_date'] = 'required|date';
        }

        $validated = $request->validate($rules);

        if ($validated['liquidation_type'] !== 'Refund') {
            $validated['or_number'] = null;
            $validated['or_date'] = null;
        }

        $validated['pre_audited_amount'] = $validated['for_liquidation_amount'] - $validated['for_compliance_amount'];

        if ($request->has('pre_auditors')) {
            $names = PreAuditor::whereIn('id', $request->pre_auditors)->pluck('name')->toArray();
            $validated['pre_auditor'] = implode(', ', $names);
            $liquidation->preAuditors()->sync($request->pre_auditors);
        } else {
            $validated['pre_auditor'] = null;
        }

        $liquidation->update($validated);

        if ($liquidation->cash_advance_id) {
            $cashAdvance = CashAdvance::with('liquidation')->find($liquidation->cash_advance_id);
            $totalPreAudited = $cashAdvance->liquidation->sum('pre_audited_amount');

            $cashAdvance->status = round($totalPreAudited, 2) == round($cashAdvance->granted_amount, 2) ? 'Fully Liquidated' : 'Ongoing';
            $cashAdvance->save();
        }

        return redirect()->route('liquidation.show', $liquidation->cash_advance_id)
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
