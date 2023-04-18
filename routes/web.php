<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\PostController;

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


Route::get('/all', function () {
    $posts = Post::all();
    foreach ($posts as $post) {
        echo $post->post_title . '<br>';
    }
});

Route::get('/condition', function () {
    $posts = Post::where('post_id', '>', 1)
        ->orderBy('post_id', 'desc')
        ->limit(3)
        ->get();
    dd($posts);
});

route::get('/collection', function () {
    $posts = Post::all();
    $posts = $posts->reject(function ($post) {
        return $post->post_publish;
    });
    //Giải thích: câu lệnh trên mang ý nghĩa lấy ra tất cả các bài post chưa publish
    dd($posts);
});

route::get('/chunk', function () {
    Post::chunk(3, function ($posts) {
        foreach ($posts as $post) {
            echo $post->post_title . '<br>';
        }
        echo 'Hết 1 chunk' . '<br>';
    });
});

route::get('/cursor', function () {
    foreach (Post::where('post_publish', 1)->cursor() as $post) {
        echo $post->post_title . '<br>';
    }
});

route::get('/find', function () {
    $post = Post::find(3); // trả về một model instance
    dd($post);
});

route::get('/first', function () {
    $post = Post::where('post_publish', 1)->first();
    // hoặc lấy về một bản ghi đầu tiên trong list model instance trả về
    dd($post);
});

route::get('/exception', function () {
    try {
        $post = Post::findOrFail(9999);
        // hoặc
        $post = Post::where('post_publish', 3)->firstOrFail();
    } catch(ModelNotFoundException $e) {
        echo $e->getMessage();
    }
});

route::get('/count', function () {
    $count = Post::where('post_publish', 1)->count();
    echo $count;
});

Route::prefix('/post')->name('post.')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
    Route::post('/update', [PostController::class, 'update'])->name('update');
    Route::get('/archive', [PostController::class, 'archive'])->name('archive');
    Route::post('/delete/{post}', [PostController::class, 'delete'])->name('delete')->withTrashed();
    Route::post('/restore/{post}', [PostController::class, 'restore'])->name('restore')->withTrashed();
});

Route::get('/mass-update', function () {
    Post::where('post_publish', 0)
        ->update(['post_publish' => 1]);
});
