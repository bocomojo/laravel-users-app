<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PdfListController extends Controller
{
    public function index(Request $request)
    {
        $search = strtolower($request->query('search', ''));

        // Fetch all files in the "pdfs" directory
        $allFiles = Storage::disk('public')->files('pdfs');

        // Filter by search if provided
        $filteredFiles = array_filter($allFiles, function ($file) use ($search) {
            return $search === '' || str_contains(strtolower(basename($file)), $search);
        });

        // Convert to array for pagination
        $filteredFiles = array_values($filteredFiles);

        // Paginate results manually
        $perPage = 9;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedFiles = new LengthAwarePaginator(
            array_slice($filteredFiles, ($currentPage - 1) * $perPage, $perPage),
            count($filteredFiles),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('documents.index', [
            'files' => $paginatedFiles,
            'search' => $search,
        ]);
    }
}
