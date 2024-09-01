@extends('layouts.app')

@section('content')
    <div class="container mt-5 shadow-lg pt-5 rounded-3">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="mb-4">Loan Request Form</h2>
            </div>
        </div>

        <!-- Form Section (Two Columns) -->
        <form action="{{ route('submit-form') }}" method="post">
            @csrf
            <div class="row p-5">
                <!-- Form Left Column -->
                <div class="col-md-6">
                    <!-- Personal Details Section -->
                    <div class="card shadow-lg mb-4 p-3 border rounded">
                        <h4 class="card-header bg-white border-bottom">Personal Details</h4>
                        <div class="p-2 mt-1">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="fullName"
                                   placeholder="Enter your full name as per PAN"
                                   value="{{ old('full_name') }}" required>
                            @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" id="dob" value="{{ old('dob') }}"
                                   required>
                            @error('dob')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="pan" class="form-label">PAN Number</label>
                            <input type="text" class="form-control" name="pan" id="pan" placeholder="Enter your PAN"
                                   value="{{ old('pan') }}" required>
                            @error('pan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Details Section -->
                    <div class="card shadow-lg mb-4 p-3 border rounded">
                        <h4 class="card-header bg-white border-bottom">Contact Details</h4>
                        <div class="p-2 mt-1">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="Enter your email"
                                   value="{{ old('email') }}" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" id="phone"
                                   placeholder="Enter your phone number"
                                   value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="address" class="form-label">Home Address</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   placeholder="Enter your home address"
                                   value="{{ old('address') }}" required>
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Right Column -->
                <div class="col-md-6">
                    <!-- Loan Information Section -->
                    <div class="card shadow-lg mb-4 p-3 border rounded">
                        <h4 class="card-header bg-white border-bottom">Loan Information</h4>
                        <div class="p-2 mt-1">
                            <label for="loanAmount" class="form-label">Loan Amount</label>
                            <input type="number" name="loanAmount" class="form-control" id="loanAmount"
                                   placeholder="Enter the loan amount" value="{{ old('loanAmount') }}" required>
                            @error('loanAmount')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="loanPurpose" class="form-label">Purpose of Loan</label>
                            <select class="form-select" name="loanPurpose" id="loanPurpose" required>
                                <option selected disabled value="">Select the purpose of loan</option>
                                <option value="home" {{ old('loanPurpose') == 'home' ? 'selected' : '' }}>Home
                                    Purchase
                                </option>
                                <option value="car" {{ old('loanPurpose') == 'car' ? 'selected' : '' }}>Car Purchase
                                </option>
                                <option value="education" {{ old('loanPurpose') == 'education' ? 'selected' : '' }}>
                                    Education
                                </option>
                                <option value="business" {{ old('loanPurpose') == 'business' ? 'selected' : '' }}>
                                    Business
                                </option>
                                <option value="personal" {{ old('loanPurpose') == 'personal' ? 'selected' : '' }}>
                                    Personal
                                </option>
                            </select>
                            @error('loanPurpose')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="loanTerm" class="form-label">Loan Term (in years)</label>
                            <input type="number" name="loanTerm" class="form-control" id="loanTerm"
                                   placeholder="Enter the loan term" value="{{ old('loanTerm') }}" required>
                            @error('loanTerm')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Professional Details Section -->
                    <div class="card shadow-lg mb-4 p-3 border rounded">
                        <h4 class="card-header bg-white border-bottom">Professional Details</h4>
                        <div class="p-2 mt-1">
                            <label for="employmentStatus" class="form-label">Employment Status</label>
                            <select class="form-select" name="employmentStatus" id="employmentStatus" required>
                                <option selected disabled value="">Select your employment status</option>
                                <option value="employed" {{ old('employmentStatus') == 'employed' ? 'selected' : '' }}>
                                    Employed
                                </option>
                                <option
                                    value="self-employed" {{ old('employmentStatus') == 'self-employed' ? 'selected' : '' }}>
                                    Self-employed
                                </option>
                                <option
                                    value="unemployed" {{ old('employmentStatus') == 'unemployed' ? 'selected' : '' }}>
                                    Unemployed
                                </option>
                                <option value="retired" {{ old('employmentStatus') == 'retired' ? 'selected' : '' }}>
                                    Retired
                                </option>
                            </select>
                            @error('employmentStatus')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="annualIncome" class="form-label">Annual Income</label>
                            <input type="number" name="annualIncome" class="form-control" id="annualIncome"
                                   placeholder="Enter your annual income" value="{{ old('annualIncome') }}" required>
                            @error('annualIncome')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="p-2 mt-1">
                            <label for="employerName" class="form-label">Employer Name</label>
                            <input type="text" name="employerName" class="form-control" id="employerName"
                                   placeholder="Enter your employer's name" value="{{ old('employerName') }}" required>
                            @error('employerName')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Terms and Conditions Section -->
                    <div class="card shadow-lg mb-4 p-3 border rounded">
                        <div class="form-check">
                            <input class="form-check-input" name="termsAndConditions" type="checkbox"
                                   id="termsAndConditions"
                                   {{ old('termsAndConditions') ? 'checked' : '' }} required>
                            <label class="form-check-label" for="termsAndConditions">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and
                                    Conditions</a>.
                            </label>
                            @error('termsAndConditions')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary btn-lg mt-4">Submit Loan Request</button>
                    </div>
                </div>
            </div>
        </form>


    </div>
    <!-- Modal for Terms and Conditions -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <!-- Terms and Conditions Content -->
                    <div class="terms-and-conditions">
                        <h2>Terms and Conditions for Loan Application</h2>
                        <h3>1. Eligibility Criteria</h3>
                        <ul>
                            <li>The applicant must be an Indian citizen or a resident of India.</li>
                            <li>The applicant must be at least 18 years old at the time of application.</li>
                            <li>The applicant must have a stable source of income and must be able to provide proof of
                                income.
                            </li>
                        </ul>
                        <h3>2. Application Process</h3>
                        <ul>
                            <li>The applicant must provide accurate and complete information in the loan application
                                form.
                            </li>
                            <li>The applicant must submit all required documents, including but not limited to, proof of
                                identity, address proof, income proof, and employment details.
                            </li>
                            <li>The loan application is subject to verification and approval by the lender. The lender
                                reserves the right to reject any application without providing a reason.
                            </li>
                        </ul>
                        <h3>3. Loan Terms</h3>
                        <ul>
                            <li>The loan amount, interest rate, and repayment terms will be specified in the loan
                                agreement.
                            </li>
                            <li>The interest rate is subject to change based on the lender's policies and market
                                conditions. Any changes will be communicated to the borrower.
                            </li>
                            <li>The loan must be repaid in accordance with the repayment schedule agreed upon. Failure
                                to repay the loan on time may result in additional charges and penalties.
                            </li>
                        </ul>
                        <h3>4. Use of Loan Funds</h3>
                        <ul>
                            <li>The loan funds must be used for the purpose specified in the loan application. Any
                                deviation from the stated purpose must be approved by the lender.
                            </li>
                            <li>The borrower agrees not to use the loan funds for illegal activities or any other
                                purposes that are not authorized by the lender.
                            </li>
                        </ul>
                        <h3>5. Fees and Charges</h3>
                        <ul>
                            <li>The borrower may be required to pay processing fees, administrative fees, and other
                                charges as specified in the loan agreement.
                            </li>
                            <li>Late payment fees and penalties may apply if the borrower fails to make payments on
                                time.
                            </li>
                        </ul>
                        <h3>6. Privacy and Confidentiality</h3>
                        <ul>
                            <li>The lender will collect and use personal information in accordance with applicable data
                                protection laws.
                            </li>
                            <li>The lender may share personal information with third parties for the purpose of loan
                                processing, verification, and collection.
                            </li>
                        </ul>
                        <h3>7. Default and Recovery</h3>
                        <ul>
                            <li>In the event of default, the lender reserves the right to take legal action to recover
                                the outstanding loan amount.
                            </li>
                            <li>The borrower may be liable for legal costs and other expenses incurred by the lender in
                                the recovery process.
                            </li>
                        </ul>
                        <h3>8. Governing Law</h3>
                        <ul>
                            <li>These terms and conditions are governed by the laws of India.</li>
                            <li>Any disputes arising from the loan agreement will be subject to the jurisdiction of the
                                courts in India.
                            </li>
                        </ul>
                        <h3>9. Amendments</h3>
                        <ul>
                            <li>The lender reserves the right to amend these terms and conditions at any time. The
                                borrower will be notified of any changes.
                            </li>
                        </ul>
                        <h3>10. Acceptance</h3>
                        <ul>
                            <li>By submitting the loan application, the borrower agrees to these terms and conditions.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
