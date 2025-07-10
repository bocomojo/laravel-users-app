<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sdo;
use App\Models\CashAdvance;
use App\Models\Pap;

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

    public function create(Request $request)
    {
        $sdoId = $request->get('sdo_id');
        $sdo   = Sdo::find($sdoId);

        if (! $sdo) {
            abort(404, 'SDO not found.');
        }

        $paps = Pap::all();

        return view('sdo.cash_advance.create', [
            'sdoId'   => $sdo->id,
            'sdoName' => $sdo->name,
            'paps'    => $paps,
        ]);
    }

    public function updateDates(Request $request, $id)
    {
        $request->validate([
            'payout_start' => 'required|date',
            'payout_end' => 'required|date|after_or_equal:payout_start',
        ]);

        $cashAdvance = CashAdvance::findOrFail($id);
        $cashAdvance->payout_start = $request->payout_start;
        $cashAdvance->payout_end = $request->payout_end;
        $cashAdvance->save();

        return redirect()->back()->with('success', 'Payout dates updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sdo_id'          => 'required|exists:sdo,id',
            'check_number'    => 'required|string|max:500',
            'check_date'      => 'nullable|date',
            'dv_number'       => 'nullable|string|max:255',
            'dv_date'         => 'nullable|date',
            'ors_number'      => 'nullable|string|max:255',
            'ors_date'        => 'nullable|date',
            'particulars'     => 'nullable|string|max:2000',
            'transaction_type'=> 'required|string|max:255',
            'pap'             => 'required|exists:pap,id',
            'granted_amount'  => 'required|numeric|min:0',
            'payout_start'    => 'nullable|date',
            'payout_end'      => 'nullable|date|after_or_equal:payout_start',
        ]);

        CashAdvance::create([
            'sdo_id'          => $request->sdo_id,
            'check_number'    => $request->check_number,
            'check_date'      => $request->check_date,
            'dv_number'       => $request->dv_number,
            'dv_date'         => $request->dv_date,
            'ors_number'      => $request->ors_number,
            'ors_date'        => $request->ors_date,
            'particulars'     => $request->particulars,
            'transaction_type'=> $request->transaction_type,
            'pap'             => $request->pap,
            'granted_amount'  => $request->granted_amount,
            'status'          => 'Ongoing',
            'payout_start'    => $request->payout_start,
            'payout_end'      => $request->payout_end,
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
