<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard berdasarkan role user
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'guru') {
        return redirect()->route('guru.dashboard');
    } else {
        return redirect()->route('siswa.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard: tampilkan semua user
Route::get('/admin/dashboard', [UserManagementController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

// Admin: proses update role user
Route::patch('/admin/users/{user}/role', [UserManagementController::class, 'updateRole'])
    ->middleware(['auth'])
    ->name('admin.users.updateRole');

// Guru dashboard
Route::get('/guru/dashboard', function () {
    return view('dashboard.guru');
})->middleware(['auth'])->name('guru.dashboard');

// Siswa dashboard
Route::get('/siswa/dashboard', function () {
    return view('dashboard.siswa');
})->middleware(['auth'])->name('siswa.dashboard');

// Profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route auth dari Laravel Breeze atau Jetstream
require __DIR__.'/auth.php';