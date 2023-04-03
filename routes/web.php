<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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

Route::get('/demo-response', function() {
   return 'Hello world';
});

Route::get('/demo-response-array', function() {
    $contentArr = ['product_id' => 1, 'product_name' => 'Iphone 14 pro max',
        'product_price' => 28000000, 'product_color' => 'pink'
    ];
    return $contentArr;
});

Route::get('/demo-response-view', function () {
    return view('demo-response');
});

Route::get('/demo-class-response', function () {
//    dd(new Response());
    return new Response('Demo class response');
});

Route::get('/demo-helper-response', function () {
//    dd(response());
    return response('Demo Helper response');
});

Route::get('/demo-response-status-codes', function() {
    return response('Demo Helper response', 201);
});

Route::get('/demo-response-set-header', function() {
    return response('Demo response - set header')
        ->header('Content-type', 'text/plain')
        ->header('x-Header-One', 'value header one')
        ->header('x-Header-Two', 'value header two');
});

Route::get('/demo-response-set-cookie', function () {
   return (new Response('Demo response - set cookie'))
       ->cookie('name', 'value', 30);
    // name : key cookie
    // value : giá trị
    // 30 : thời gian tồn tại 30 phút (đơn vị là phút) - mặc định không gán xem như 1 session
});

Route::get('/get-cookie', function (Request $request) {
   return $request->cookie('name');
});

Route::get('demo-response-set-view', function () {
    $data = ['title' => 'Demo Response - set view'];
    return response()
        ->view('home', $data)
        ->header('Content-Type', 'text/html');
});
