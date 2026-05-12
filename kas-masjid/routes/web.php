<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\MasjidSettingController;
use App\Http\Controllers\TransparansiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kas_masuk', KasMasukController::class)->except(['show']);
    Route::resource('kas_keluar', KasKeluarController::class)->except(['show']);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/pdf/{type}', [LaporanController::class, 'exportPdf'])->name('laporan.export');

    // Approval routes - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::post('kas_keluar/{kas_keluar}/approve', [KasKeluarController::class, 'approve'])
            ->name('kas_keluar.approve');
        Route::post('kas_keluar/{kas_keluar}/reject', [KasKeluarController::class, 'reject'])
            ->name('kas_keluar.reject');
        Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit_logs.index');
        Route::get('settings/masjid', [MasjidSettingController::class, 'edit'])->name('settings.masjid.edit');
        Route::put('settings/masjid', [MasjidSettingController::class, 'update'])->name('settings.masjid.update');
    });
});

require __DIR__.'/auth.php';
