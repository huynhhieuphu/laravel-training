<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ShowDashboard;
use App\Http\Middleware\CheckAge;

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

Route::get('check-age/{age}', function ($age){
   return $age .' đủ tuổi truy cập trang web này';
})->middleware(CheckAge::class);

// Đăng ký middleware trong app/Kernel.php
Route::get('check-age/{age}', function ($age){
    return $age .' đủ tuổi truy cập trang web này v2';
})->middleware('checkAge');

// client
Route::get('/home', [HomeController::class, 'show']);

// admin
Route::prefix('admin')->name('admin.')->group(function() {

    //Tham số middleware
    Route::middleware('checkRole:staff')->prefix('category')->name('category.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/add', [AdminCategoryController::class, 'addCategory'])->name('add');
        Route::post('/add', [AdminCategoryController::class, 'handleAddCategory'])->name('handleAdd');
        Route::get('/show/{id}', [AdminCategoryController::class, 'showCategory'])->name('show')->where('id', '\d+');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'editCategory'])->name('edit')->where('id', '[0-9]+');
        Route::post('/update', [AdminCategoryController::class, 'handleUpdateCategory'])->name('handleUpdate');
        Route::post('/delete', [AdminCategoryController::class, 'deleteCategory'])->name('delete');
    });

    Route::get('/dashboard', ShowDashboard::class)->name('dashboard');
});
