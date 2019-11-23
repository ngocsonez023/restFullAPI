<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    // setting for gmail: https://blog.mailtrap.io/send-emails-with-gmail-api/
    //dùng api create proẹct for mail
    // tool test send mail: https://www.smtper.net/
    public function sendMail(){
      
        $email = 'zzkakashizz1@gmail.com';
        $data = 'data show to view';

        Mail::send('sendmail', ['email'=>$email,'data'=>$data], function ($message) use ($email,$data) {
        $message->from('mailsend123456@gmail.com', 'send mail');
        $message->to($email);
        $message->subject("send mail");
      });
    }
}
