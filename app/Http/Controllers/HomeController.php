<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->input('password'));

        if($user->save()) {
            return redirect()->route('home')->with('success', 'Updated Successfully');
        }
        return redirect()->back()->with('fail', 'Update Fail');
    }
}
