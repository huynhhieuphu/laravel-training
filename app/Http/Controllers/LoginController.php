<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Sign In Form';
        return view('login', compact('title'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login.form')->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('home');
        }

        return redirect()->back()->with('fail', 'email or password is incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
