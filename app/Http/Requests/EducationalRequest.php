<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationalRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|min:1',
            'school' => 'required|string|max:100',
            'age' => 'required|string|max:50',
            'turn_school' => 'required|string|max:50',
            'grade_school' => 'required|string|max:50',
            'school_year' => 'required|string|max:20',
            'professor_signature' => 'required|string|max:100',
            'text' => 'required|string|max:10000',
            'period' => 'required|string|max:100',
            'date_pedagogical' => 'required|string|max:10',
            'signature_id' => 'required|string|max:100',
        ];
    }
}
