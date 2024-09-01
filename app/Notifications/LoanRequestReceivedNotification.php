<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class LoanRequestReceivedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $loanRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($loanRequest)
    {
        $this->loanRequest = $loanRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => 'A new loan request has been received from: ' . $this->loanRequest->full_name,
            'loanRequest' => $this->loanRequest,
        ];
    }
}
