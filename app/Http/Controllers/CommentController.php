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
            'comment_email' => ['required','email'],
            'comment_message' => ['required', function($attribute, $value, $fail) {
//                $this->isUpperCase($value, 'Khong hop le', $fail);
                isUpperCase($value, 'Khong hop le', $fail);
            }],
        ]);

        return 'next work';
    }

    private function isUpperCase($value, $message, $fail) {
        if($value !== mb_strtoupper($value)) {
            $fail($message);
        }
        return true;
    }
}
