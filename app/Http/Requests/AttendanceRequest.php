<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            /*
            |--------------------------------------------------------------------------
            | Avanços
            |--------------------------------------------------------------------------
            */

            'advances_status' => [
                'required',
                'in:Sim,Não',
            ],

            'advances' => [
                'nullable',
                'string',
                'min:1',
                'max:5000',
                'required_if:advances_status,Sim',
            ],

            'advances_level' => [
                'nullable',
                'integer',
                'in:1,2,3,4,5',
                'required_if:advances_status,Sim',
            ],

            /*
            |--------------------------------------------------------------------------
            | Dificuldades
            |--------------------------------------------------------------------------
            */

            'difficulties_status' => [
                'required',
                'in:Sim,Não',
            ],

            'difficulties' => [
                'nullable',
                'string',
                'min:1',
                'max:5000',
                'required_if:difficulties_status,Sim',
            ],

            'difficulties_level' => [
                'nullable',
                'integer',
                'in:1,2,3,4,5',
                'required_if:difficulties_status,Sim',
            ],

            /*
            |--------------------------------------------------------------------------
            | Atividade
            |--------------------------------------------------------------------------
            */

            'activity_not_performed' => [
                'required',
                'boolean',
            ],

            'activity_description' => [
                'nullable',
                'string',
                'min:1',
                'max:5000',
                'required_if:activity_not_performed,0',
            ],

            /*
            |--------------------------------------------------------------------------
            | Habilidades
            |--------------------------------------------------------------------------
            */

            'skills' => [
                'nullable',
                'string',
                'min:1',
                'max:5000',
            ],

            'skills_evolution' => [
                'nullable',
                'string',
                'min:1',
                'max:5000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Dados do atendimento
            |--------------------------------------------------------------------------
            */

            'student_id' => [
                'required',
                'min:1',
            ],

            'date' => [
                'required',
                'date_format:d/m/Y',
            ],

            'educational_axis' => [
                'required',
                'string',
                'min:1',
                'max:100',
            ],

            'signature_id' => [
                'required',
                'string',
                'min:1',
                'max:100',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'date.date_format' =>
                'O formato da data deve ser dd/mm/aaaa.',

            'advances.required_if' =>
                'Informe os avanços quando selecionar "Sim".',

            'advances_level.required_if' =>
                'Selecione o nível dos avanços quando selecionar "Sim".',

            'advances_level.in' =>
                'O nível dos avanços deve estar entre 1 e 5.',

            'difficulties.required_if' =>
                'Informe as dificuldades quando selecionar "Sim".',

            'difficulties_level.required_if' =>
                'Selecione o nível das dificuldades quando selecionar "Sim".',

            'difficulties_level.in' =>
                'O nível das dificuldades deve estar entre 1 e 5.',

            'activity_description.required_if' =>
                'Informe a descrição da atividade ou marque "Não realizou a atividade".',
        ];
    }
}