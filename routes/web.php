<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FormController;

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

Route::get('/foo/bar', function (Request $request) {
    // phương thức path() lấy ra đường dẫn
   return $request->path();
});

Route::get('/admin/posts', function (Request $request) {
    // phương thức is() kiểm tra đường dẫn tồn tại không ?
//   if($request->is('admin/posts')) {
//       return 'Trang Admin - Post';
//   }

    if($request->is('admin/*')) {
        return 'Trang Admin - Post';
    }
});

// Phương thức url() lấy ra đường dẫn URL không có chứ query string
// Phương thức fullUrl() lấy ra toàn bộ đường dẫn URL bao gồm query string
Route::fallback(function(Request $request) {
   dd([
       $request->url(),
       $request->fullUrl()
   ]);
});

Route::get('/', function (Request $request) {
    // Phương thức method() lấy ra tên phương thức HTTP (thường check Route::any hoặc Route::match)
    echo 'Method HTTP: ' . $request->method() . '<br>';

    if($request->isMethod('GET')) {
        echo 'This is GET method HTTP';
    }
});

Route::get('/', [FormController::class, 'show'])->name('form.show');
Route::post('/post', [FormController::class, 'store'])->name('form.store');
Route::get('/show-product', [FormController::class, 'showProduct'])->name('show.product');
Route::post('/post-product', [FormController::class, 'storeProduct'])->name('store.product');


Route::get('/book', function (Request $request) {
    // ?search=duong+xua+may+tran&author=thich+nhat+hanh
    // Lấy giá trị query string
   dd($request->query('search'));
});

Route::get('/login', [FormController::class, 'login'])->name('form.login');
Route::post('/handle-login', [FormController::class, 'handleLogin'])->name('form.handle.login');

Route::get('/file', [FormController::class, 'file'])->name('form.file');
Route::post('/handle-file', [FormController::class, 'handleFile'])->name('form.handle.file');
