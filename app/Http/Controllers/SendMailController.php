<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SendMailController extends Controller
{
    public function sendMail(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string',
            'email' => 'required|string|email',
            'subject' => 'required|string',
            'content' => 'required|string',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        Mail::to('huynhphu.hp@gmail.com')->send(new SendMail($data));

        return redirect('/')->with('success', 'Send Mail Successfully');
    }

}
