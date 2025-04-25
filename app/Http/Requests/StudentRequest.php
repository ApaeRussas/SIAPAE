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

            'name_mother' => [
            'required',
            'min:1',
            'max:100',
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

            'cpf' => [
                'required',
                'cpf',
                Rule::unique('students')->ignore($studentId),
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
            
            'sige' => [
            'required',
            'min:1',
            'max:50'
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

            'professors_service' => [
            'required', 
            'array'
            ],

            'professors_service.*' => [
                'integer',
                'exists:users,id',
            ],
            
            'image' => [
            'nullable',
            'mimes:png,jpg,jpeg,webp',
            'max:4096'
            ],

            'archiving_justify' => [
                'nullable'
            ],

            'state_student' => [
                'nullable'
            ],
        ];
        
        return $rules;
    }
    public function messages()
    {
        return [
            'cpf.unique' => 'Esse :attribute já está sendo utilizado.', 
            'cpf.required' => 'O :attribute é obrigatório.',
            'cpf.cpf' => 'O :attribute fornecido não é válido.',
        ];
    }
}
