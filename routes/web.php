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
use App\Models\CashAdvance;

// Register role/permission middleware
Route::aliasMiddleware('role', RoleMiddleware::class);
Route::aliasMiddleware('permission', PermissionMiddleware::class);
Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);

// Welcome page
Route::get('/', fn () => view('welcome'));

// Dashboard
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ================= PAP ==================
Route::resource('pap', PapController::class);
Route::match(['get', 'post'], '/pap/import', [PapController::class, 'import'])->name('pap.import');

// ============= CERTIFICATES =============
Route::get('/certificate/print/{id}', [CertificateController::class, 'print'])->name('certificate.print');

Route::get('/liquidation/condensed-export', [LiquidationController::class, 'condensedExport'])->name('liquidation.condensed.export');
Route::get('/liquidation/cash-advance/{cash_advance_id}', [LiquidationController::class, 'showByCashAdvanceId'])->name('liquidation.show.cash');
Route::get('/liquidation/check/{check_number}', [LiquidationController::class, 'showByCheckNumber'])->name('liquidation.byCheckNumber');

// ============= LIQUIDATION ==============
Route::resource('liquidation', LiquidationController::class)->only([
    'create', 'store', 'show', 'index', 'edit', 'update', 'destroy'
]);
Route::get('/liquidation/export/{cashAdvanceId}', [LiquidationController::class, 'export'])->name('liquidation.export');

// ========= CASH ADVANCE + SDO ==========
Route::prefix('sdo')->name('sdo.')->group(function () {
    Route::resource('cash_advance', CashAdvanceController::class)->except(['edit', 'destroy']);

    // ✅ New route for listing all cash advances
    Route::get('cash-advances/all', [CashAdvanceController::class, 'cashAdvances'])
        ->name('cash_advance.cash_advances');

    Route::get('bonded/create', [BondedOfficialController::class, 'create'])->name('bonded.create');
    Route::get('bonded_officials', [BondedOfficialController::class, 'index'])->name('bonded.index');

    Route::get('export', [SdoController::class, 'export'])->name('export');
    Route::post('import', [SdoController::class, 'import'])->name('import');
});

// Specific update-only route
Route::put('/cash-advance/{id}/update-dates', [CashAdvanceController::class, 'updateDates'])->name('cash-advance.update-dates');

// =============== USERS ==================
Route::resource('users', UserController::class);
Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

// =============== SDO DB =================
Route::resource('sdo', SdoController::class);

// ========== COMPLIANCE FILES ============
Route::prefix('compliance')->name('sdo.compliance.')->group(function () {
    Route::get('/', [ComplianceFileController::class, 'index'])->name('index');
    Route::get('create', [ComplianceFileController::class, 'create'])->name('create');
    Route::post('/', [ComplianceFileController::class, 'store'])->name('store');
});

// ========== USER FILES ==================
Route::get('/my-files', [UserFileController::class, 'index'])->middleware('auth')->name('user_files');

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

// ============= ADMIN DASHBOARD ==========
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// ============ STAFF SECTION =============
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/staff-section', [StaffController::class, 'index'])->name('staff.section');
});

// ========== MISC TEST ROUTE ============
Route::get('/send-test-email', [TestMailController::class, 'send'])->name('send.test.email');

// ========== AUTH ROUTES ================
require __DIR__.'/auth.php';

// ========== AJAX API ROUTE =============
Route::middleware('auth')->get('/api/latest-ongoing-cash-advance/{sdoId}', function ($sdoId) {
    $cashAdvance = CashAdvance::where('sdo_id', $sdoId)
        ->where('status', 'Ongoing')
        ->latest()
        ->first();

    return $cashAdvance
        ? response()->json($cashAdvance)
        : response()->json(['message' => 'No ongoing cash advance found.'], 404);
});
