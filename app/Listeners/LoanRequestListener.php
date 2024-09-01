<?php

namespace App\Listeners;

use App\Events\LoanRequestReceived;
use App\Jobs\LoanRequestReceivedJob;
use App\Mail\LoanRequestReceivedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
    }
}
