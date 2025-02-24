<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrequencyRequest extends FormRequest
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
            'class_apae' => 'required|string|max:125', 
            'turn_apae' => 'required|string|max:125',
            'date' => 'required|date',
            'observation' => 'nullable|string|max:750',
            '1' => 'nullable|boolean',
            '2' => 'nullable|boolean',
            '3' => 'nullable|boolean',
            '4' => 'nullable|boolean',
            '5' => 'nullable|boolean',
            '6' => 'nullable|boolean',
            '7' => 'nullable|boolean',
            '8' => 'nullable|boolean',
            '9' => 'nullable|boolean',
            '10' => 'nullable|boolean',
            '11' => 'nullable|boolean',
            '12' => 'nullable|boolean',
            '13' => 'nullable|boolean',
            '14' => 'nullable|boolean',
            '15' => 'nullable|boolean',
            '16' => 'nullable|boolean',
            '17' => 'nullable|boolean',
            '18' => 'nullable|boolean',
            '19' => 'nullable|boolean',
            '20' => 'nullable|boolean',
            '21' => 'nullable|boolean',
            '22' => 'nullable|boolean',
            '23' => 'nullable|boolean',
            '24' => 'nullable|boolean',
            '25' => 'nullable|boolean',
            '26' => 'nullable|boolean',
            '27' => 'nullable|boolean',
            '28' => 'nullable|boolean',
            '29' => 'nullable|boolean',
            '30' => 'nullable|boolean',
            '31' => 'nullable|boolean', 
        ];
    }
}
