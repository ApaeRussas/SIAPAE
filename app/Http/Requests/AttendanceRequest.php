<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AttendanceRequest extends FormRequest
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
        $rules = [
            'student_id' => [
                'required',
                'min:1',
            ],

            'date' => [
                'required',
                'min:1',
            ],

            'educational_axis' => [
                'required',
                'string',
                'min:1',
                'max:100',
            ],

            'advances' => [
                'required',
               'string',
                'min:1',
                'max:5000',
            ],
            
            'difficulties' => [
                'required',
                'string',
               ' min:1',
                'max:5000',
            ],
            
            'signature_id' => [
                'required',
                'string',
                'min:1',
                'max:100',
            ],
        ];
        
        return $rules;
    }
    public function messages(): array
{
    return [
        'date.unique' => 'Já existe um registro para este aluno na data fornecida.',
        'date.date_format' => 'O formato da data deve ser d/m/Y.',
    ];
}
}
