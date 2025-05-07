<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PdfListController extends Controller
{
    public function index()
    {
        // Get all files in the "public/pdfs" directory
        $files = Storage::disk('public')->files('pdfs');

        return view('documents.index', compact('files'));
    }
    
}
