<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $title = 'Sign Up Form';
        return view('register', compact('title'));
    }

    public function register(Request $request)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required|min:6|max:255',
        ]);

        if($validator->fails()) {
            return redirect()->route('register.form')->withErrors($validator)->withInput();
        }

        /*$user = new User();
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        if($user->save()){
            return 'Inserted Successfully';
        }*/

        $user = User::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        if ($user) {
            return redirect()->route('login.form')->with('success', 'Register Success');
        }
        return redirect()->back()->with('fail', 'Register Fail');
    }

}
