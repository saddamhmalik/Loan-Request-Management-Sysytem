@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title">
                            <i class="fas fa-check-circle"></i> Loan Request Received Successfully
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <p>Your loan request has been received successfully!</p>
                            <p>We have sent you an email with your application number. Please keep it safe for future
                                reference.</p>
                        </div>
                        <p>Thank you for choosing our services. Our team is currently reviewing your application. You
                            will be notified of the next steps via email.</p>
                        <p>If you have any questions or need further assistance, feel free to <a href="#">contact us</a>.
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-home"></i> Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
