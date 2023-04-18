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

    /*public function store(Request $request) {
       Validator::make($request->all(), [
            'post_title' => 'required|string|min:6',
           ])->validate();
       $post = new Post;
       $post->post_title = $request->input('post_title');
       $post->post_content = $request->input('post_content');
       $post->save();
        return redirect()->route('post.index')->with('msg', 'Inserted successfully');
    }*/

    /*public function store(Request $request) {
        $data = $request->all();
        //$post = Post::create($data);
        //hoặc
        $post = new Post($data);
        if($post) {
            return 'Inserted successfully';
        }else{
            return 'Insert Failed';
        }
    }*/

    public function store(Request $request) {
        // Tìm bài viết trong CSDl nếu không có thì thêm bản ghi mới vào bảng.
//        $post = Post::firstOrCreate($request->all());

//        // Tìm bài viết trong CSDL nếu không có thì trả về một instance
//        $post = Post::firstOrNew($request->all());
//        $post->save();

        $post = Product::UpdateOrCreate($request->all());
        //Dùng để update hoặc tạo bản ghi mới.

        if($post) {
            return 'Inserted successfully';
        }else{
            return 'Insert Failed';
        }
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

    public function delete(Post $post) {
//        $post = Post::find($id);
//        $post->delete();

        //hoặc
//        $post = Post::where('post_id', $id)->delete();

        // kiểm tra đã bản ghi xóa mềm tồn tại hay chưa
        if ($post->trashed()) {
            // xoá vĩnh viễn bản ghi
            $post->forceDelete();
            return redirect()->route('post.archive');
        }

        $post->delete();
        return redirect()->route('post.index');
    }

    public function archive() {
        $this->data['posts'] = Post::onlyTrashed()
            ->orderBy('post_id', 'desc')
            ->get();
        return view('posts.archive', $this->data);
    }

    public function restore(Post $post) {
        if ($post->trashed()) {
            // phục hồi bản ghi
            $post->restore();
            return redirect()->route('post.index');
        }
    }
}
