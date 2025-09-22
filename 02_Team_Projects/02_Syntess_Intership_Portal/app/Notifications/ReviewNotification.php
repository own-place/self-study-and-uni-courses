<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewNotification extends Notification
{
    use Queueable;

    protected $internship;

    protected $rating;

    /**
     * Create a new notification instance.
     */
    public function __construct($internship, $rating)
    {
        $this->internship = $internship;
        $this->rating = $rating;
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
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Someone has left a '. $this->rating. ' star review on the '.$this->internship->title.' internship.',
            'internship_id' => $this->internship->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Someone has left a '. $this->rating. ' star review on the '.$this->internship->title.' internship.',
            'application_id' => $this->internship->id,
        ];
    }
}
