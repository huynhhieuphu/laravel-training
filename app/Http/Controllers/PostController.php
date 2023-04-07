<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public $data;

    public function index() {
        $this->data['title'] = 'List Post';
        return view('posts.index', $this->data);
    }

    public function create() {
        $this->data['title'] = 'Create Post';
        return view('posts.create', $this->data);
    }

    public function add(Request $request) {
        $inputs = $request->all();

        $rules = [
            'post_name' => 'required|min:6',
            'post_order' => 'required|integer'
        ];

        $messages = [
            'required' => 'Truong :attribute bat buoc phai nhap',
            'min' => 'Truong :attribute Nhap it nhat :min ky tu',
            'integer' => 'Truong :attribute Du lieu phai so'
        ];

        $attributes = [
            'post_name' => 'Ten Bai Viet',
            'post_order' => 'Thu tu Bai Viet'
        ];

        $validator = Validator::make($inputs, $rules, $messages, $attributes);

        // Automatic Redirection
//        $validator->validate();

        if($validator->fails()) {
//            return 'Validate that bai';

            $validator->errors()->add('errMessage', 'Vui long kiem tra du lieu 2');
        } else {
//            return 'Validate thanh cong';

            return redirect('/post')->with('message', 'Them moi thanh cong');
        }

        return back()->withErrors($validator);
    }
}
