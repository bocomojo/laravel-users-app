<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SdoController;
use App\Http\Controllers\PdfListController;
use App\Http\Controllers\PdfUploadController;
use App\Http\Controllers\UserFileController;
use App\Http\Controllers\ComplianceFileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestMailController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\LiquidationController;

Route::get('/liquidation', [LiquidationController::class, 'index'])->name('liquidation.index');

Route::get('/sdo/cash_advance/create', [CashAdvanceController::class, 'create'])->name('sdo.cash_advance.create');
Route::post('/sdo/cash_advance', [CashAdvanceController::class, 'store'])->name('sdo.cash_advance.store');

Route::get('/send-test-email', [TestMailController::class, 'send'])->name('send.test.email');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
// Already included in `Route::resource('users', UserController::class);`
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::resource('sdo', SdoController::class);

Route::get('/compliance', [ComplianceFileController::class, 'index'])->name('sdo.compliance.index');

Route::get('/my-files', [UserFileController::class, 'index'])
    ->middleware(['auth'])
    ->name('user_files');

Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/staff-section', [StaffController::class, 'index'])->name('staff.section');
});

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
