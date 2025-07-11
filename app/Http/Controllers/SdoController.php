<?php

namespace App\Http\Controllers;

use App\Models\Sdo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SdoExport;
use App\Imports\SdoImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\ValidationException;

class SdoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('employment_status');
        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $sdoRecords = Sdo::when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('employment_status', $status);
            })
            ->orderBy($sort, $direction)
            ->paginate(10);

        return view('sdo.index', compact('sdoRecords', 'search', 'status', 'sort', 'direction'));
    }

    public function create()
    {
        return view('sdo.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'ppower_name'       => 'nullable|string|max:255',
            'email'             => 'required|email|unique:sdo,email',
            'corporate_email'   => 'nullable|email|max:255',
            'contact_number'    => 'required|string|max:20',
            'position'          => 'nullable|string|max:255',
            'official_station'  => 'nullable|string|max:255',
            'employment_status' => 'nullable|string|max:255',
        ]);

        Sdo::create($validated);

        return redirect()->route('sdo.index')->with('success', 'SDO record created successfully!');
    }

    public function edit($id)
    {
        $record = Sdo::findOrFail($id);
        return view('sdo.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'ppower_name'       => 'nullable|string|max:255',
            'email'             => 'required|email|unique:sdo,email,' . $id,
            'corporate_email'   => 'nullable|email|max:255',
            'contact_number'    => 'required|string|max:20',
            'position'          => 'nullable|string|max:255',
            'official_station'  => 'nullable|string|max:255',
            'employment_status' => 'nullable|string|max:255',
        ]);

        $record = Sdo::findOrFail($id);
        $record->update($validated);

        return redirect()->route('sdo.index')->with('success', 'SDO record updated successfully.');
    }

    public function export()
    {
        return Excel::download(new SdoExport, 'sdo-records.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import($import = new SdoImport, $request->file('file'));

            $duplicates = count($import->failures());

            if ($duplicates > 0) {
                return redirect()->route('sdo.index')->with('warning', "$duplicates duplicate or invalid rows skipped.");
            }

            return redirect()->route('sdo.index')->with('success', 'SDO records imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('sdo.index')->with('error', 'Import failed. Please check your file format.');
        }
    }

    public function destroy($id)
    {
        $record = Sdo::findOrFail($id);
        $record->delete();

        return redirect()->route('sdo.index')->with('success', 'SDO record deleted successfully.');
    }

    // ✅ NEW: Manual liquidation form route (without cash advance)
    public function createForLiquidation()
    {
        $sdos = Sdo::orderBy('name')->get();
        return view('liquidation.create', compact('sdos'))->with('cashAdvance', null);
    }
}
    