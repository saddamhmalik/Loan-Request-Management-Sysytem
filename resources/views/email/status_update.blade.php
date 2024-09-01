<!DOCTYPE html>
<html>
<head>
    <title>Loan Request Status Updated</title>
</head>
<body>
<h1>Loan Request Status Update</h1>

<p>Dear {{ $loanRequest['full_name'] }},</p>
<p>We would like to inform you that the status of your loan request with Application Number {{ $loanRequest['request_hash'] }} has been updated. Here are the updated details:</p>

<ul>
    <li><strong>Full Name:</strong> {{ $loanRequest['full_name'] }}</li>
    <li><strong>Email:</strong> {{ $loanRequest['email'] }}</li>
    <li><strong>Phone:</strong> {{ $loanRequest['phone'] }}</li>
    <li><strong>Loan Amount:</strong> ₹{{ number_format($loanRequest['loan_amount'], 2) }}</li>
    <li><strong>Loan Purpose:</strong> {{ ucfirst($loanRequest['loan_purpose']) }}</li>
    <li><strong>Loan Term:</strong> {{ $loanRequest['loan_term'] }} months</li>
    <li><strong>Application Number:</strong> {{ $loanRequest['request_hash'] }}</li>
    <li><strong>Updated Status:</strong> {{ $loanRequest['application_status'] }}</li>
</ul>

@if($reason!=='')
    <p><strong>Rejection Reason:</strong> {{ $reason ?? 'Not provided' }}</p>
@endif

<p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>

<p>Thank you,<br> {{ config('app.name') }}</p>

</body>
</html>
