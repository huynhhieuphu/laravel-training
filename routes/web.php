<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/relationship', [HomeController::class, 'index']);

Route::get('/through', [HomeController::class, 'through']);

// polymorphic relationships
Route::get('/poly-one', [HomeController::class, 'polyOne']);
Route::get('/poly-one-create', [HomeController::class, 'polyOneCreate']);

Route::get('/poly-many', [HomeController::class, 'polyMany']);
Route::get('/poly-many-create', [HomeController::class, 'polyManyCreate']);

Route::get('/poly-many-to-many', [HomeController::class, 'polyManyToMany']);
Route::get('/poly-many-to-many-create', [HomeController::class, 'polyManyToManyCreate']);

// eager loadding
Route::get('/eager-loading', [HomeController::class, 'eagerLoading']);
