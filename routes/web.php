<?php

use App\Http\Controllers\Admin\ManageFasilitasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ManagePengaduanController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ManagePengaduanController::class, 'index'])->name('dashboard');
    Route::get('/laporan/{pengaduan}', [ManagePengaduanController::class, 'show'])->name('laporan.show');
    Route::put('/laporan/{pengaduan}', [ManagePengaduanController::class, 'update'])->name('laporan.update');
    Route::get('/users', [ManageUserController::class, 'index'])->name('manage-users.index');
    Route::get('/users/create', [ManageUserController::class, 'create'])->name('manage-users.create');
    Route::post('/users', [ManageUserController::class, 'store'])->name('manage-users.store');
    Route::delete('/users/{user}', [ManageUserController::class, 'destroy'])->name('manage-users.destroy');
    Route::get('/fasilitas', [ManageFasilitasController::class, 'index'])->name('manage-fasilitas.index');
    Route::post('/fasilitas', [ManageFasilitasController::class, 'store'])->name('manage-fasilitas.store');
    Route::delete('/fasilitas/{fasilitas}', [ManageFasilitasController::class, 'destroy'])->name('manage-fasilitas.destroy'); // <-- TAMBAHKAN INI
});

Route::middleware('auth')->group(function () {
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/laporan-saya', [PengaduanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan-saya/{id}', [PengaduanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{pengaduan}', [PengaduanController::class, 'update'])->name('laporan.update');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
