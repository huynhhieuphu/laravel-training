<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        $title = 'Sign In Form';
        return view('login', compact('title'));
    }

    public function login(Request $request) {

    }
}
