<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;

class CommentController extends Controller
{
    public $data;

    public function create() {
        $this->data['title'] = 'Comment';
        return view('comments.create', $this->data);
    }

    public function add(Request $request) {

        $request->validate([
            'comment_name' => ['required', (new Uppercase)],
            'comment_email' => ['required', (new Uppercase)],
            'comment_message' => ['required', (new Uppercase)],
        ]);

    }
}
