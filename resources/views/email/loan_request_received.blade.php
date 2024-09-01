<!DOCTYPE html>
<html>
<head>
    <title>Loan Request Received</title>
</head>
<body>
<h1>Loan Request Details</h1>

<p>Dear {{ $loanRequest['full_name'] }},</p>
<p>We have received your loan request. Application Number :{{ $loanRequest['request_hash'] }}.   Below are the details of your application:</p>

<ul>
    <li><strong>ID:</strong> {{ $loanRequest['id'] }}</li>
    <li><strong>Full Name:</strong> {{ $loanRequest['full_name'] }}</li>
    <li><strong>Date of Birth:</strong> {{ $loanRequest['dob'] }}</li>
    <li><strong>PAN:</strong> {{ $loanRequest['pan'] }}</li>
    <li><strong>Email:</strong> {{ $loanRequest['email'] }}</li>
    <li><strong>Phone:</strong> {{ $loanRequest['phone'] }}</li>
    <li><strong>Address:</strong> {{ $loanRequest['address'] }}</li>
    <li><strong>Loan Amount:</strong> ₹{{ number_format($loanRequest['loan_amount'], 2) }}</li>
    <li><strong>Loan Purpose:</strong> {{ ucfirst($loanRequest['loan_purpose']) }}</li>
    <li><strong>Loan Term:</strong> {{ $loanRequest['loan_term'] }} months</li>
    <li><strong>Employment Status:</strong> {{ ucfirst($loanRequest['employment_status']) }}</li>
    <li><strong>Annual Income:</strong> ₹{{ number_format($loanRequest['annual_income'], 2) }}</li>
    <li><strong>Employer Name:</strong> {{ $loanRequest['employer_name'] }}</li>
    <li><strong>Application Number:</strong> {{ $loanRequest['request_hash'] }}</li>
    <li><strong>Application Status:</strong> {{ ucfirst($loanRequest['application_status']) }}</li>
</ul>

<p>Sit back and relax, our team will review your application and get back to you shortly.</p>

<p>Thanks,<br> {{ config('app.name') }}</p>

</body>
</html>
