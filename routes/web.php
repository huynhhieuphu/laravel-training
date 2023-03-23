<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return 'Home page';
});

Route::get('/show-routing', function () {
    return view('demo-routing');
});

// get => mục đích: Lấy tài nguyên
Route::get('/demo-routing', function () {
    return 'This is method GET';
});

// Ngoài trừ http-method: get và option, các phương thức còn lại bắt buộc phải token
// post => mục đích: Tạo tài nguyên
Route::post('/demo-routing', function () {
   return 'This is method POST';
});

// put => mục đích: Cập nhật tài nguyên
Route::put('/demo-routing', function () {
   return 'This is method PUT';
});

// patch => mục đích: Cập nhật một phần tài nguyên
Route::patch('/demo-routing', function () {
   return 'This is method PATCH';
});

// delete => mục đích: Xoá tài nguyên
Route::delete('/demo-routing', function () {
   return 'This is method DELETE';
});

// match => cho phép chạy các phương thức HTTP request chỉ định
Route::match(['get', 'post'],'/get-or-method',function() {
    return 'Cho phép chạy phương thức GET hoặc POST';
});

// any => cho phép chạy bất kỳ phương thức HTTP request
Route::any('/demo-routing', function() {
    return 'Chạy bất kỳ phương thức HTTP request nào cũng được';
});
