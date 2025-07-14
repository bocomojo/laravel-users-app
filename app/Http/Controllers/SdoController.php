<?php

namespace App\Http\Controllers;

use App\Models\Sdo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SdoExport;
use App\Imports\SdoImport;
use Illuminate\Support\Facades\Log;

class SdoController extends Controller
{
    public function index(Request $request)
    {
        $search    = $request->input('search');
        $status    = $request->input('employment_status');
        $sort      = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $sdoRecords = Sdo::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($status, fn($q) => $q->where('employment_status', $status))
            ->orderBy($sort, $direction)
            ->paginate(10);

        return view('sdo.index', compact('sdoRecords', 'search', 'status', 'sort', 'direction'));
    }

    public function sdoCashAdvance(Request $request)
    {
        $search    = $request->input('search');
        $status    = $request->input('employment_status');
        $sort      = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $sdoRecords = Sdo::with('cashAdvance')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($status, fn($q) => $q->where('employment_status', $status))
            ->where(function ($q) {
                $q->whereHas('cashAdvance', fn($sub) => $sub->where('status', 'Ongoing'))
                  ->orWhereDoesntHave('cashAdvance');
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('sdo.cash_advance.index', compact('sdoRecords', 'search', 'status', 'sort', 'direction'));
    }

    public function create()
    {
        return view('sdo.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'nullable|email|unique:sdo,email',
            'corporate_email'   => 'nullable|email|max:255',
            'contact_number'    => 'nullable|string|max:20',
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
            'ppower_name'       => 'nullable|string|max:255', // Is this intentional?
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

    public function destroy($id)
    {
        $record = Sdo::findOrFail($id);
        $record->delete();

        return redirect()->route('sdo.index')->with('success', 'SDO record deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new SdoExport, 'sdo-records.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:12048',
        ]);

        try {
            $import = new SdoImport;
            Excel::import($import, $request->file('file'));

            $skipped = count($import->failures());

            if ($skipped > 0) {
                return redirect()->route('sdo.index')
                    ->with('warning', "$skipped duplicate or invalid rows were skipped.");
            }

            return redirect()->route('sdo.index')
                ->with('success', 'SDO records imported successfully.');
        } catch (ValidationException $e) {
            return redirect()->route('sdo.index')
                ->with('error', 'Validation failed: check the data format.');
        } catch (\Exception $e) {
            Log::error('SDO Import Error: ' . $e->getMessage());
            return redirect()->route('sdo.index')
                ->with('error', 'Import failed. Please check your file and try again.');
        }
    }

    public function createForLiquidation()
    {
        $sdos = Sdo::orderBy('name')->get();
        return view('liquidation.create', compact('sdos'))->with('cashAdvance', null);
    }
}
