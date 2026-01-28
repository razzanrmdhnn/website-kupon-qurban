<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ManajemenAdminController;
use App\Http\Controllers\Admin\KuponController;
use App\Http\Controllers\Admin\ScanKuponController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');
    })->name('dashboard');

    // Kelola Kupon
    Route::resource('kelola-kupon', KuponController::class)->only(['index', 'store', 'show', 'destroy'])->parameters(['kelola-kupon' => 'kupon']);

    // Scan Kupon
    Route::get('/scan-kupon', [ScanKuponController::class, 'index'])->name('scan-kupon.index');
    Route::post('/scan-kupon/check', [ScanKuponController::class, 'checkKupon'])->name('scan-kupon.check');
    Route::post('/scan-kupon/use', [ScanKuponController::class, 'useKupon'])->name('scan-kupon.use');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Admin - Hanya untuk Super Admin
    Route::middleware(['super_admin'])->group(function () {
        Route::resource('manajemen-admin', ManajemenAdminController::class)->only(['index', 'store', 'update', 'destroy']);
    });
});

require __DIR__ . '/auth.php';