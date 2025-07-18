<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    ProductController,
    StokController,
    DistribusiController,
    LaporanController,
    AdminController,
    BranchController
};
use Illuminate\Support\Facades\Auth;

// Halaman utama

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', fn() => view('welcome'))->name('home');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('produk', ProductController::class);
    Route::resource('stok', StokController::class)->only(['index', 'create', 'store']);
});

// Dashboard Cabang
Route::middleware(['auth', 'role:branch'])->group(function () {
    Route::get('/branch/dashboard', [BranchController::class, 'dashboard'])->name('branch.dashboard');
});

// Akses Umum Setelah Login
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Distribusi
    Route::resource('distribusi', DistribusiController::class)->only(['index', 'create', 'store']);

    // Laporan
    Route::get('/laporan/stok-akhir', [LaporanController::class, 'stokAkhir'])->name('laporan.stok');
});

// Role tester
Route::get('/test-role', fn() => 'Kamu punya role admin')->middleware(['auth', 'role:admin']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

// Fallback atau Auth
require __DIR__ . '/auth.php';