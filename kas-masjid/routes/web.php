<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\KasKeluarController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kas_masuk', KasMasukController::class)->except(['show']);
    Route::resource('kas_keluar', KasKeluarController::class)->except(['show']);

    // Approval routes - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::post('kas_keluar/{kas_keluar}/approve', [KasKeluarController::class, 'approve'])
            ->name('kas_keluar.approve');
        Route::post('kas_keluar/{kas_keluar}/reject', [KasKeluarController::class, 'reject'])
            ->name('kas_keluar.reject');
    });
});

require __DIR__.'/auth.php';
