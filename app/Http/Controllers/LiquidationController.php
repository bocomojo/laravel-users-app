<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashAdvance;
use App\Models\Liquidation;

class LiquidationController extends Controller
{
    /**
     * Display a listing of the cash advances.
     */
    public function index()
    {
        // Eager load the related SDO for each cash advance
        $cashAdvances = CashAdvance::with('sdo')->latest()->get();

        return view('liquidation.index', compact('cashAdvances'));
    }

    /**
     * Display a single cash advance with its related liquidations.
     */
    // public function show($id)
    // {
    //     $cashAdvance = CashAdvance::with('sdo')->findOrFail($id);

    //     // Get liquidations where check_number matches the cash advance's check number
    //     $liquidations = Liquidation::where('check_number', $cashAdvance->check_number)
    //                               ->orderBy('created_at', 'desc')
    //                               ->get();

    //     return view('liquidation.show', compact('cashAdvance', 'liquidations'));
    // }
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
        $validated = $request->validate([
            'sdo_name' => 'required|string|max:255',
            'check_number' => 'required|string|max:255',
            'granted_amount' => 'required|numeric|min:0',
            'liquidated_amount' => 'required|numeric|min:0',
            'liquidation_type' => 'required|string|max:255',
        ]);

        Liquidation::create($validated);

        return redirect()->route('liquidation.index')->with('success', 'Liquidation added successfully.');
    }
}
