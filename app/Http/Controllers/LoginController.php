<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public $data = [];

    public function index() {
        $this->data['title'] = 'Validation Ajax - Login';
        return view('login.index', $this->data);
    }

    public function handleLogin(Request $request) {
//        $request->validate([
//            'user_username' => 'required|min:5',
//            'user_password' => 'required|min:8',
//        ]);

        $validator = Validator::make($request->all(), [
            'user_username' => 'required|min:5',
            'user_password' => 'required|min:8',
        ]);

        if($validator->fails()) {
            $validator->errors()->add('message', 'Vui long kiem tra lai');
            return response()->json(['errors' => $validator->errors()->getMessages()]);
        }

        return response()->json([
           'message' => 'Login Success'
        ]);
    }
}
