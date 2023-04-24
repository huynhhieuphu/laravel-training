<?php

namespace App\Http\Controllers;

use App\Models\EloquentComment;
use App\Models\EloquentHistory;
use App\Models\EloquentPost;
use App\Models\EloquentSupplier;
use App\Models\EloquentTag;
use App\Models\EloquentTeam;
use App\Models\EloquentUser;
use App\Models\EloquentVideo;
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

    public function polyOneCreate()
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

    public function polyMany() {
        $post = EloquentPost::find(1);
//        dd($post->comments);
//        dd($post->comment);

        $video = EloquentVideo::find(2);
//        dd($video->comments);
        dd($video->comment);
    }

    public function polyManyCreate() {
//        $commentPost1 = new EloquentComment(['comment_content' => 'comment post 1-1']);
//        $commentPost2 = new EloquentComment(['comment_content' => 'comment post 1-2']);
//
//        $post = EloquentPost::find(1);
//        $result = $post->comments()->saveMany([$commentPost1, $commentPost2]);
//        dd($result);

//        $commentVideo1 = new EloquentComment(['comment_content' => 'comment video 1-1']);
//        $video = EloquentVideo::find(1);
//        $result = $video->comments()->saveMany([$commentVideo1]);

//        $commentVideo2 = new EloquentComment(['comment_content' => 'comment video 2-1']);
//        $commentVideo3 = new EloquentComment(['comment_content' => 'comment video 2-2']);
//        $video = EloquentVideo::find(2);
//        $result = $video->comments()->saveMany([$commentVideo2, $commentVideo3]);
//        dd($result);
    }

    public function polyManyToMany() {
//        $post = EloquentPost::find(1);
//
//        foreach ($post->tags as $tag) {
//            $tagArr[] = $tag->pivot->tag_id;
//        }
//
//        dd($tagArr);

        $tag = EloquentTag::find(2);
        dd($tag->posts);
    }

    public function polyManyToManyCreate() {
        $tag1 = EloquentTag::find(1);
        $tag2 = EloquentTag::find(2);
        $tag3 = EloquentTag::find(3);

        // insert 1 record
//        $post = EloquentPost::find(2);
//        $post->tags()->attach($tag1);

        // insert multiple record
//        $post = EloquentPost::find(1);
//        $post->tags()->sync([
//            $tag1->tag_id,
//            $tag2->tag_id,
//            $tag3->tag_id
//        ]);

//        $post = EloquentPost::find(2);
//        $post->tags()->sync([$tag1->tag_id,$tag3->tag_id]);
    }

    public function eagerLoading() {
//        $posts = TrainingPost::all();

//        $posts = TrainingPost::with('user')->get();

//        $posts = TrainingPost::with('user', 'categories')->get();
        // hoặc
//        $posts = TrainingPost::with(['user', 'categories'])->get();


//        $posts = TrainingPost::with('user.avatar', 'categories')->get();

//        $posts = TrainingPost::with(['user.avatar', 'categories' => function($query) {
//            $query->where('value_tmp', 1);
//        }])->get();

//        $posts = TrainingPost::with(['user.avatar', 'categories'])
//            ->withCount('categories')->get();


//        $posts = $this->getAllPost()->with('user'); // LỖI
        $posts = $this->getAllPost()->load('user');

//        dd($posts);
        return view('eager-loading', compact('posts'));
    }

    private function getAllPost() {
        return TrainingPost::all();
    }
}
