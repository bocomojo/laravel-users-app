<?php

namespace App\Http\Controllers;

use App\Models\BondedOfficial;
use App\Models\Sdo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BondedOfficialController extends Controller
{
    public function index(Request $request)
    {
        $query = BondedOfficial::with('sdo');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('sdo', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('position', 'like', "%$search%");
            });
        }

        if ($request->filled('bond_status')) {
            $query->where('bond_status', $request->input('bond_status'));
        }

        if ($request->filled('employment_status')) {
            $query->whereHas('sdo', function ($q) use ($request) {
                $q->where('employment_status', $request->input('employment_status'));
            });
        }

        if ($request->filled('expiry_filter')) {
            $today = now()->toDateString();
            if ($request->expiry_filter === 'expired') {
                $query->whereDate('expiration_date', '<', $today);
            } elseif ($request->expiry_filter === 'expiring_today') {
                $query->whereDate('expiration_date', '=', $today);
            } elseif ($request->expiry_filter === 'not_expired') {
                $query->whereDate('expiration_date', '>', $today);
            }
        }

        $officials = $query->paginate(15)->withQueryString();

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
            'unfor_liquidation_amount' => 'nullable|numeric',
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
        // Validate input
        $request->validate([
            'bond_status' => 'required|string',
            'approved_bond_amount' => 'nullable|numeric',
            'max_cash' => 'nullable|numeric',
            'effective_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'unliquidated_amount' => 'nullable|numeric',
            'date_received_accounting' => 'nullable|date',
            'date_complied' => 'nullable|date',
            'compliance_date_returned' => 'nullable|date',
            'bond_file' => 'required_if:bond_status,With SO|nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $bonded = BondedOfficial::findOrFail($id);

        // Prepare fields for update
        $data = $request->only([
            'bond_status',
            'approved_bond_amount',
            'max_cash',
            'effective_date',
            'expiration_date',
            'unliquidated_amount',
            'date_received_accounting',
            'date_complied',
            'compliance_date_returned',
        ]);

        // Handle file upload
        if ($request->hasFile('bond_file')) {
            // Delete old file if it exists
            if ($bonded->bond_file_path && Storage::disk('public')->exists($bonded->bond_file_path)) {
                Storage::disk('public')->delete($bonded->bond_file_path);
            }

            // Store new file and include in data to update
            $data['bond_file_path'] = $request->file('bond_file')->store('bond_files', 'public');
        }

        $bonded->update($data);

        return redirect()->back()->with('success', 'Record updated successfully.');
    }

    public function destroy($id)
    {
        $official = BondedOfficial::findOrFail($id);
        $official->delete();

        return redirect()->route('sdo.bonded_officials.index')->with('success', 'Bonded Official deleted successfully.');
    }
}
