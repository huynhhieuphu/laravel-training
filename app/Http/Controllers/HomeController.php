<?php

namespace App\Http\Controllers;

use App\Models\EloquentHistory;
use App\Models\EloquentPost;
use App\Models\EloquentSupplier;
use App\Models\EloquentTeam;
use App\Models\EloquentUser;
use App\Models\TrainingAvatar;
use App\Models\TrainingCategory;
use App\Models\TrainingPost;
use App\Models\TrainingUser;
use App\Models\EloquentImage;
use App\Models\User;
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
        // hasOneThrough
        $supplier = EloquentSupplier::findOrFail(1);

        // Truy cập thông thường
//        dd($supplier->user->history);

        // Truy cập thông qua bảng trung gian
//        dd($supplier->userHistory);

        // hasManyThrough
        $team = EloquentTeam::findOrFail(2);

//        foreach ($team->users as $user) {
//            $dataTeamGoals[] = $user->goals;
//        }
//        dd($dataTeamGoals);
        // Truy cập thông qua bảng trung gian
        dd($team->goals);
//        dd($team->goal);
    }

    public function polyOne() {
        $user = EloquentUser::find(1);
//        dd($user->image);

        $post = EloquentPost::find(2);
//        dd($post->image);

        //inverse
        $image = EloquentImage::find(2);
//        dd($image->imageable);
        // Lưu ý: không nên truy cập ngược vì không biết object là gì...
        // Quan hệ đa hình chỉ nên truy cập xuôi.
    }

    public function polyCreateOne()
    {
//        $imageUser = new EloquentImage([
//            'image_name' => 'image user 1',
//            'image_url' => 'http://www.url.xyz/image-user-1',
//        ]);
//
//        $user = EloquentUser::find(1);
//        $user->image()->save($imageUser);

//        $imagePost = new EloquentImage([
//            'image_name' => 'image post 2',
//            'image_url' => 'http://www.url.xyz/image-post-2',
//        ]);
//
//        $post = EloquentPost::find(2);
//        $result = $post->image()->save($imagePost);
//        dd($result);
    }
}
