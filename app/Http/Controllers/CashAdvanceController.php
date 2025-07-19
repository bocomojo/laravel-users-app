<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sdo;
use App\Models\CashAdvance;
use App\Models\Pap;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CashAdvanceImport;
use App\Models\Liquidation;
use App\Models\PayoutDateHistory;


class CashAdvanceController extends Controller
{
    // ✅ New: Show list of all cash advances, optionally filtered by sdo_id
    public function index(Request $request)
    {
        $search = $request->input('search');

        $sdoRecords = Sdo::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('sdo.cash_advance.index', compact('sdoRecords', 'search'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new CashAdvanceImport, $request->file('import_file'));
            return back()->with('success', 'Cash advances imported successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['import_error' => 'Import failed: ' . $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        $sdoId = $request->get('sdo_id');
        $paps = Pap::all();
        $sdoList = Sdo::all();

        // Get list of SDO IDs with ongoing cash advances
        $ongoingSdoIds = \App\Models\CashAdvance::where('status', 'Ongoing')
                            ->pluck('sdo_id')
                            ->unique()
                            ->toArray();

        $sdo = $sdoId ? Sdo::find($sdoId) : null;

        return view('sdo.cash_advance.create', [
            'sdoId'         => $sdo?->id,
            'sdoName'       => $sdo?->name,
            'sdoList'       => $sdoList,
            'paps'          => $paps,
            'ongoingSdoIds' => $ongoingSdoIds, // pass this to the Blade
        ]);
    }

    public function cashAdvances()
    {
        $cashAdvances = CashAdvance::with(['sdo', 'pap', 'liquidations'])->paginate(15);

        return view('sdo.cash_advance.cash_advances', compact('cashAdvances'));
    }


public function updateDates(Request $request, $id)
{
    $request->validate([
        'payout_start' => 'required|date',
        'payout_end'   => 'required|date|after_or_equal:payout_start',
        'attachment'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10048',
    ]);

    $cashAdvance = CashAdvance::findOrFail($id);

    // Log the old dates
    PayoutDateHistory::create([
        'cash_advance_id' => $cashAdvance->id,
        'old_start'       => $cashAdvance->payout_start,
        'old_end'         => $cashAdvance->payout_end,
        'new_start'       => $request->payout_start,
        'new_end'         => $request->payout_end,
    ]);

    // Update dates
    $cashAdvance->payout_start = $request->payout_start;
    $cashAdvance->payout_end   = $request->payout_end;

    // Handle file upload
    if ($request->hasFile('attachment')) {
        $filePath = $request->file('attachment')->store('payout_date_required_attachment', 'public');
        $cashAdvance->payout_attachment = $filePath;
    }

    $cashAdvance->save();

    return redirect()->back()->with('success', 'Payout dates updated and history recorded.');
}

    public function store(Request $request)
{
    $request->validate([
        'sdo_id'           => 'required|exists:sdo,id',
        'check_number'     => 'required|string|max:500',
        'check_date'       => 'nullable|date',
        'dv_number'        => 'nullable|string|max:255',
        'dv_date'          => 'nullable|date',
        'ors_number'       => 'nullable|string|max:255',
        'ors_date'         => 'nullable|date',
        'particulars'      => 'nullable|string|max:2000',
        'transaction_type' => 'required|string|max:255',
        'pap'              => 'required|exists:pap,id',
        'granted_amount'   => 'required|numeric|min:0',
        'payout_start'     => 'nullable|date',
        'payout_end'       => 'nullable|date|after_or_equal:payout_start',
    ]);

    // 🔒 Check if the SDO already has an ongoing cash advance
    $hasOngoing = CashAdvance::where('sdo_id', $request->sdo_id)
        ->where('status', 'Ongoing')
        ->exists();

    if ($hasOngoing) {
        return redirect()->back()
            ->withErrors(['sdo_id' => 'This SDO already has an ongoing cash advance.'])
            ->withInput();
    }

    // ✅ Proceed with creation
    CashAdvance::create([
        'sdo_id'           => $request->sdo_id,
        'check_number'     => $request->check_number,
        'check_date'       => $request->check_date,
        'dv_number'        => $request->dv_number,
        'dv_date'          => $request->dv_date,
        'ors_number'       => $request->ors_number,
        'ors_date'         => $request->ors_date,
        'particulars'      => $request->particulars,
        'transaction_type' => $request->transaction_type,
        'pap'              => $request->pap,
        'granted_amount'   => $request->granted_amount,
        'status'           => 'Ongoing',
        'payout_start'     => $request->payout_start,
        'payout_end'       => $request->payout_end,
    ]);

    return redirect()
        ->route('sdo.cash_advance.index', ['sdo_id' => $request->sdo_id])
        ->with('success', 'Cash advance added successfully.');
}

    public function show($id)
    {
        $cashAdvance = CashAdvance::with('pap')->findOrFail($id);

        return view('sdo.cash_advance.show', compact('cashAdvance'));
    }
}
