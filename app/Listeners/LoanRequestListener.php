<?php

namespace App\Listeners;

use App\Events\LoanRequestReceived;
use App\Jobs\LoanRequestReceivedJob;
use App\Mail\LoanRequestReceivedMail;
use App\Models\Admins;
use App\Notifications\LoanRequestReceivedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LoanRequestListener
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
    public function handle(LoanRequestReceived $event): void
    {
        LoanRequestReceivedJob::dispatch($event);
        $loanRequest = $event->loanRequest;
        $admins = Admins::all();
        foreach ($admins as $admin) {
            Notification::send($admin, new LoanRequestReceivedNotification($loanRequest));
        }
    }
}
