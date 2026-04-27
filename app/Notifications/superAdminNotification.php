<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Bus\Queueable;

class SuperAdminNotification extends Notification
{
    use Queueable;

    public function __construct(public $event) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => class_basename($this->event),
            'message' => $this->getMessage(),
        ];
    }

    private function getMessage()
    {
        return match (class_basename($this->event)) {
            'UserCreated' => 'A new user was created with ID: ' . $this->event->user->id,
            'ArticleCreated' => 'A new article was created with ID: ' . $this->event->article->id,
            'ArticleUpdated' => 'An article was updated with ID: ' . $this->event->article->id,
            'ArticleDeleted' => 'An article was deleted with ID: ' . $this->event->article->id,
            'UserUpdated' => 'A user data was updated with ID: ' . $this->event->user->id,
            'UserDeleted' => 'A user was deleted with ID: ' . $this->event->user->id,
            default => 'System event occurred',
        };
    }
}