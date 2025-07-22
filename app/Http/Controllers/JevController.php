<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JevImport;

class JevController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'jev_file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new JevImport, $request->file('jev_file'));

            return redirect()->back()->with('success', 'JEV numbers imported and applied successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['jev_file' => 'Import failed: ' . $e->getMessage()]);
        }
    }
}
