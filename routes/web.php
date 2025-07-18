<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;


Route::get('/test-role', function () {
    return "Kamu punya role admin";
})->middleware(['auth', 'role:admin']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Produk
    Route::middleware('role:admin')->group(function () {
        Route::resource('produk', ProductController::class);

        // Stok
        Route::resource('stok', StokController::class)->only(['index','create','store']);
    });

    // Distribusi
    Route::resource('distribusi', DistribusiController::class)->only(['index','create','store']);

    // Laporan
    Route::get('/laporan/stok-akhir', [LaporanController::class, 'stokAkhir'])->name('laporan.stok');

    // Hanya admin yang bisa akses
    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});

    // Hanya cabang yang bisa akses
    Route::middleware(['auth', 'role:branch'])->group(function () {
        Route::get('/branch/dashboard', [BranchController::class, 'dashboard']);
    });

});


require __DIR__.'/auth.php';