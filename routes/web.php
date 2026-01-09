<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LurahController;
use App\Http\Controllers\CamatController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| PUBLIC (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// Beranda → tampil 10 laporan terbaru
Route::get('/', [ReportController::class, 'index'])->name('home');

// Form buat laporan
Route::get('/lapor', [ReportController::class, 'create'])->name('report.create');

// Simpan laporan
Route::post('/lapor', [ReportController::class, 'store'])->name('report.store');


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (WAJIB UNTUK BREEZE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'superadmin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'camat') {
        return redirect()->route('camat.dashboard');
    }

    if ($user->role === 'lurah') {
        return redirect()->route('lurah.dashboard');
    }

    abort(403);
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // =====================
    // DASHBOARD LURAH
    // =====================
    Route::middleware('role:lurah')->prefix('lurah')->group(function () {
        Route::get('/dashboard', [LurahController::class, 'index'])
            ->name('lurah.dashboard');

        Route::get('/reports/{id}', [LurahController::class, 'show'])
            ->name('lurah.reports.show');

        Route::post('/reports/{id}/update', [LurahController::class, 'update'])
            ->name('lurah.reports.update');
    });

    // =====================
    // DASHBOARD CAMAT
    // =====================
    Route::middleware('role:camat')->prefix('camat')->group(function () {
        Route::get('/dashboard', [CamatController::class, 'index'])
            ->name('camat.dashboard');

        Route::get('/reports/{id}', [CamatController::class, 'show'])
            ->name('camat.reports.show');

        Route::post('/reports/{id}/update', [CamatController::class, 'update'])
            ->name('camat.reports.update');
    });

    // =====================
    // DASHBOARD SUPER ADMIN (BUPATI)
    // =====================
    Route::middleware('role:superadmin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'index'])
            ->name('admin.dashboard');
    });

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
