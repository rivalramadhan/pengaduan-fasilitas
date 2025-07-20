<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUserController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [ManageUserController::class, 'index'])->name('manage-users.index');

});
