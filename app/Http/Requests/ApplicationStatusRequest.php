<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB; // Import DB facade

class ApplicationStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'application_number' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!DB::table('loan_requests')->where('request_hash', $value)->exists()) {
                        $fail('The application number you entered does not exist. Please check and try again.');
                    }
                },
            ],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'application_number.required' => 'The application number field is required.',
            'application_number.string' => 'The application number must be a string.',
        ];
    }
}
