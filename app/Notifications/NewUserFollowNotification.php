<?php

namespace App\Notifications;

use App\Channels\SendcloudChannel;
use App\Mailer\UserMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class NewUserFollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',SendcloudChannel::class];
    }
    public function toDatabase($notifiable){
        return [
            'name'=>Auth::guard('api')->user()->name,
        ];

    }
    public function toSendcloud($notifiable){

        (new UserMailer())->followNotifyEmail($notifiable->email);

//        $data = [
//            'url'  => url(env('APP_URL', 'http://localhost')),
//            'name'=>Auth::guard('api')->user()->name
//        ];
//        Mail::send('auth.followuser', $data, function ($message)use ($notifiable) {
//            $message->from('account@mail.testserver.cn', env('APP_NAME','Laravel'));
//            $message->to($notifiable->email);
//            $message->subject('有人关注你了');
//        });

    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
