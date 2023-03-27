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

//Load view - Route
Route::get('/', function () {
    $data = ['title' => 'Laravel Training', 'content' => 'View Laravel'];
    // truyền tham số vào view
    return view('welcome', $data);
});

// Load view - controller
Route::get('/home', [HomeController::class, 'index']);
Route::get('/export-pdf', [HomeController::class, 'exportPDF']);
