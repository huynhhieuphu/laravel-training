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

Route::get('/', function() {
   return view('welcome');
});

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
    return (new Response('Demo response - set header'))
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

Route::get('/demo-response-set-json', function() {
    $contentArr = ['product_id' => 1, 'product_name' => 'Iphone 14 pro max',
        'product_price' => 28000000, 'product_color' => 'pink'
    ];
    return response()
        ->json($contentArr, 201)
        ->header('API-KEY', 'abc123');
});

Route::get('/form-login', function () {
    return view('login');
})->name('form.login');

Route::post('/login', function (Request $request) {
    if(!empty($request->input('password'))) {
        return redirect()->route('form.login')->with('message', 'Insert Thành công');
    }
//    return redirect('/form-login');

//    return back()->withInput();
    //Tương tự như:
    // $request->flash();
    // return redirect()->route('login');


//    return redirect()->route('form.login');
//    return redirect(route('form.login'));

//    return redirect()->route('form.login', ['id' => 1]);
//    return redirect(route('form.login', ['id' => 1]));

    return back()->withInput()->with('message', 'Insert Thất bại');
});


Route::get('/download-file', function (Request $request) {
    $file = $request->query('d');
    if(!empty($file)) {
        $file = trim($file);
        $fileName = basename($file);
        return response()->download($file, $fileName);
    }
})->name('download.file');


Route::get('/download-file-word', function (Request $request) {
    $file = $request->query('d');
    if(!empty($file)) {
        $file = trim($file);
        $fileName = basename($file);
        $header = [
            'Content-Type' => 'application/msword'
        ];
        return response()->download($file, $fileName, $header);
    }
})->name('download.file.word');
