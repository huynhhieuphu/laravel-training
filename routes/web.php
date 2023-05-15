<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
Route::view('/', 'welcome');

Auth::routes(['verify' => true]);

Route::middleware(['password.confirm', 'verified'])
    ->get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');


Route::get('/log-info', [HomeController::class, 'logInfo']);

Route::get('/check-login', function (){
    if (Auth::check()){
        return 'da dang nhap';
    }
    return 'chua dang nhap';
});
