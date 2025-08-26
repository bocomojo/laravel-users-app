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
    TestMailController,
    UserController,
    UserFileController,
    JevController,
    ComplianceTrackingController,
    GmailController
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

// Gmail API Routes
Route::get('/gmail/auth', [GmailController::class, 'auth'])->name('gmail.auth');
Route::get('/gmail/callback', [GmailController::class, 'callback'])->name('gmail.callback');
Route::get('/gmail/sent', [GmailController::class, 'sent'])->name('gmail.sent');

Route::get('/gmail/message/{id}', [GmailController::class, 'show'])->name('gmail.message');
Route::get('/gmail/attachment/{messageId}/{attachmentId}/{filename}', [GmailController::class, 'downloadAttachment']);

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

// ---------------------
// Pre-Auditors
// ---------------------
Route::resource('pre-auditors', PreAuditorController::class);
Route::post('pre-auditors/import', [PreAuditorController::class, 'import'])->name('pre-auditors.import');
Route::get('pre-auditors/{auditor}/liquidations', [PreAuditorController::class, 'showLiquidations'])->name('pre-auditors.liquidations');
Route::get('pre-auditors/{id}/liquidations', [PreAuditorController::class, 'showLiquidations'])->name('pre-auditor.show');
Route::post('pre-auditor/liquidations/add-entry', [PreAuditorController::class, 'addEntry'])->name('pre-auditor.liquidations.add-entry');

Route::post('/jev/import', [JevController::class, 'import'])->name('jev.import');

Route::get('/liquidations/for-transmittal', [LiquidationController::class, 'forTransmittal'])->name('liquidation.for-transmittal');
Route::get('/liquidation/export-transmittal', [LiquidationController::class, 'exportTransmittal'])->name('liquidation.export.transmittal');
Route::post('/liquidation/assign-sack', [LiquidationController::class, 'assignSack'])->name('liquidation.assign.sack');
Route::post('/liquidations/transmit', [LiquidationController::class, 'bulkTransmit'])->name('liquidation.transmit.bulk');

// ---------------------
// Cash Advance & SDO (Grouped)
// ---------------------
Route::prefix('sdo')->name('sdo.')->group(function () {
    Route::resource('cash_advance', CashAdvanceController::class)->except(['edit', 'destroy']);

    // ✅ Explicit edit/update inside the group for proper route names
    Route::get('cash_advance/{id}/edit', [CashAdvanceController::class, 'edit'])->name('cash_advance.edit');
    Route::put('cash_advance/{id}', [CashAdvanceController::class, 'update'])->name('cash_advance.update');

    Route::get('cash-advances/all', [CashAdvanceController::class, 'cashAdvances'])->name('cash_advance.cash_advances');
    Route::post('cash-advance/import', [CashAdvanceController::class, 'import'])->name('cash_advance.import');

    Route::get('cash_advance/index', [SdoController::class, 'sdoCashAdvance'])->name('cash.advance');

    Route::get('bonded/create', [BondedOfficialController::class, 'create'])->name('bonded.create');
    Route::get('bonded_officials', [BondedOfficialController::class, 'index'])->name('bonded.index');
    Route::put('bonded-officials/{id}', [BondedOfficialController::class, 'update'])->name('bonded-officials.update');

    Route::get('export', [SdoController::class, 'export'])->name('export');
    Route::post('import', [SdoController::class, 'import'])->name('import');
});
Route::resource('sdo', SdoController::class);

// ---------------------
// Specific Cash Advance Utility Route
// ---------------------
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
// Test & Miscellaneous
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
// Pre-Audit Dashboard
// ---------------------
Route::get('/pre-audit/dashboard', [PreAuditorController::class, 'dashboard'])->name('preaudit.dashboard');

// ---------------------
// Auth
// ---------------------
require __DIR__.'/auth.php';
