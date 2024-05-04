<?php

namespace App\Notifications\Auth;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerifyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private String $title;
    private String $message;

    private Otp $otp;


    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->title = "Verify Email" ;
        $this->message = "This code for verify you email ";
        $this->otp = new Otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        /*
        *  otp =new Otp ;
            otp->generate($notifiable->email,6,20);
            code = otp->token
        */
        $codeOtp = $this->otp->generate($notifiable->email,"numeric", 6 , 60);

        return (new MailMessage)
        //by default im useing pop3 from env file if you want to specify u can use : ->mailer('smtp')
                    ->line($this->title)
                    ->line("Hello".$notifiable->name)
                    ->line($this->message)
                    ->line("code : ". $codeOtp->token)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
