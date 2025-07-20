<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUserController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ManageUserController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [ManageUserController::class, 'index'])->name('manage-users.index');
    Route::get('/users/create', [ManageUserController::class, 'create'])->name('manage-users.create');
    Route::post('/users', [ManageUserController::class, 'store'])->name('manage-users.store');


});
