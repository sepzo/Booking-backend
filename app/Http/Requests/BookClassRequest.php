<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'class_id' => ['required', 'integer', 'exists:students_classes,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.exists' => 'Class does not exist.',
            'booking_date.after_or_equal' => 'The booking date must be today or a future date.',
        ];
    }
}
