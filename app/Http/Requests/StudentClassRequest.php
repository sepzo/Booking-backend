<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'class_name' => [
                                'required', 'string', 'max:255',

                                Rule::unique('students_classes')->where(fn($q) =>
                                    $q->where('start_time', $this->input('start_time'))
                                ),

                            ],
                            
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_time'   => ['required', 'date_format:Y-m-d H:i:s', 'after:start_time'],
            'capacity'   => ['required', 'integer', 'min:1'],
        ];
    }

     public function messages()
    {
        return [
            'class_name.unique' => 'Duplicate class: a class with this name and start time already exists.',
        ];
    }
}
