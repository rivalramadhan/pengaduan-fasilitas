<?php

use App\Http\Controllers\Admin\ManageFasilitasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ManageUserController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [ManageUserController::class, 'index'])->name('manage-users.index');
    Route::get('/users/create', [ManageUserController::class, 'create'])->name('manage-users.create');
    Route::post('/users', [ManageUserController::class, 'store'])->name('manage-users.store');
    Route::get('/fasilitas', [ManageFasilitasController::class, 'index'])->name('manage-fasilitas.index');

});

Route::get('/login', [LoginController::class, 'create'])->name('login');

Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/laporan-saya', [PengaduanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan-saya/{id}', [PengaduanController::class, 'show'])->name('laporan.show');
   
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
