<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScfvRequest extends FormRequest
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
            'theme' => 'required|string|max:125', 
            '1Q_objective' => 'required|string|max:512',
            '1Q_activity' => 'required|string|max:512',
            '1Q_description' => 'required|string|max:1024',
            '1Q_resource' => 'required|string|max:512',
            '1Q_partner' => 'required|string|max:512',
            '1Q_date' => 'required',
            '1Q_place' => 'required|string|max:125',
            '2Q_objective' => 'required|string|max:512',
            '2Q_activity' => 'required|string|max:512',
            '2Q_description' => 'required|string|max:1024',
            '2Q_resource' => 'required|string|max:512',
            '2Q_partner' => 'required|string|max:512',
            '2Q_date' => 'required',
            '2Q_place' => 'required|string|max:125',
            'students_frequency' => 'required|string|max:1024',
            'signature_id' => 'required|string|max:255',
            'date_scfv' => 'required',
        ];
    }
}
