<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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

Route::prefix('/customer')->name('customer.')->group(function(){
    Route::get('/', [CustomerController::class, 'index'])->name('list');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/add', [CustomerController::class, 'add'])->name('add');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
    Route::post('/update', [CustomerController::class, 'update'])->name('update');
    Route::post('/delete', [CustomerController::class, 'delete'])->name('delete');
});
