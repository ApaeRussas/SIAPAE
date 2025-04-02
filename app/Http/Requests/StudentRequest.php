<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $studentId = $this->route('student'); // Captura o id da rota

        $rules = [
            'name' => [
                'required',
                'min:1',
                'max:100',
                Rule::unique('students')->ignore($studentId),
            ],
            
            'date_of_birth' => [
            'required',
            'min:1'
            ],
            
            'diagnostic' => [
            'required',
            'min:1',
            'max:125'
            ],
            
            'student_id' => [
                'required',
                'min:1',
                Rule::unique('students')->ignore($studentId),
            ],
            
            'school' => [
            'nullable',
            'min:1',
            'max:125'
            ],
            
            'class_school' => [
            'nullable',
            'min:1',
            'max:40'
            ],
            
            'turn_school' => [
            'nullable',
            'min:1',
            'max:20'
            ],
            
            'grade_school' => [
            'nullable',
            'min:1',
            'max:50'
            ],
            
            'class_apae' => [
            'required',
            'min:1',
            'max:125'
            ],
            
            'turn_apae' => [
            'required',
            'min:1',
            'max:125'
            ],

            'service' => [
            'required',
            'min:1',
            'max:125'
            ],
            
            'image' => [
            'nullable',
            'mimes:png,jpg,jpeg,webp',
            'max:4096'
            ],

            'state_student' => [
            'nullable'
            ],
        ];
        
        return $rules;
    }
}
