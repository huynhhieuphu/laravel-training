<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostController extends Controller
{
    protected $data = [];

    public function index() {
        $this->data['posts'] = Post::orderBy('post_id', 'desc')->get();
        return view('posts.index', $this->data);
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
       Validator::make($request->all(), [
            'post_title' => 'required|string|min:6',
           ])->validate();
       $post = new Post;
       $post->post_title = $request->input('post_title');
       $post->post_content = $request->input('post_content');
       $post->save();
        return redirect()->route('post.index')->with('msg', 'Inserted successfully');
    }

    public function edit($id) {
        if($id > 0) {
            try {
                $this->data['post'] = Post::findOrFail($id);
                return view('posts.edit', $this->data);
            } catch (ModelNotFoundException $e) {
                return redirect()->route('post.index')->withErrors($e->getMessage());
            }
        }
        return redirect()->route('post.index')->withErrors('Not Found');
    }

    public function update(Request $request) {
        $postId = $request->input('post_id');
        if($postId > 0) {
            try {
                $post = Post::findOrFail($postId);
                $post->post_title = $request->input('post_title');
                $post->post_content = $request->input('post_content');
                $post->save();
                return redirect()->route('post.edit', ['id' => $postId])->with('msg', 'Updated successfully');
            } catch (ModelNotFoundException $e) {
                return redirect()->route('post.index')->withErrors($e->getMessage());
            }
        }
        return redirect()->route('post.index')->withErrors('Not Found');
    }
}
