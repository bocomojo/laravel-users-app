<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashAdvance;
use App\Models\Liquidation;
use App\Exports\LiquidationsExport;
use Maatwebsite\Excel\Facades\Excel;

class LiquidationController extends Controller
{
    public function export($cashAdvanceId)
    {
        return Excel::download(new LiquidationsExport($cashAdvanceId), 'liquidation.xlsx');
    }

    public function index()
    {
        $cashAdvances = CashAdvance::with('sdo')->latest()->get();
        return view('liquidation.index', compact('cashAdvances'));
    }

    public function show($id, Request $request)
    {
        $cashAdvance = CashAdvance::with('sdo')->findOrFail($id);

        $sortOrder = $request->get('sort', 'desc');
        $filterType = $request->get('type');

        $liquidations = Liquidation::where('check_number', $cashAdvance->check_number)
            ->when($filterType, fn($query) => $query->where('liquidation_type', $filterType))
            ->orderBy('created_at', $sortOrder)
            ->get();

        return view('liquidation.show', compact('cashAdvance', 'liquidations', 'sortOrder', 'filterType'));
    }

    public function create(Request $request)
    {
        $cashAdvanceId = $request->get('cash_advance_id');
        $cashAdvance = CashAdvance::with('sdo')->findOrFail($cashAdvanceId);

        return view('liquidation.create', compact('cashAdvance'));
    }

    public function store(Request $request)
    {
        $rules = [
            'cash_advance_id' => 'required|exists:cash_advance,id',
            'sdo_name' => 'required|string|max:255',
            'check_number' => 'required|string|max:255',
            'granted_amount' => 'required|numeric|min:0',
            'liquidated_amount' => 'required|numeric|min:0',
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

        Liquidation::create($validated);

        $cashAdvance = CashAdvance::with('liquidation')->find($validated['cash_advance_id']);
        $totalLiquidated = $cashAdvance->liquidation->sum('liquidated_amount');
        $remaining = $cashAdvance->granted_amount - $totalLiquidated;

        $cashAdvance->status = $remaining <= 0 ? 'Fully Liquidated' : 'Ongoing';
        $cashAdvance->save();

        return redirect()->route('liquidation.index')->with('success', 'Liquidation added successfully.');
    }

    public function edit($id)
    {
        $liquidation = Liquidation::findOrFail($id);    // singular
        return view('liquidation.edit', compact('liquidation'));
    }

    public function update(Request $request, $id)
    {
        $liquidation = Liquidation::findOrFail($id);

        $rules = [
            // 'granted_amount' => 'required|numeric|min:0',
            'liquidated_amount' => 'required|numeric|min:0',
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

        $liquidation->update($validated);

        $cashAdvance = CashAdvance::with('liquidation')->find($liquidation->cash_advance_id);
        $totalLiquidated = $cashAdvance->liquidation->sum('liquidated_amount');
        $remaining = $cashAdvance->granted_amount - $totalLiquidated;

        $cashAdvance->status = $remaining <= 0 ? 'Fully Liquidated' : 'Ongoing';
        $cashAdvance->save();

        return redirect()->route('liquidation.show', $cashAdvance->id)
                         ->with('success', 'Liquidation updated successfully.');
    }

    public function destroy($id)
    {
        $liquidation = Liquidation::findOrFail($id);
        $cashAdvanceId = $liquidation->cash_advance_id;
        $liquidation->delete();

        $cashAdvance = CashAdvance::with('liquidation')->find($cashAdvanceId);
        $totalLiquidated = $cashAdvance->liquidation->sum('liquidated_amount');
        $remaining = $cashAdvance->granted_amount - $totalLiquidated;

        $cashAdvance->status = $remaining <= 0 ? 'Fully Liquidated' : 'Ongoing';
        $cashAdvance->save();

        return redirect()->route('liquidation.show', $cashAdvanceId)
                         ->with('success', 'Liquidation deleted successfully.');
    }
}
