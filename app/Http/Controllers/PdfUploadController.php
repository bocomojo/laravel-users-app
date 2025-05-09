<?php

namespace App\Http\Controllers;

use App\Models\ComplianceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfUploadController extends Controller
{
    // Show the upload form
    public function create()
    {
        return view('pdf.upload'); // This should point to resources/views/pdf/upload.blade.php
    }

    // Handle the upload and storage
    public function store(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240', // Max 10MB
        ]);

        $file = $request->file('pdf_file');
        $extension = $file->getClientOriginalExtension();
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $extension;

        // Store the file
        $path = $file->storeAs('pdfs', $filename, 'public');

        // Insert into compliance_files table
        ComplianceFile::create([
            'filename' => $filename,
            'status' => 'email sent',
        ]);

        return redirect()->route('pdf.upload')->with('success', 'PDF uploaded and tracked successfully!');
    }
}
