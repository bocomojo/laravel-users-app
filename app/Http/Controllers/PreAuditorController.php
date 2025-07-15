<?php

namespace App\Http\Controllers;

use App\Models\PreAuditor;
use App\Models\Liquidation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PreAuditorImport;

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

        // Fallback: single name
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PreAuditor::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Pre-Auditor added successfully.');
    }

    public function edit(PreAuditor $preAuditor)
    {
        return view('pre_auditors.edit', compact('preAuditor'));
    }

    public function showLiquidations(PreAuditor $auditor)
    {
        $liquidations = $auditor->liquidations()->latest()->paginate(15); // assuming a `liquidations()` relationship exists

        return view('pre_auditors.liquidations', [
        'auditor' => $auditor,
        'liquidations' => $liquidations
        ]);
    }

    public function update(Request $request, PreAuditor $preAuditor)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $preAuditor->update($request->only('name'));
        return redirect()->route('pre-auditors.index')->with('success', 'Pre-Auditor updated.');
    }

    public function destroy(PreAuditor $preAuditor)
    {
        $preAuditor->delete();
        return redirect()->route('pre-auditors.index')->with('success', 'Pre-Auditor deleted.');
    }
}
