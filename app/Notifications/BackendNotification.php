<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use JetBrains\PhpStorm\ArrayShape;

class BackendNotification extends Notification
{
    use Queueable;

    private String $message;
    private String $type;
    /**
     * Create a new notification instance.
     */
    public function __construct(String $type , String $message)
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    #[ArrayShape(['type' => "String",'message' => "String"])]
    public function toDatabase($notifiable): array
    {
        return [
            'type' => $this->type ,
            'message' => $this->message,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['type' => "string", 'message' => "String"])]
    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type ,
            'message' => $this->message
        ];
    }
}
