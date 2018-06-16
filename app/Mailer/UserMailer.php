<?php

namespace App\Mailer;
use Auth;
use App\User;

/**
 * Class UserMailer
 *
 * @package \App\Mailer
 */
class UserMailer extends Mailer
{
    public function followNotifyEmail($email){
        $data = [
            'url'  => url(env('APP_URL', 'https://www.ssmuch.com')),
            'name'=>Auth::guard('api')->user()->name
        ];
        $this->SendTo('auth.followuser',$email,$data);
    }
    public function passwordReset($email,$token){
        $data = [
            'url'  => url('password/reset',$token)
        ];
        $this->SendTo('auth.resetpassword',$email,$data);

    }
    public function welcome(User $user){
        $data = [
            'name' => $user->name,
            'url'  => Route('email.verify',['token' => $user->confirmation_token])
        ];
        $this->SendTo('auth.email',$user->email,$data);
    }
}
