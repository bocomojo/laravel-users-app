<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Sdo;
use App\Mail\AssignedFileMail;
use App\Models\ComplianceFile;

class PdfUploadController extends Controller
{
    // Show the upload form
    public function create()
    {
        return view('pdf.upload');
    }

    // Handle the upload and send email
    public function store(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240',
        ]);

        $file = $request->file('pdf_file');
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = $originalName . '_' . time() . '.' . $extension;

        // Store the file in 'storage/app/public/pdfs'
        $path = $file->storeAs('pdfs', $filename, 'public');

        // Insert into compliance_files
        ComplianceFile::create([
            'filename' => $filename,
            'status' => 'email sent',
        ]);

        // Extract SDO name from the original filename (format: XXXX_John Doe_XXXX)
        $filenameParts = explode('_', $originalName);
        $sdoName = $filenameParts[1] ?? null;

        if ($sdoName) {
            $sdo = Sdo::where('name', 'LIKE', '%' . $sdoName . '%')->first();

            if ($sdo && $sdo->email) {
                $fullPath = storage_path('app/public/pdfs/' . $filename);

                // Send email
                Mail::to($sdo->email)->send(new AssignedFileMail($sdo, $filename, $fullPath));
            }
        }

        return redirect()->route('pdf.upload')->with('success', 'PDF uploaded and email sent if SDO match found.');
    }
}
