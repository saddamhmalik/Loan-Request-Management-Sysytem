<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true if authorization is not required, otherwise implement logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'pan' => 'required|string|size:10',
            'email' => 'required|email|unique:loan_requests,email',
            'phone' => 'required|size:10',
            'address' => 'required|string|max:500',
            'loanAmount' => 'required|numeric|min:1000',
            'loanPurpose' => 'required|string|max:50',
            'loanTerm' => 'required|integer|min:1',
            'employmentStatus' => 'required|string|in:employed,self-employed,unemployed,student',
            'annualIncome' => 'required|numeric|min:0',
            'employerName' => 'required|string|max:255',
            'termsAndConditions' => 'accepted',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required.',
            'full_name.string' => 'Full name must be a string.',
            'full_name.max' => 'Full name cannot exceed 255 characters.',

            'dob.required' => 'Date of birth is required.',
            'dob.date' => 'Date of birth must be a valid date.',
            'dob.before' => 'Date of birth must be before today.',

            'pan.required' => 'PAN is required.',
            'pan.string' => 'PAN must be a string.',
            'pan.size' => 'PAN must be exactly 10 characters long.',

            'email.required' => 'Email address is required.',
            'email.email' => 'Email address must be a valid email.',

            'phone.required' => 'Phone number is required.',
            'phone.size' => 'Phone number must be 10 digits.',

            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a string.',
            'address.max' => 'Address cannot exceed 500 characters.',

            'loanAmount.required' => 'Loan amount is required.',
            'loanAmount.numeric' => 'Loan amount must be a number.',
            'loanAmount.min' => 'Loan amount must be at least 1000.',

            'loanPurpose.required' => 'Loan purpose is required.',
            'loanPurpose.string' => 'Loan purpose must be a string.',
            'loanPurpose.max' => 'Loan purpose cannot exceed 50 characters.',

            'loanTerm.required' => 'Loan term is required.',
            'loanTerm.integer' => 'Loan term must be an integer.',
            'loanTerm.min' => 'Loan term must be at least 1 month.',

            'employmentStatus.required' => 'Employment status is required.',
            'employmentStatus.string' => 'Employment status must be a string.',
            'employmentStatus.in' => 'Employment status must be one of the following: employed, self-employed, unemployed, student.',

            'annualIncome.required' => 'Annual income is required.',
            'annualIncome.numeric' => 'Annual income must be a number.',
            'annualIncome.min' => 'Annual income must be a positive number.',

            'employerName.required' => 'Employer name is required.',
            'employerName.string' => 'Employer name must be a string.',
            'employerName.max' => 'Employer name cannot exceed 255 characters.',

            'termsAndConditions.accepted' => 'You must accept the terms and conditions.',
        ];
    }
}
