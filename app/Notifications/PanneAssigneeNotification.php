<?php

namespace App\Notifications;

use App\Models\Panne;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PanneAssigneeNotification extends Notification
{
    use Queueable;

    protected $panne;
    /**
     * Create a new notification instance.
     */
    public function __construct(Panne $panne)
    {
        $this->panne = $panne;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'panne_id' => $this->panne->id,
            'code' => $this->panne->code,
            'titre' => $this->panne->name,
            'type' => $this->panne->type,
            'description' => $this->panne->description,
            'status' => $this->panne->status,
            'reporting_date' => $this->panne->reporting_date,
            'user_id' => $this->panne->user_id
        ];
    }
}
