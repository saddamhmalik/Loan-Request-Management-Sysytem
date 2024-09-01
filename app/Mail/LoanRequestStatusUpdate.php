<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanRequestStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public mixed $loanRequest;
    public mixed $reason;

    /**
     * Create a new message instance.
     */
    public function __construct($loanRequest,$reason)
    {
       $this->loanRequest = $loanRequest;
       $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Loan Request Status Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.status_update',
            with: ['loanRequest' => $this->loanRequest, 'reason' => $this->reason]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
