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
    // Eager load liquidations with their preAuditEntries and the preAuditor for each entry
    $auditor = PreAuditor::with(['liquidations.preAuditEntries.preAuditor'])->findOrFail($id);

    // Sort liquidations: Completed at the bottom
    $liquidations = $auditor->liquidations
        ->sortBy(function($liq) {
            return $liq->status === 'Completed' ? 1 : 0;
        })
        ->values();

    // Time frames
    $yesterday = Carbon::yesterday();
    $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
    $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
    $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
    $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

    // Totals
    $yesterdayTotal = $auditor->preAuditEntries()
        ->whereDate('created_at', $yesterday)
        ->sum(DB::raw('amount + for_compliance'));
    $lastWeekTotal = $auditor->preAuditEntries()
        ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
        ->sum(DB::raw('amount + for_compliance'));
    $lastMonthTotal = $auditor->preAuditEntries()
        ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
        ->sum(DB::raw('amount + for_compliance'));

    $customTotal = null;
    if (request()->filled('custom_date')) {
        $customDate = Carbon::parse(request('custom_date'))->startOfDay();
        $customTotal = $auditor->preAuditEntries()
            ->whereDate('created_at', $customDate)
            ->sum(DB::raw('amount + for_compliance'));
    } elseif (request()->filled('custom_month')) {
        $customMonth = Carbon::parse(request('custom_month'));
        $customTotal = $auditor->preAuditEntries()
            ->whereBetween('created_at', [$customMonth->startOfMonth(), $customMonth->endOfMonth()])
            ->sum(DB::raw('amount + for_compliance'));
    }

    // Totals by status
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
        'liquidation_id'   => 'required|exists:liquidation,id',
        'amount'           => 'required|numeric|min:0.01',
        'for_compliance'   => 'required|boolean',
        'supporting_file'  => 'required_if:for_compliance,1|file|mimes:pdf,jpg,png|max:10048',
    ]);

    $liquidation = Liquidation::with(['preAuditEntries', 'cashAdvance.sdo'])->findOrFail($request->liquidation_id);

// Sum all previous amounts marked for compliance
$existingCompliance = $liquidation->preAuditEntries
    ->where('for_compliance', true)
    ->sum('amount');

// Sum all previous amounts not for compliance
$existingNonCompliance = $liquidation->preAuditEntries
    ->where('for_compliance', false)
    ->sum('amount');

$forLiquidationAmount = abs($liquidation->for_liquidation_amount);

// If current entry is for compliance, check against total compliance + new amount
if ($request->for_compliance) {
    $total = $existingCompliance + $request->amount;

    if ($total > $forLiquidationAmount) {
        return back()->withErrors([
            'amount' => 'Total for-compliance amount exceeds the liquidation amount.'
        ])->withInput();
    }
} else {
    $total = $existingNonCompliance + $request->amount;

    if ($total > $forLiquidationAmount) {
        return back()->withErrors([
            'amount' => 'Total pre-audited amount exceeds the liquidation amount.'
        ])->withInput();
    }
}

    // Handle file upload if for compliance
    $filePath = null;
    if ($request->for_compliance && $request->hasFile('supporting_file')) {
        $filePath = $request->file('supporting_file')->store('supporting_files', 'public');
    }

    // Create the pre-audit entry
    PreAuditorLiquidationEntry::create([
        'pre_auditor_id'   => auth()->id(),  // <-- store current user ID here
        'liquidation_id'   => $request->liquidation_id,
        'amount'           => $request->for_compliance ? 0 : $request->amount,
        'for_compliance'   => $request->for_compliance ? $request->amount : 0,
        'compliance_file'  => $filePath,
    ]);

    // Reload and update liquidation totals
    $liquidation->load('preAuditEntries');
    $entries = $liquidation->preAuditEntries;

    $totalComplied = $entries->sum('amount');
    $totalCompliance = $entries->sum('for_compliance');
    $totalCombined = $totalComplied + $totalCompliance;

    $liquidation->pre_audited_amount = $totalComplied;
    $liquidation->for_compliance_amount = $totalCompliance;

    if ($entries->isNotEmpty()) {
        $liquidation->status = 'Processing';
    }

    if (round($totalCombined, 2) === round($forLiquidationAmount, 2)) {
        $liquidation->status = 'For Approval';
    }

    $liquidation->save();
    LiquidationActivity::create([
    'liquidation_id' => $liquidation->id,
    'user_id'        => auth()->id(),
    'action'         => 'Pre-Audit Entry Added',
    'details'        => 'Amount: ' . $request->amount . ', For Compliance: ' . ($request->for_compliance ? 'Yes' : 'No'),
]);


    // Email the SDO if for compliance and email is available
    if ($request->for_compliance && $filePath) {
    $sdoEmail = optional($liquidation->cashAdvance->sdo)->email;

        if ($sdoEmail) {
            Mail::to($sdoEmail)->send(new ComplianceFileSubmitted($liquidation, $filePath));
        } else {
            // Optional: log it or alert admins
            \Log::warning("No email found for SDO of Liquidation ID {$liquidation->id}.");
        }
    }

    return back()->with('success', 'Pre-audit entry added and totals updated.');
} 

public function destroyEntry($id)
{
    $entry = PreAuditorLiquidationEntry::findOrFail($id);
    $liquidation = $entry->liquidation;

    // Delete attached file if exists
    if ($entry->compliance_file && \Storage::disk('public')->exists($entry->compliance_file)) {
        \Storage::disk('public')->delete($entry->compliance_file);
    }

    // Delete entry
    $entry->delete();

    // Recalculate totals
    $entries = $liquidation->preAuditEntries;

    $totalComplied = $entries->sum('amount');
    $totalCompliance = $entries->sum('for_compliance');
    $totalCombined = $totalComplied + $totalCompliance;

    $liquidation->pre_audited_amount = $totalComplied;
    $liquidation->for_compliance_amount = $totalCompliance;

    if ($entries->isEmpty()) {
        $liquidation->status = 'Processing';
    } elseif (round($totalCombined, 2) >= round($liquidation->for_liquidation_amount, 2)) {
        $liquidation->status = 'For Approval';
    }

    $liquidation->save();

    // Log deletion
    LiquidationActivity::create([
        'liquidation_id' => $liquidation->id,
        'user_id'        => auth()->id(),
        'action'         => 'Pre-Audit Entry Deleted',
        'details'        => 'Entry ID: ' . $id,
    ]);

    // Respond with JSON for AJAX
    return response()->json([
        'success' => true,
        'entryId' => $id
    ]);
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
        $preAuditor->delete();
        return redirect()->route('pre-auditors.index')->with('success', 'Pre-Auditor deleted.');
    }
    
}
