<?php

namespace App\Http\Controllers;

use App\Models\EloquentHistory;
use App\Models\EloquentSupplier;
use App\Models\EloquentUser;
use App\Models\TrainingAvatar;
use App\Models\TrainingCategory;
use App\Models\TrainingPost;
use App\Models\TrainingUser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // one - one
        $user = TrainingUser::find(1);
//        dd($user->avatar);

        // inverse
        $avatar = TrainingAvatar::find(1);
//        dd($avatar->user);

        // one - many
        $user = TrainingUser::find(1);
//        dd($user->posts);
//
//        dd($user->post);
//        dd($user->newPost);

        // inverse
        $post = TrainingPost::find(1);
//        dd($post->user);

        // many - many
        $post = TrainingPost::find(1);
//        dd($post->categories);

        $category = TrainingCategory::find(3);
//        dd($category->posts);

        // Truy cập bảng trung gian (vd: training_categories_posts)
//        foreach ($post->categories as $category) {
//            $data[] = $category->pivot->category_id;
//        }
//        dd($data);

//        // customize pivot
//        foreach ($category->posts as $post) {
//            $arrPost[] = $post->detail->post_id;
//        }
//        dd($arrPost);

        // method attach(), detach(), sync()
        $post = TrainingPost::find(1);

//        $post->categories()->attach([4, 5]);
//        $post->categories()->detach([4, 5]);
//        $post->categories()->sync([3, 4, 5]);


        // pivot
//        dd($post->categories);

//        $post = TrainingPost::find(6);
//        $post->categories()->sync([
//            2 => ['value_tmp' => 'abc'],
//            4 => ['value_tmp' => 'xyz']
//        ]);
    }

    public function through()
    {
        $supplier = EloquentSupplier::find(1);
        dd($supplier->userHistory);
    }
}
