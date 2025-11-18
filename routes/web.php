<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 return view('welcome');
});
//Route::get('/dashboard', function () {
 //return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard'); //bisa di hapus atau di biarkan
Route::middleware('auth')->group(function () {
 Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
 Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
 Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function () {
 Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
 //Route::resource('admin', AdminController::class);
 Route::resource('admin', AdminController::class)->parameters([
    'admin' => 'product'
]);

}); //tambahkan ini

Route::middleware(['auth','role:guru'])->group(function () {
 Route::get('/guru/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
}); //tambahkan ini

Route::middleware(['auth','role:siswa'])->group(function () {
 Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
}); //tambahkan ini

require __DIR__.'/auth.php';