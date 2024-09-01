@extends('layouts.admin.app')

@section('headings')
    Dashboard
@endsection

@section('css')
    <style>
        .icon-lg {
            font-size: 2.5rem; /* Adjust size as needed */
        }
        .icon-pending {
            color: rgba(255, 159, 64, 1);
        }
        .icon-approved {
            color: rgba(75, 192, 192, 1);
        }
        .icon-rejected {
            color: rgba(255, 99, 132, 1);
        }
        .icon-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-body {
            padding: 1.5rem; /* Adjust padding as needed */
        }
        .card-title, .card-text {
            margin-bottom: 0;
            color: black;
            font-weight: bold;
        }
        .chart-container {
            position: relative;
            height: 400px; /* Adjust height as needed */
        }
        a {
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card shadow-lg">
                    <a href="{{  route('admin.loan_requests') }}" class="text-decoration-none">
                        <div class="card-body d-flex align-items-start">
                            <div class="me-3 icon-container">
                                <i class="fa-solid fa-file icon-lg"></i>
                            </div>
                            <div class="mx-2">
                                <h5 class="card-title mb-1 text-black">Loan Requests</h5>
                                <p class="card-text mb-0">{{ $loanRequestCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-lg">
                    <a href="{{ route('admin.loan_requests', ['status' => 'approved']) }}" class="text-decoration-none">
                        <div class="card-body d-flex align-items-start">
                            <div class="me-3 icon-container ">
                                <i class="fa-solid fa-check icon-lg icon-approved"></i>
                            </div>
                            <div class="mx-2">
                                <h5 class="card-title mb-1">Approved</h5>
                                <p class="card-text mb-0">{{ $approvedRequestCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-lg">
                    <a href="{{ route('admin.loan_requests', ['status' => 'pending']) }}" class="text-decoration-none">
                        <div class="card-body d-flex align-items-start">
                            <div class="me-3 icon-container">
                                <i class="fa-solid fa-clock icon-lg icon-pending"></i>
                            </div>
                            <div class="mx-2">
                                <h5 class="card-title mb-1">Pending</h5>
                                <p class="card-text mb-0">{{ $pendingRequestCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-lg">
                    <a href="{{ route('admin.loan_requests', ['status' => 'rejected']) }}" class="text-decoration-none">
                        <div class="card-body d-flex align-items-start">
                            <div class="me-3 icon-container">
                                <i class="fa-solid fa-user-slash icon-lg icon-rejected"></i>
                            </div>
                            <div class="mx-2">
                                <h5 class="card-title mb-1">Rejected</h5>
                                <p class="card-text mb-0">{{ $rejectedRequestCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Loan Request Status Overview</h5>
                        <div class="chart-container">
                            <canvas id="loanRequestPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Loan Requests by Status</h5>
                        <div class="chart-container">
                            <canvas id="loanRequestBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctxPie = document.getElementById('loanRequestPieChart').getContext('2d');
            var loanRequestPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Approved', 'Pending', 'Rejected'],
                    datasets: [{
                        label: 'Loan Request Status',
                        data: [{{ $approvedRequestCount }}, {{ $pendingRequestCount }}, {{ $rejectedRequestCount }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed.toLocaleString();
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            var ctxBar = document.getElementById('loanRequestBarChart').getContext('2d');
            var loanRequestBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Approved', 'Pending', 'Rejected'],
                    datasets: [{
                        label: 'Number of Requests',
                        data: [{{ $approvedRequestCount }}, {{ $pendingRequestCount }}, {{ $rejectedRequestCount }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y.toLocaleString();
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
