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
        return Excel::download(new LiquidationsExport($cashAdvanceId), 'liquidations.xlsx');
    }
    /**
     * Display a listing of the cash advances.
     */
    public function index()
    {
        $cashAdvances = CashAdvance::with('sdo')->latest()->get();

        return view('liquidation.index', compact('cashAdvances'));
    }

    /**
     * Display a single cash advance with its related liquidations.
     */
    public function show($id, Request $request)
    {
        $cashAdvance = CashAdvance::with('sdo')->findOrFail($id);

        $sortOrder = $request->get('sort', 'desc'); // default to latest
        $filterType = $request->get('type');

        $liquidations = Liquidation::where('check_number', $cashAdvance->check_number)
            ->when($filterType, fn($query) => $query->where('liquidation_type', $filterType))
            ->orderBy('created_at', $sortOrder)
            ->get();

        return view('liquidation.show', compact('cashAdvance', 'liquidations', 'sortOrder', 'filterType'));
    }

    /**
     * Show the form for adding a liquidation for a specific cash advance.
     */
    public function create(Request $request)
    {
        $cashAdvanceId = $request->get('cash_advance_id');
        $cashAdvance = CashAdvance::with('sdo')->findOrFail($cashAdvanceId);

        return view('liquidation.create', compact('cashAdvance'));
    }

    /**
     * Store a new liquidation entry.
     */
    public function store(Request $request)
    {
        // Base validation rules
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

        // Add conditional rules for refund
        if ($request->input('liquidation_type') === 'Refund') {
            $rules['or_number'] = 'required|string|max:255';
            $rules['or_date'] = 'required|date';
        }

        $validated = $request->validate($rules);

        // If not Refund, nullify OR fields
        if ($validated['liquidation_type'] !== 'Refund') {
            $validated['or_number'] = null;
            $validated['or_date'] = null;
        }

        // Create the liquidation with the validated data including cash_advance_id
        Liquidation::create($validated);

        return redirect()->route('liquidation.index')->with('success', 'Liquidation added successfully.');
    }
}
