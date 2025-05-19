<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sdo;
use App\Models\CashAdvance;

class LiquidationController extends Controller
{
    public function create(Request $request)
    {
        $sdoId = $request->get('sdo_id');
        $sdo = Sdo::find($sdoId);

        if (!$sdo) {
            abort(404, 'SDO not found.');
        }

        return view('liquidation.create', [
            'sdoId' => $sdo->id,
            'sdoName' => $sdo->name,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sdo_id' => 'required|exists:sdo,id',
            'check_number' => 'required|string|max:255',
            'transaction_type' => 'required|string|max:255',
            'granted_amount' => 'required|numeric|min:0',
        ]);

        CashAdvance::create([
            'sdo_id' => $request->sdo_id,
            'check_number' => $request->check_number,
            'transaction_type' => $request->transaction_type,
            'granted_amount' => $request->granted_amount,
        ]);

        return redirect()->route('sdo.index')->with('success', 'Cash advance added successfully.');
    }
}
