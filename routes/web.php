<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::get('/category/create', [CategoryController::class, 'index']);
Route::post('/category/create', [CategoryController::class, 'add']);

Route::get('/product/create', [ProductController::class, 'index']);
Route::post('/product/create', [ProductController::class, 'add']);

Route::get('/post', [PostController::class, 'index']);
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post/create', [PostController::class, 'add']);

Route::get('/comment', [CommentController::class, 'create']);
Route::post('/comment', [CommentController::class, 'add']);
