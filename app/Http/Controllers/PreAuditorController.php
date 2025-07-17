<?php

namespace App\Http\Controllers;

use App\Models\{PreAuditor, Liquidation, PreAuditorLiquidationEntry};
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PreAuditorImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PreAuditorController extends Controller
{
    public function index()
    {
        $preAuditors = PreAuditor::all();
        return view('pre_auditors.index', compact('preAuditors'));
    }

    public function create()
    {
        return view('pre_auditors.create');
    }

    public function store(Request $request)
    {
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
        return view('pre_auditors.edit', compact('preAuditor'));
    }

    public function showLiquidations($id)
    {
        $auditor = PreAuditor::findOrFail($id);

        $liquidations = $auditor->liquidation()
            ->orderByRaw("CASE WHEN status = 'Completed' THEN 1 ELSE 0 END ASC")
            ->orderBy('created_at', 'asc')
            ->get();

        // Time frames
        $yesterday = Carbon::yesterday();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Fixed period totals
        $yesterdayTotal = $auditor->preAuditEntries()
            ->whereDate('created_at', $yesterday)
            ->sum(DB::raw('amount + for_compliance'));

        $lastWeekTotal = $auditor->preAuditEntries()
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->sum(DB::raw('amount + for_compliance'));

        $lastMonthTotal = $auditor->preAuditEntries()
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum(DB::raw('amount + for_compliance'));

        // Optional custom range summary
        $customTotal = null;

        if (request()->filled('custom_date')) {
            $customDate = Carbon::parse(request('custom_date'))->startOfDay();
            $customTotal = $auditor->preAuditEntries()
                ->whereDate('created_at', $customDate)
                ->sum(DB::raw('amount + for_compliance'));

        } elseif (request()->filled('custom_month')) {
            $customMonth = Carbon::parse(request('custom_month'));
            $startOfCustomMonth = $customMonth->startOfMonth();
            $endOfCustomMonth = $customMonth->endOfMonth();

            $customTotal = $auditor->preAuditEntries()
                ->whereBetween('created_at', [$startOfCustomMonth, $endOfCustomMonth])
                ->sum(DB::raw('amount + for_compliance'));
        }

        $totalAssigned = $liquidations->count();
        $totalCompleted = $liquidations->where('status', 'Completed')->count();
        $totalForChecking = $liquidations->where('status', 'For Checking')->count();

        return view('pre_auditors.liquidations', compact(
            'auditor',
            'liquidations',
            'yesterdayTotal',
            'lastWeekTotal',
            'lastMonthTotal',
            'customTotal',
            'totalAssigned',
            'totalCompleted',
            'totalForChecking'
        ));
    }

public function addEntry(Request $request)
{
    $request->validate([
        'liquidation_id' => 'required|exists:liquidation,id',
        'amount' => 'required|numeric|min:0.01',
        'for_compliance' => 'required|boolean',
    ]);

    // Get pre_auditor_id from pivot
    $preAuditorId = DB::table('pre_auditor_liquidation')
        ->where('liquidation_id', $request->liquidation_id)
        ->value('pre_auditor_id');

    if (!$preAuditorId) {
        return back()->withErrors([
            'pre_auditor_id' => 'No assigned pre-auditor found for this liquidation.'
        ]);
    }

    $liquidation = Liquidation::with('preAuditEntries')->findOrFail($request->liquidation_id);

    $existingAmount = $liquidation->preAuditEntries->sum('amount');
    $existingCompliance = $liquidation->preAuditEntries->sum('for_compliance');
    $forLiquidationAmount = abs($liquidation->for_liquidation_amount);

    // Validation based on type
    if (!$request->for_compliance) {
        if (($existingAmount + $request->amount) > $forLiquidationAmount) {
            return back()->withErrors([
                'amount' => 'Total pre-audited amount exceeds the liquidation amount.'
            ])->withInput();
        }
    } else {
        if (($existingCompliance + $request->amount) > $forLiquidationAmount) {
            return back()->withErrors([
                'amount' => 'Total for-compliance amount exceeds the liquidation amount.'
            ])->withInput();
        }
    }

    // Create new entry
    PreAuditorLiquidationEntry::create([
        'pre_auditor_id' => $preAuditorId,
        'liquidation_id' => $request->liquidation_id,
        'amount' => $request->for_compliance ? 0 : $request->amount,
        'for_compliance' => $request->for_compliance ? $request->amount : 0,
    ]);

    // 🔄 Reload updated entries
    $liquidation->load('preAuditEntries');
    $entries = $liquidation->preAuditEntries;

    $totalComplied = $entries->sum('amount');
    $totalCompliance = $entries->sum('for_compliance');
    $totalCombined = $totalComplied + $totalCompliance;

    // Update liquidation status/fields
    $liquidation->pre_audited_amount = $totalComplied;
    $liquidation->for_compliance_amount = $totalCompliance;

    if ($entries->isNotEmpty()) {
        $liquidation->status = 'Processing';
    }

    if (round($totalCombined, 2) === round($forLiquidationAmount, 2)) {
        $liquidation->status = 'For Approval';
    }

    $liquidation->save();

    return back()->with('success', 'Pre-audit entry added and totals updated.');
}
    

    public function update(Request $request, PreAuditor $preAuditor)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $preAuditor->update($request->only('name'));

        return redirect()->route('pre-auditors.index')->with('success', 'Pre-Auditor updated.');
    }

    public function destroy(PreAuditor $preAuditor)
    {
        $preAuditor->delete();
        return redirect()->route('pre-auditors.index')->with('success', 'Pre-Auditor deleted.');
    }
}
