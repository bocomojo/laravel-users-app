<?php

use Illuminate\Support\Facades\Route;
use App\Models\CashAdvance;
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
    PreAuditorController,
    ProfileController,
    SdoController,
    StaffController,
    TestMailController,
    UserController,
    UserFileController,
    LiquidatedReportController
};
use Spatie\Permission\Middleware\{
    PermissionMiddleware,
    RoleMiddleware,
    RoleOrPermissionMiddleware
};

// ---------------------
// Middleware Aliases
// ---------------------
Route::aliasMiddleware('role', RoleMiddleware::class);
Route::aliasMiddleware('permission', PermissionMiddleware::class);
Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);

// ---------------------
// Welcome & Dashboard
// ---------------------
Route::get('/', fn () => view('welcome'));
Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

// ---------------------
// PAP
// ---------------------
Route::resource('pap', PapController::class);
Route::match(['get', 'post'], '/pap/import', [PapController::class, 'import'])->name('pap.import');

// ---------------------
// Certificates
// ---------------------
Route::get('/certificate/print/{id}', [CertificateController::class, 'print'])->name('certificate.print');

// ---------------------
// Liquidation
// ---------------------
Route::prefix('liquidation')->group(function () {
    Route::get('create', [LiquidationController::class, 'create'])->name('liquidation.create');
    Route::get('condensed-export', [LiquidationController::class, 'condensedExport'])->name('liquidation.condensed.export');
    Route::get('cash-advance/{cash_advance_id}', [LiquidationController::class, 'showByCashAdvanceId'])->name('liquidation.show.cash');
    Route::get('check/{check_number}', [LiquidationController::class, 'showByCheckNumber'])->name('liquidation.byCheckNumber');
    Route::post('import', [LiquidationController::class, 'import'])->name('liquidation.import');
    Route::post('update-inline/{id}', [LiquidationController::class, 'inlineUpdate']);
    Route::patch('{id}/approve', [LiquidationController::class, 'approve'])->name('liquidation.approve');
    Route::patch('{id}/mark-for-approval', [LiquidationController::class, 'markForApproval'])->name('liquidation.markForApproval');
    Route::patch('mass-approve', [LiquidationController::class, 'massApprove'])->name('liquidation.massApprove');
    Route::patch('{liquidation}/complete', [LiquidationController::class, 'markComplete'])->name('liquidation.complete');
    Route::patch('{liquidation}/set-draft', [LiquidationController::class, 'setAsDraft'])->name('liquidation.set-draft');
    Route::get('export/{cashAdvanceId}', [LiquidationController::class, 'export'])->name('liquidation.export');
    Route::get('sdo/{sdoId}/cash-advance', [LiquidationController::class, 'getOngoingCashAdvance']);
});
Route::resource('liquidation', LiquidationController::class)->only([
    'create', 'store', 'show', 'index', 'edit', 'update', 'destroy'
]);

// Liquidated Reports
Route::resource('liquidated_reports', LiquidatedReportController::class);

// ---------------------
// Pre-Auditors
// ---------------------
Route::resource('pre-auditors', PreAuditorController::class);
Route::post('pre-auditors/import', [PreAuditorController::class, 'import'])->name('pre-auditors.import');
Route::get('pre-auditors/{auditor}/liquidations', [PreAuditorController::class, 'showLiquidations'])->name('pre-auditors.liquidations');
Route::get('pre-auditors/{id}/liquidations', [PreAuditorController::class, 'showLiquidations'])->name('pre-auditor.show');
Route::post('pre-auditor/liquidations/add-entry', [PreAuditorController::class, 'addEntry'])->name('pre-auditor.liquidations.add-entry');

// ---------------------
// Cash Advance & SDO
// ---------------------
Route::prefix('sdo')->name('sdo.')->group(function () {
    Route::resource('cash_advance', CashAdvanceController::class)->except(['edit', 'destroy']);
    Route::get('cash-advances/all', [CashAdvanceController::class, 'cashAdvances'])->name('cash_advance.cash_advances');
    Route::get('cash-advance/create', [CashAdvanceController::class, 'create'])->name('cash_advance.create');
    Route::post('cash-advance/import', [CashAdvanceController::class, 'import'])->name('cash_advance.import');

    Route::get('cash_advance/index', [SdoController::class, 'sdoCashAdvance'])->name('cash.advance');
    Route::get('bonded/create', [BondedOfficialController::class, 'create'])->name('bonded.create');
    Route::get('bonded_officials', [BondedOfficialController::class, 'index'])->name('bonded.index');
    Route::get('export', [SdoController::class, 'export'])->name('export');
    Route::post('import', [SdoController::class, 'import'])->name('import');
});
Route::resource('sdo', SdoController::class);

// Specific update route
Route::put('/cash-advance/{id}/update-dates', [CashAdvanceController::class, 'updateDates'])->name('cash-advance.update-dates');

// ---------------------
// Users
// ---------------------
Route::resource('users', UserController::class);
Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

// ---------------------
// Compliance Files
// ---------------------
Route::prefix('compliance')->name('sdo.compliance.')->group(function () {
    Route::get('/', [ComplianceFileController::class, 'index'])->name('index');
    Route::get('create', [ComplianceFileController::class, 'create'])->name('create');
    Route::post('/', [ComplianceFileController::class, 'store'])->name('store');
});

// ---------------------
// User Files
// ---------------------
Route::get('/my-files', [UserFileController::class, 'index'])->middleware('auth')->name('user_files');

// ---------------------
// PDF Documents
// ---------------------
Route::get('/pdfs', [PdfListController::class, 'index'])->name('documents.index');
Route::get('/pdf/upload', [PdfUploadController::class, 'create'])->name('pdf.upload');
Route::post('/pdf/upload', [PdfUploadController::class, 'store'])->name('pdf.store');

// ---------------------
// Profile
// ---------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------------
// Admin Dashboard
// ---------------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// ---------------------
// Staff Section
// ---------------------
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/staff-section', [StaffController::class, 'index'])->name('staff.section');
});

// ---------------------
// Miscellaneous
// ---------------------
Route::get('/send-test-email', [TestMailController::class, 'send'])->name('send.test.email');

// ---------------------
// AJAX API
// ---------------------
Route::middleware('auth')->get('/api/latest-ongoing-cash-advance/{sdoId}', function ($sdoId) {
    $cashAdvance = CashAdvance::where('sdo_id', $sdoId)
        ->where('status', 'Ongoing')
        ->latest()
        ->first();

    return $cashAdvance
        ? response()->json($cashAdvance)
        : response()->json(['message' => 'No ongoing cash advance found.'], 404);
});

// ---------------------
// Auth Routes
// ---------------------
require __DIR__.'/auth.php';
