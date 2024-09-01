<?php

namespace App\Listeners;

use App\Events\LoanRequestStatusUpdated;
use App\Mail\LoanRequestStatusUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LoanRequestStatusUpdatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoanRequestStatusUpdated $event): void
    {
        $loanRequest = $event->loanRequest;
        $reason = $event->reason;
        Mail::to($loanRequest->email)->queue(new LoanRequestStatusUpdate($loanRequest, $reason));
    }
}
