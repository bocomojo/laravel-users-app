<?php

namespace App\Http\Controllers;

use App\Models\LiquidatedReport;
use Illuminate\Http\Request;

class LiquidatedReportController extends Controller
{
    /**
     * Display a listing of the liquidated reports with pagination.
     */
    public function index()
    {
        $reports = LiquidatedReport::latest()->paginate(15); // ✅ Paginated
        return view('liquidated_reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        return view('liquidated_reports.create');
    }

    /**
     * Store a newly created report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cash_advance_id' => 'nullable|exists:cash_advance,id',
            'sdo_name' => 'required|string|max:255',
            'check_number' => 'required|string|max:255',
            'granted_amount' => 'required|numeric|min:0',
            'for_liquidation_amount' => 'required|numeric',
            'liquidation_type' => 'required|string|max:255',
            'liq_date_received' => 'nullable|date',
            'liq_number' => 'nullable|string|max:255',
            'liq_date' => 'nullable|date',
            'or_number' => 'nullable|string|max:255',
            'or_date' => 'nullable|date',
            'for_compliance_amount' => 'nullable|numeric',
            'pre_audited_amount' => 'nullable|numeric',
            'pre_auditor' => 'nullable|string|max:255',
            'jev_no' => 'nullable|string|max:255',
        ]);

        LiquidatedReport::create($validated);

        return redirect()->route('liquidated_reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Show a single report.
     */
    public function show(LiquidatedReport $liquidatedReport)
    {
        return view('liquidated_reports.show', compact('liquidatedReport'));
    }

    /**
     * Show the form for editing a report.
     */
    public function edit(LiquidatedReport $liquidatedReport)
    {
        return view('liquidated_reports.edit', compact('liquidatedReport'));
    }

    /**
     * Update the specified report.
     */
    public function update(Request $request, LiquidatedReport $liquidatedReport)
    {
        $validated = $request->validate([
            'cash_advance_id' => 'nullable|exists:cash_advance,id',
            'sdo_name' => 'required|string|max:255',
            'check_number' => 'required|string|max:255',
            'granted_amount' => 'required|numeric|min:0',
            'for_liquidation_amount' => 'required|numeric',
            'liquidation_type' => 'required|string|max:255',
            'liq_date_received' => 'nullable|date',
            'liq_number' => 'nullable|string|max:255',
            'liq_date' => 'nullable|date',
            'or_number' => 'nullable|string|max:255',
            'or_date' => 'nullable|date',
            'for_compliance_amount' => 'nullable|numeric',
            'pre_audited_amount' => 'nullable|numeric',
            'pre_auditor' => 'nullable|string|max:255',
            'jev_no' => 'nullable|string|max:255',
        ]);

        $liquidatedReport->update($validated);

        return redirect()->route('liquidated_reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Delete a report.
     */
    public function destroy(LiquidatedReport $liquidatedReport)
    {
        $liquidatedReport->delete();
        return redirect()->route('liquidated_reports.index')->with('success', 'Report deleted successfully.');
    }
}
