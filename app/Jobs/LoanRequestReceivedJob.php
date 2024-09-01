<?php

namespace App\Jobs;

use App\Mail\LoanRequestReceivedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class LoanRequestReceivedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $loanRequest;

    /**
     * Create a new job instance.
     */
    public function __construct($loanRequestReceived)
    {
        $this->loanRequest = $loanRequestReceived->loanRequest;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->loanRequest->email)->send(new LoanRequestReceivedMail($this->loanRequest));
    }
}
