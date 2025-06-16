<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Sdo;
use App\Mail\AssignedFileMail;
use App\Models\ComplianceFile;

class PdfUploadController extends Controller
{
    public function create()
    {
        return view('pdf.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pdf_file.*' => 'required|mimes:pdf|max:10240',
        ]);

        if (!$request->hasFile('pdf_file')) {
            return redirect()->back()->withErrors(['pdf_file' => 'No files were uploaded.']);
        }

        // Basic internet connection check
        try {
            Http::timeout(3)->get('https://www.google.com');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['connection' => 'No internet connection. Please try again later.']);
        }

        $files = $request->file('pdf_file');
        $emailSuccesses = [];
        $emailFailures = [];

        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $originalName . '_' . time() . '.' . $extension;

            // Store the file
            $file->storeAs('pdfs', $filename, 'public');

            // Extract SDO name (format: XXXX_John Doe_XXXX.pdf)
            $filenameParts = explode('_', $originalName);
            $sdoName = $filenameParts[1] ?? null;

            $emailStatus = 'email failed';

            if ($sdoName) {
                $sdo = Sdo::where('name', 'LIKE', '%' . $sdoName . '%')->first();

                if ($sdo && $sdo->email) {
                    $fullPath = storage_path('app/public/pdfs/' . $filename);

                    try {
                        Mail::to($sdo->email)->send(new AssignedFileMail($sdo, $filename, $fullPath));
                        $emailSuccesses[] = $sdo->email;
                        $emailStatus = 'email sent';
                    } catch (\Exception $e) {
                        Log::error("Email to {$sdo->email} failed: " . $e->getMessage());
                        $emailFailures[] = $sdo->email;
                    }
                } else {
                    $emailFailures[] = $sdoName;
                }
            } else {
                $emailFailures[] = $originalName;
            }

            // Log in compliance_files
            ComplianceFile::create([
                'filename' => $filename,
                'status' => $emailStatus,
            ]);
        }

        // Tailored message
        if (count($emailSuccesses) > 0 && count($emailFailures) > 0) {
            return redirect()->route('pdf.upload')->with('warning', 'Some emails failed to send: ' . implode(', ', $emailFailures));
        } elseif (count($emailFailures) > 0) {
            return redirect()->route('pdf.upload')->withErrors(['email' => 'No emails were sent.']);
        } else {
            return redirect()->route('pdf.upload')->with('success', 'PDF(s) uploaded and all emails sent successfully.');
        }
    }
}
