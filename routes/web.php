<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SendMailController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test-mail', function () {
    $data = [
        'name' => 'Phú',
        'content' => 'Thử mail trong laravel'
    ];

    $toEmail = 'huynhhieu.phu@gmail.com';
    $toName = 'Phú Huỳnh';

    Mail::send('emails.test', $data, function ($message) use($toEmail, $toName) {
        $message->to($toEmail, $toName);
        $message->subject('Chủ để gửi thử mail trong laravel');
    });
});

Route::get('/', function (){
   return view('welcome');
});

Route::post('send-mail', [SendMailController::class, 'sendMail'])->name('send-mail');
