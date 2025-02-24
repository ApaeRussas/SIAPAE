<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecordRequest extends FormRequest
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
            'title_header' => [
                'required',
                'min:1',
                'max:100',
            ],
            
            'date' => [
                'required',
                'min:1'
            ],
            
            'text' => [
                'required',
                'min:1',
                'max:20000',
            ],

            'type_ata' => [
                'required',
                'min:1',
                'max:100',
            ],

            'special_signatures' => [
                'required',
                'min:1',
                'max:125',
            ],

            'number_signatures' => [
                'required',
                'numeric',
                'min:1',
                'max:70',
            ],

            'relatives_frequencies' => [
                'required',
                'min:1',
                'max:4000',
            ]
        ];
        
        return $rules;
    }
}
