<?php

use App\Http\Controllers\Admin\ManageFasilitasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\PengaduanController;


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

Route::get('/pengaduan/create', [PengaduanController::class, 'create'])
     ->name('pengaduan.create');

Route::post('/pengaduan/store', [PengaduanController::class, 'store'])
     ->name('pengaduan.store');

