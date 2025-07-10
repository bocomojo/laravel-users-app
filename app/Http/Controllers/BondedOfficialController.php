<?php

namespace App\Http\Controllers;

use App\Models\BondedOfficial;
use App\Models\Sdo;
use Illuminate\Http\Request;

class BondedOfficialController extends Controller
{
    public function index()
    {
        $officials = BondedOfficial::with('sdo')->paginate(10);
        return view('sdo.bonded_officials.index', compact('officials'));
    }

    public function create()
    {
        $sdoList = Sdo::all(); // used for dropdown
        return view('sdo.bonded_officials.create', compact('sdoList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sdo_id' => 'required|exists:sdo,id',
            'status' => 'nullable|string|max:255',
            'approved_bond_amount' => 'nullable|numeric',
            'max_cash_accountability' => 'nullable|numeric',
            'effectivity_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'remarks' => 'nullable|string',
            'unliquidated_amount' => 'nullable|numeric',
            'received_in_accounting' => 'nullable|date',
            'remarks_status' => 'nullable|string',
            'date_complied' => 'nullable|date',
            'compliance_returned' => 'nullable|date',
        ]);

        BondedOfficial::create($validated);

        return redirect()->route('sdo.bonded_officials.index')->with('success', 'Bonded Official added successfully.');
    }

    public function edit($id)
    {
        $official = BondedOfficial::findOrFail($id);
        $sdoList = Sdo::all();
        return view('sdo.bonded_officials.edit', compact('official', 'sdoList'));
    }

    public function update(Request $request, $id)
    {
        $official = BondedOfficial::findOrFail($id);

        $validated = $request->validate([
            'sdo_id' => 'required|exists:sdo,id',
            'status' => 'nullable|string|max:255',
            'approved_bond_amount' => 'nullable|numeric',
            'max_cash_accountability' => 'nullable|numeric',
            'effectivity_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'remarks' => 'nullable|string',
            'unliquidated_amount' => 'nullable|numeric',
            'received_in_accounting' => 'nullable|date',
            'remarks_status' => 'nullable|string',
            'date_complied' => 'nullable|date',
            'compliance_returned' => 'nullable|date',
        ]);

        $official->update($validated);

        return redirect()->route('sdo.bonded_officials.index')->with('success', 'Bonded Official updated successfully.');
    }

    public function destroy($id)
    {
        $official = BondedOfficial::findOrFail($id);
        $official->delete();

        return redirect()->route('sdo.bonded_officials.index')->with('success', 'Bonded Official deleted successfully.');
    }
}
