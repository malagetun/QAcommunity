<?php

namespace App\Mailer;
use Illuminate\Support\Facades\Mail;
/**
 * Class Mailer
 *
 * @package \App\Mailer
 */
class Mailer
{
    public function SendTo($template,$email,array  $data){

        Mail::send($template, $data, function ($message)use ($email) {
            $message->from('account@mail.testserver.cn', env('APP_NAME','Laravel'));
            $message->to($email);
            $message->subject('来自'. env('APP_NAME','Laravel'));
        });

    }
}
