<?php

namespace App\Notifications\Auth;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmailUser extends Notification
{
    use Queueable;



    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * via: This method specifies the channels through which the notification will be delivered. In this case, it will be sent via email.
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
    public function toMail(object $notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        // Set the custom mail message callback
        return $this->buildMailMessage($verificationUrl);
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


    protected function buildMailMessage($url): MailMessage
    {
         return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->view(
                'frontend.pages.auth.template-email', // Blade view path
                    ['verificationUrl' => $url] // Data to pass to the view
            );
    }

    protected function verificationUrl($notifiable)
    {

        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
            //dds the user's ID to the URL. getKey() typically returns the primary key of the user, usually the id.


}
