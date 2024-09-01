<?php

namespace App\Http\Controllers;

use App\Events\LoanRequestReceived;
use App\Http\Requests\ApplicationStatusRequest;
use App\Http\Requests\LoanRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('index');
    }

    public function loanRequest(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('request');
    }

    public function processLoanRequest(LoanRequest $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $loanRequest = \App\Models\LoanRequest::create([
            'full_name' => $request->full_name,
            'dob' => $request->dob,
            'pan' => $request->pan,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'loan_amount' => $request->loanAmount,
            'loan_purpose' => $request->loanPurpose,
            'loan_term' => $request->loanTerm,
            'employment_status' => $request->employmentStatus,
            'annual_income' => $request->annualIncome,
            'employer_name' => $request->employerName,
        ]);

        event(new LoanRequestReceived($loanRequest));
        return view('success', ['loanRequest' => $loanRequest, 'message' => 'Loan request processed successfully!']);
    }

    public function applicationStatus(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('application_status');
    }

    public function knowApplicationStatus(ApplicationStatusRequest $request)
    {
        $application = \App\Models\LoanRequest::where('request_hash', $request->application_number)->first();
        return view('your_application_status', ['loanRequest' => $application]);
    }

}
