<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PayrollRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * Validates year and month inputs for payroll calculations:
     * - year: Must be a valid year between 2000-2100 in YYYY format
     * - month: Must be a valid month number (1-12) in MM format
     *
     * @return array<string,  \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> Array of validation rules
     */
    public function rules(): array
    {
        return [
            'year'  => 'sometimes|date_format:Y|integer|min:2000|max:2100',
            'month' => 'sometimes|date_format:m|integer|between:1,12',
        ];
    }

    /**
     * Get the custom validation error messages.
     *
     * @return array<string, string> Array of custom validation messages
     */
    public function messages(): array
    {
        return [
            'year.date_format' => 'The year must be in YYYY format (e.g., 2025).',
            'month.date_format' => 'The month must be in MM format (e.g., 01 for January).',
            'year.min' => 'The year must be greater than or equal to 2000.',
            'year.max' => 'The year must be less than or equal to 2100.',
            'month.between' => 'The month must be between 1 and 12.',
        ];
    }
}
