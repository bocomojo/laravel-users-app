<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    BondedOfficialController,
    CashAdvanceController,
    CertificateController,
    ComplianceFileController,
    LiquidationController,
    PapController,
    PdfListController,
    PdfUploadController,
    ProfileController,
    SdoController,
    StaffController,
    TestMailController,
    UserController,
    UserFileController
};
use Spatie\Permission\Middleware\{PermissionMiddleware, RoleOrPermissionMiddleware, RoleMiddleware};

// Register role/permission middlewares
Route::aliasMiddleware('role', RoleMiddleware::class);
Route::aliasMiddleware('permission', PermissionMiddleware::class);
Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);

// Default welcome route
Route::get('/', fn() => view('welcome'));

// Dashboard (requires auth + verification)
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ================= PAP ==================
Route::resource('pap', PapController::class);
Route::get('/pap/import', [PapController::class, 'import'])->name('pap.import');
Route::post('/pap/import', [PapController::class, 'import'])->name('pap.import');

// ================= CERTIFICATE ==========
Route::get('/certificate/print/{id}', [CertificateController::class, 'print'])->name('certificate.print');

// ============= LIQUIDATION ==============
Route::get('/liquidation/export/{cashAdvanceId}', [LiquidationController::class, 'export'])->name('liquidation.export');
Route::resource('liquidation', LiquidationController::class)->only(['create', 'store', 'show', 'index', 'edit', 'update', 'destroy']);
Route::get('/liquidation', [LiquidationController::class, 'index'])->name('liquidation.index');
Route::get('/liquidation/create', [LiquidationController::class, 'create'])->name('liquidation.create');


// =========== CASH ADVANCE (SDO) =========
Route::prefix('sdo')->name('sdo.')->group(function () {
    Route::resource('cash_advance', CashAdvanceController::class)->except(['edit', 'destroy']);
    Route::get('bonded/create', [BondedOfficialController::class, 'create'])->name('bonded.create');
    Route::get('bonded_officials', [BondedOfficialController::class, 'index'])->name('bonded.index');
    Route::get('export', [SdoController::class, 'export'])->name('export');
    Route::post('import', [SdoController::class, 'import'])->name('import');
});

// Cash Advance update-only route
Route::put('/cash-advance/{id}/update-dates', [CashAdvanceController::class, 'updateDates'])->name('cash-advance.update-dates');

// =============== USERS ==================
Route::resource('users', UserController::class);
Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

// =============== SDO DB =================
Route::resource('sdo', SdoController::class);

// ========== COMPLIANCE FILES ============
Route::get('/compliance', [ComplianceFileController::class, 'index'])->name('sdo.compliance.index');
Route::get('/compliance/create', [ComplianceFileController::class, 'create'])->name('sdo.compliance.create');
Route::post('/compliance', [ComplianceFileController::class, 'store'])->name('sdo.compliance.store');

// ========== USER FILES ==================
Route::get('/my-files', [UserFileController::class, 'index'])
    ->middleware('auth')
    ->name('user_files');

// ============= PDF DOCUMENTS ============
Route::get('/pdfs', [PdfListController::class, 'index'])->name('documents.index');
Route::get('/pdf/upload', [PdfUploadController::class, 'create'])->name('pdf.upload');
Route::post('/pdf/upload', [PdfUploadController::class, 'store'])->name('pdf.store');

// ========== PROFILE SETTINGS ============
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============= ADMIN/STUDENT DASHBOARDS ============
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/staff-section', [StaffController::class, 'index'])->name('staff.section');
});

// ========== MISC TEST ==========
Route::get('/send-test-email', [TestMailController::class, 'send'])->name('send.test.email');

// ========== AUTH ROUTES =========
require __DIR__.'/auth.php';
