<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'date_of_emission' => [
                'required',
                'min:1'
            ],
            
            'type' => [
                'required',
                'string',
                'min:1',
                'max:15'
            ],
            
            'price' => [
                'required',
                'min:1',
                'max:11'
            ],
            
            'fiscal_number' => [
                'nullable',
                'min:1',
                'max:20'
            ],

            'cupom_number' => [
                'nullable',
                'min:1',
                'max:10'
            ],
            
            'enterprise' => [
                'nullable',
                'string',
                'min:1',
                'max:50'
            ],
            
            'description' => [
                'nullable',
                'string',
                'min:1',
                'max:255'
            ],
        ];
        
        return $rules;
    }
}
