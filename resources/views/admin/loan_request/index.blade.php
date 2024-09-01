@extends('layouts.admin.app')

@section('headings')
    Loan Requests
@endsection

@section('content')
    <div class="container">
        <!-- Search and Filter Form -->
        <form id="filterForm" method="GET" action="{{ route('admin.loan_requests') }}" class="mb-4">
            <div class="row">
                <!-- Search Input -->
                <div class="col-md-3 mb-2">
                    <div class="input-group">
                        <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search"
                               value="{{ request('search') }}">
                        <button type="button" class="btn btn-outline-secondary" onclick="submitSearch()">
                            <i class="fa-solid fa-search icon-lg"></i>
                        </button>
                    </div>
                </div>
                <!-- Status Filter -->
                <div class="col-md-3 mb-2">
                    <select name="status" class="form-control" onchange="submitForm()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved
                        </option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected
                        </option>
                    </select>
                </div>
                <!-- Date Filters -->
                <div class="col-md-3 mb-2">
                    <input type="date" name="date_from" class="form-control" placeholder="From Date"
                           value="{{ request('date_from') }}" onchange="submitForm()">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="date" name="date_to" class="form-control" placeholder="To Date"
                           value="{{ request('date_to') }}" onchange="submitForm()">
                </div>
                <!-- Clear Filters Button -->
                <div class="col-md-12 mt-2">
                    <button type="button" class="btn btn-secondary" onclick="clearFilters()">Clear Filters</button>
                </div>
            </div>
        </form>

        <!-- Loan Requests Table -->
        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Loan Amount</th>
                        <th>Loan Purpose</th>
                        <th>Status</th>
                        <th>PAN</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($loanRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->full_name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ number_format($request->loan_amount, 2) }}</td>
                            <td>{{ ucfirst($request->loan_purpose) }}</td>
                            <td>{{ ucfirst($request->application_status) }}</td>
                            <td>{{ $request->pan }}</td>
                            <td>{{ $request->phone }}</td>
                            <td>
                                <!-- View Button -->
                                <button class="btn btn-info btn-sm" onclick="viewRequest({{ $request->id }})">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm" onclick="editRequest({{ $request->id }})">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm" onclick="deleteRequest({{ $request->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No loan requests found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                {{ $loanRequests->appends(request()->query())->links('admin.utils.pagination.custom') }}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Loan Request Details</h5>
                </div>
                <div class="modal-body">
                    <!-- Content dynamically loaded via JS -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Loan Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Loan Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this loan request?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let currentRequestId;

        function viewRequest(id) {
            currentRequestId = id;
            fetch(`/admin/loan_request/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('#viewModal .modal-body').innerHTML = `
                        <p><strong>Full Name:</strong> ${data.full_name}</p>
                        <p><strong>Email:</strong> ${data.email}</p>
                        <p><strong>Loan Amount:</strong> ${new Intl.NumberFormat().format(data.loan_amount)}</p>
                        <p><strong>Loan Purpose:</strong> ${data.loan_purpose}</p>
                        <p><strong>Status:</strong> ${data.application_status}</p>
                        <p><strong>PAN:</strong> ${data.pan}</p>
                        <p><strong>Phone:</strong> ${data.phone}</p>
                        <p><strong>Address:</strong> ${data.address}</p>
                        <p><strong>Date of Birth:</strong> ${data.dob}</p>
                        <p><strong>Loan Term:</strong> ${data.loan_term} months</p>
                        <p><strong>Employment Status:</strong> ${data.employment_status}</p>
                        <p><strong>Annual Income:</strong> ${new Intl.NumberFormat().format(data.annual_income)}</p>
                        <p><strong>Employer Name:</strong> ${data.employer_name}</p>
                        <p><strong>Application Number:</strong> ${data.request_hash}</p>
                    `;
                    showModal('viewModal');
                })
                .catch(error => {
                    console.error('Error fetching loan request:', error);
                });
        }

        function editRequest(id) {
            currentRequestId = id;
            fetch(`/admin/loan_request/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('#editModal .modal-body').innerHTML = `
                        <form id="editForm" method="POST" action="/admin/loan_request/${id}">
                            @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="${data.full_name}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="${data.email}">
                            </div>
                            <div class="mb-3">
                                <label for="loanAmount" class="form-label">Loan Amount</label>
                                <input type="number" class="form-control" id="loanAmount" name="loan_amount" value="${data.loan_amount}">
                            </div>
                            <div class="mb-3">
                                <label for="loanPurpose" class="form-label">Loan Purpose</label>
                                <input type="text" class="form-control" id="loanPurpose" name="loan_purpose" value="${data.loan_purpose}">
                            </div>
                            <div class="mb-3">
                                <label for="applicationStatus" class="form-label">Status</label>
                                <select class="form-control" id="applicationStatus" name="application_status">
                                    <option value="pending" ${data.application_status === 'pending' ? 'selected' : ''}>Pending</option>
                                    <option value="approved" ${data.application_status === 'approved' ? 'selected' : ''}>Approved</option>
                                    <option value="rejected" ${data.application_status === 'rejected' ? 'selected' : ''}>Rejected</option>
                                </select>
                            </div>
                            <label for="reason" class="form-label">Reason</label> <small class="text-danger">Required when status is rejected</small>
                            <input type="text" class="form-control" id="reason" name="reason" value="">
                        </form>
                    `;
                    showModal('editModal');
                })
                .catch(error => {
                    console.error('Error fetching loan request:', error);
                });
        }

        function submitEditForm() {
            const form = document.getElementById('editForm');
            const formData = new FormData(form);

            fetch(`/admin/loan_request/${currentRequestId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => {
                    if (response.ok) {
                        response.json().then(data => {
                            toastr.success(data.message);
                            setTimeout(function () {
                                location.reload();
                            }, 3000)
                        });
                    } else {
                        response.json().then(error => {
                            toastr.error(error.message || 'An error occurred while updating the loan request.');
                        });
                    }
                })
                .catch(error => {
                    toastr.error('An unexpected error occurred.');
                    console.error('Error updating loan request:', error);
                });
        }

        function deleteRequest(id) {
            currentRequestId = id;
            showModal('deleteModal');
        }

        function confirmDelete() {
            fetch(`/admin/loan_request/${currentRequestId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (response.ok) {
                        toastr.success('Loan request deleted successfully.');
                        setTimeout(function () {
                            location.reload();
                        }, 3000)
                    } else {
                        toastr.error('Failed to delete the loan request.');
                    }
                })
                .catch(error => {
                    toastr.error('An unexpected error occurred.');
                    console.error('Error deleting loan request:', error);
                });
        }

        function submitForm() {
            document.getElementById('filterForm').submit();
        }

        function submitSearch() {
            document.getElementById('filterForm').submit();
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.querySelector('[name="status"]').value = '';
            document.querySelector('[name="date_from"]').value = '';
            document.querySelector('[name="date_to"]').value = '';
            submitForm();
        }

        // Function to show modals
        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    new bootstrap.Modal(modal).show();
                } else {
                    // Fallback for jQuery
                    $(modal).modal('show');
                }
            }
        }

    </script>
@endsection
