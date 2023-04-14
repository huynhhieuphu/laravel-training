<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::prefix('/dashboard')->name('dashboard.')->group(function(){
    Route::prefix('/users')->name('users.')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/add', [UserController::class, 'add'])->name('add');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/update', [UserController::class, 'update'])->name('update');
        Route::post('/remove', [UserController::class, 'remove'])->name('remove');
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        Route::post('/delete', [UserController::class, 'delete'])->name('delete');
        Route::post('/rollback', [UserController::class, 'rollback'])->name('rollback');
    });
});
