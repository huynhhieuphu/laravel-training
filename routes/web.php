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

// Dùng phương thức redirect() điều hướng
//Route::redirect('/demo-redirect', '/show-routing');
// tham số $status, thay đổi status code của $uri
Route::redirect('/demo-redirect', '/show-routing', 302);

// Dùng phương thức view() để hiển thị view chỉ hổ trợ thông qua http method get
Route::view('/home', 'welcome');
// tương tự như:
Route::get('/home', function () {
    return view('welcome');
});

// Dùng phương thức group() để gom các route thành 1 nhóm

// Cách 1: gọi phương thức group() truyền tham số thứ 1 bao gồm (prefix|route name|namespace|middleware|sub-domain)
Route::group([
    'prefix' => '/admin',
    'as' => 'admin.', //route name
], function(){
    Route::get('/dashboard', function () {
       return 'Trang dashboard';
    })->name('dashboard');

    Route::get('/settings', function () {
        return 'Trang Settings';
    })->name('setting');

    // Cách 2: gọi nhiều phương thức cuối cùng gọi phương thức group($callback)
    Route::prefix('/products')
        ->name('products.')
        ->middleware('check.permission')
        ->group(function () {
        Route::get('/', function () {
            return 'Danh sách sản phẩm';
        })->name('index');

        Route::get('/create', function () {
            return 'Tạo sản phẩm ';
        })->name('create');

        Route::get('/edit/{id}', function ($id) {
            return 'Hiển thị chi tiết sản phẩm: ' . $id;
        })->where('id', '\d+')->name('edit');
    });
});

// Route parameter
// Required parameters
Route::get('product/{slug}-{id}', function ($slug, $id) {
    return "ID: {$id} - Slug: {$slug}";
});

// Options parameters
Route::get('blog/{keyword?}', function ($keyword = null) {
    return "Keyword: {$keyword}";
});

// Regex Expression constraint
Route::get('type/{slug}/{id}', function ($slug, $id) {
    return "Slug: {$slug} - ID: {$id}";
})->where('slug', '.*')->where('id', '\d+');

Route::get('type/{slug}-{id}', function ($slug, $id) {
    return "ID: {$id} - Slug: {$slug}";
})->where('id', '[0-9]+')->where('slug', '.*');

// hoặc gom biểu thức chính quy trong 1 phương thức where()
Route::get('type/{slug}-{id}', function ($slug, $id) {
    return "ID: {$id} - Slug: {$slug}";
})->where(['id' => '[0-9]+', 'slug' => '.*']);


// Route to controller
Route::get('/home', 'App\Http\Controllers\HomeController@index');
// Định nghĩa property $namespace trong class RouteServiceProvider
// public $namespace = 'App\Http\Controllers';
Route::get('/san-pham', 'HomeController@getProducts');

// Từ laravel 7.x khuyên dùng cách này
Route::get('/tin-tuc', [HomeController::class, 'getNews']);

// Truyền tham số vào trong controller
Route::get('/san-pham/{slug}', [HomeController::class, 'detailProduct']);
