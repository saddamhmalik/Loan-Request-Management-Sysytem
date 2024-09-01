@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-white text-black">
                        <h3 class="card-title">
                            <i class="fas fa-check-circle"></i> &nbsp;Application Status
                        </h3>
                    </div>
                    <div class="card-body">
                        @if ($loanRequest)
                            <div class="application-status">
                                <div class="status-header mb-4">
                                    <i class="fas fa-info-circle fa-2x"></i>
                                    <h4 class="d-inline ml-3"> &nbsp;Your Application Details</h4>
                                </div>
                                <div class="status-info mb-4">
                                    <p><i class="fas fa-id-badge"></i> <strong> Application Number:</strong> {{ $loanRequest->request_hash }}</p>
                                    <p><i class="fas fa-user"></i> <strong> Full Name:</strong> {{ $loanRequest->full_name }}</p>
                                    <p><i class="fas fa-dollar-sign"></i> <strong> Loan Amount:</strong> ₹{{ number_format($loanRequest->loan_amount, 2) }}</p>
                                    <p><i class="fas fa-tag"></i> <strong> Loan Purpose:</strong> {{ ucfirst($loanRequest->loan_purpose) }}</p>
                                </div>
                                <div class="status-summary">
                                    @if ($loanRequest->application_status === 'pending')
                                        <div class="alert alert-warning text-center">
                                            <i class="fas fa-hourglass-half fa-2x"></i>
                                            <h5 class="mt-2">Pending</h5>
                                            <p>Your application is currently under review. We will update you shortly.</p>
                                        </div>
                                    @elseif ($loanRequest->application_status === 'approved')
                                        <div class="alert alert-success text-center">
                                            <i class="fas fa-thumbs-up fa-2x"></i>
                                            <h5 class="mt-2">Approved</h5>
                                            <p>Congratulations! Your application has been approved.</p>
                                        </div>
                                    @elseif ($loanRequest->application_status === 'rejected')
                                        <div class="alert alert-danger text-center">
                                            <i class="fas fa-thumbs-down fa-2x"></i>
                                            <h5 class="mt-2">Rejected</h5>
                                            <p>We regret to inform you that your application has been rejected. Please contact us for further details.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-4">Thank you for your patience. We will contact you shortly regarding your application.</p>
                        @else
                            <div class="alert alert-danger">
                                <h4 class="alert-heading">Error</h4>
                                <p><i class="fas fa-exclamation-triangle"></i> We could not find an application with the provided number. Please check the number and try again.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .application-status {
            border: 1px solid #ddd;
            border-radius: .25rem;
            padding: 1rem;
            background-color: #f9f9f9;
        }

        .status-header {
            display: flex;
            align-items: center;
            background-color: #e9ecef;
            padding: .5rem;
            border-radius: .25rem;
        }

        .status-info p {
            margin-bottom: .5rem;
        }

        .status-summary .alert {
            border-radius: .25rem;
        }
    </style>
@endsection
