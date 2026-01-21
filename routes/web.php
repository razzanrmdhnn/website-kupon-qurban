<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ManajemenAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Admin - Hanya untuk Super Admin
    Route::middleware(['super_admin'])->group(function () {
        Route::resource('manajemen-admin', ManajemenAdminController::class)->only(['index', 'store', 'update', 'destroy']);
    });
});

require __DIR__ . '/auth.php';