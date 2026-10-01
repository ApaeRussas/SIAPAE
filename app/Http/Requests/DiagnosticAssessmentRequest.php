<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiagnosticAssessmentRequest extends FormRequest
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
            | IDENTIFICAÇÃO
            |--------------------------------------------------------------------------
            */

            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id'),
            ],

            'age' => [
                'nullable',
                'integer',
                'min:0',
                'max:150',
            ],

            'series' => [
                'nullable',
                'string',
                'max:100',
            ],

            'school' => [
                'nullable',
                'string',
                'max:255',
            ],

            'cid' => [
                'nullable',
                'string',
                'max:100',
            ],

            'date' => [
                'required',
                'date_format:d/m/Y',
            ],

            /*
            |--------------------------------------------------------------------------
            | EIXOS DA SONDAGEM
            |--------------------------------------------------------------------------
            |
            | Os itens de cada eixo serão enviados pelo formulário como arrays.
            | A estrutura interna desses arrays será definida na tela de cadastro
            | de acordo com cada item do documento.
            |
            */

            'language' => [
                'nullable',
                'array',
            ],

            'logical_mathematical' => [
                'nullable',
                'array',
            ],

            'functional_life' => [
                'nullable',
                'array',
            ],

            'body_experience' => [
                'nullable',
                'array',
            ],

            'nature_society' => [
                'nullable',
                'array',
            ],

            'educational_informatics' => [
                'nullable',
                'array',
            ],

            'cognitive' => [
                'nullable',
                'array',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'student_id.required' =>
                'Selecione o aluno.',

            'student_id.exists' =>
                'O aluno selecionado não foi encontrado.',

            'age.integer' =>
                'A idade deve ser um número inteiro.',

            'age.min' =>
                'A idade não pode ser negativa.',

            'series.max' =>
                'A série não pode ter mais de 100 caracteres.',

            'school.max' =>
                'A escola não pode ter mais de 255 caracteres.',

            'cid.max' =>
                'O CID não pode ter mais de 100 caracteres.',

            'date.required' =>
                'Informe a data da sondagem.',

            'date.date_format' =>
                'A data deve estar no formato dd/mm/aaaa.',

            'language.array' =>
                'Os dados do eixo Linguagem são inválidos.',

            'logical_mathematical.array' =>
                'Os dados do eixo Lógico Matemático são inválidos.',

            'functional_life.array' =>
                'Os dados do eixo Vida Funcional são inválidos.',

            'body_experience.array' =>
                'Os dados do eixo Vivência Corporal são inválidos.',

            'nature_society.array' =>
                'Os dados do eixo Natureza e Sociedade são inválidos.',

            'educational_informatics.array' =>
                'Os dados do eixo Informática Pedagógica são inválidos.',

            'cognitive.array' =>
                'Os dados do eixo Cognitivo são inválidos.',
        ];
    }
};