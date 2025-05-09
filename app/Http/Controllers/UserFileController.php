<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class UserFileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $username = strtolower($user->name); // Make case-insensitive comparison

        // Get all files in storage/app/public/pdfs
        $allFiles = File::files(storage_path('app/public/pdfs'));

        // Filter files that contain the user's name
        $matchedFiles = collect($allFiles)->filter(function ($file) use ($username) {
            return str_contains(strtolower($file->getFilename()), $username);
        })->map(function ($file) {
            return $file->getFilename();
        });

        return view('user_files', ['files' => $matchedFiles]);
    }
}
