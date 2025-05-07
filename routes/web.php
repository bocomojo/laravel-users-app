<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SdoController;
use App\Http\Controllers\PdfListController;
use App\Http\Controllers\PdfUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
// Already included in `Route::resource('users', UserController::class);`
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::resource('sdo', SdoController::class);

Route::get('/pdfs', [PdfListController::class, 'index'])->name('documents.index');
Route::get('/pdf/upload', [PdfUploadController::class, 'create'])->name('pdf.upload');
Route::post('/pdf/upload', [PdfUploadController::class, 'store'])->name('pdf.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
