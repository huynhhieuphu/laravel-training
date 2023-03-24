<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ShowDashboard;

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

// client
Route::get('/home', [HomeController::class, 'show']);

// admin
Route::prefix('admin')->name('admin.')->group(function() {

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/add', [AdminCategoryController::class, 'addCategory'])->name('add');
        Route::post('/add', [AdminCategoryController::class, 'handleAddCategory'])->name('handleAdd');
        Route::get('/show/{id}', [AdminCategoryController::class, 'showCategory'])->name('show')->where('id', '\d+');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'editCategory'])->name('edit')->where('id', '[0-9]+');
        Route::post('/update', [AdminCategoryController::class, 'handleUpdateCategory'])->name('handleUpdate');
        Route::post('/delete', [AdminCategoryController::class, 'deleteCategory'])->name('delete');
    });

    //Single Action Controller
    Route::get('/dashboard', ShowDashboard::class)->name('dashboard');
});
