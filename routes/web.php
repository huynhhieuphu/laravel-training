<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
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


Route::get('/register', [RegisterController::class, 'index'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'index'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::middleware('check.login')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/update-profile', [HomeController::class, 'updateProfile'])->name('update-profile');
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('/list-user', [HomeController::class, 'getAllUser'])->name('list-user')->middleware('is.admin');
});
