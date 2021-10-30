<?php

use Gglink\CrudPermission\Http\Controllers\LoginController;
use Gglink\CrudPermission\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::middleware(['web'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::post('/users/delete', [UserController::class, 'deleteUser'])->name('users.delete');
    Route::get('/login', [LoginController::class, 'loginForm'])->name('users.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('users.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('users.logout');
});

