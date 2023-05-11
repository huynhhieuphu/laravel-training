<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function index(Request $request)
    {
        /*switch ($request->mail_driver) {
            case 'smtp':
                config([
                    'mail.default' => 'smtp',
                    'mail.mailers.smtp.host' => $request->mail_host,
                    'mail.mailers.smtp.port' => $request->mail_port,
                    'mail.mailers.smtp.encryption' => $request->mail_encryption,
                    'mail.mailers.smtp.username' => $request->mail_username,
                    'mail.mailers.smtp.password' => $request->mail_password,
                    'mail.from.address' => $request->mail_address,
                    'mail.from.name' => $request->mail_name,
                ]);
                break;
            case 'ses':
                config([
                    'mail.default' => 'ses',
                    'mail.from.address' => $request->mail_address,
                    'mail.from.name' => $request->mail_name,
                    'services.ses.key' => $request->mail_key,
                    'services.ses.secret' => $request->mail_secret,
                    'services.ses.region' => $request->mail_region
                ]);
                break;
        }*/

        $user = User::findOrfail(1);
        // Khởi tạo mailable
        $mailable = new TestMail($user);
        Mail::send($mailable);
    }
}
