<?php

namespace App\Http\Controllers;

use App\Models\Pap;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PapImport;

class PapController extends Controller
{
    // Show all PAP records with search
    public function index(Request $request)
    {
        $search = $request->input('search');

        $paps = Pap::query()
            ->when($search, fn ($q) => $q->where('pap_name', 'like', "%{$search}%")
                                        ->orWhere('pap_code', 'like', "%{$search}%"))
            ->get();

        return view('pap.index', compact('paps'));
    }

    // Show form to create new PAP (optional if using modal)
    public function create()
    {
        return view('pap.create');
    }

    // Store new PAP in database
    public function store(Request $request)
{
    $request->validate([
        'pap_name' => 'required|string|max:255',
        'pap_code' => 'required|string|max:255',
    ]);

    // Check if pap_name already exists
    $exists = Pap::where('pap_name', $request->pap_name)->exists();

    if ($exists) {
        return redirect()->route('pap.index')->with('error', 'PAP name already exists. Skipped.');
    }

    Pap::create($request->only('pap_name', 'pap_code'));

    return redirect()->route('pap.index')->with('success', 'PAP created successfully.');
}


    // Show form to edit existing PAP
    public function edit(Pap $pap)
    {
        return view('pap.edit', compact('pap'));
    }

    // Update existing PAP
    public function update(Request $request, Pap $pap)
    {
        $request->validate([
            'pap_name' => 'required|string|max:255',
            'pap_code' => 'required|string|max:255',
        ]);

        $pap->update($request->only('pap_name', 'pap_code'));

        return redirect()->route('pap.index')->with('success', 'PAP updated successfully.');
    }

    // Delete a PAP record
    public function destroy(Pap $pap)
    {
        $pap->delete();

        return redirect()->route('pap.index')->with('success', 'PAP deleted successfully.');
    }

    // Handle import of PAP records from Excel/CSV
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new PapImport, $request->file('import_file'));

        return redirect()->route('pap.index')->with('success', 'PAPs imported successfully.');
    }
}
