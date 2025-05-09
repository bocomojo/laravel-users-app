<?php

namespace App\Http\Controllers;

use App\Models\ComplianceFile;
use Illuminate\Http\Request;

class ComplianceFileController extends Controller
{
    public function index()
    {
        $files = ComplianceFile::all();
        return view('sdo.compliance.index', compact('files'));
    }
}

