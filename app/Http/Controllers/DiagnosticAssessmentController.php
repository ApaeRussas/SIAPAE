<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosticAssessmentRequest;
use App\Models\DiagnosticAssessment;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiagnosticAssessmentController extends Controller
{
    /**
     * Lista todas as sondagens diagnósticas.
     */
    public function index(Request $request)
    {
        session(['previous_url' => $request->fullUrl()]);
        session(['previous_url_secondary' => $request->fullUrl()]);

        $context = 'diagnostic-assessment';

        $date_range = $request->input('date_range');

        $query = DiagnosticAssessment::with('student');

        /*
         * Filtro por intervalo de datas.
         */
        if ($date_range) {
            $dates = explode(' à ', $date_range);

            if (count($dates) === 2) {
                try {
                    $start_date = Carbon::createFromFormat(
                        'd/m/Y',
                        trim($dates[0])
                    )->format('Y-m-d');

                    $end_date = Carbon::createFromFormat(
                        'd/m/Y',
                        trim($dates[1])
                    )->format('Y-m-d');

                    $query->whereDate('date', '>=', $start_date)
                        ->whereDate('date', '<=', $end_date);
                } catch (\Exception $e) {
                    $date_range = null;
                }
            }
        }

        $assessments = $query
            ->orderBy('date', 'desc')
            ->paginate(15)
            ->appends($request->query());

        return view(
            'diagnostic-assessments.index',
            compact(
                'assessments',
                'date_range',
                'context'
            )
        );
    }


    /**
     * Exibe o formulário para criar uma nova sondagem.
     */
    public function create(Request $request)
    {
        $student_id = $request->query('student_id');

        $date = $request->query('date');

        /*
         * Quando a tela for aberta com uma data, mantém
         * o padrão utilizado no projeto: dd/mm/aaaa.
         */
        if ($date) {
            try {
                if (strlen($date) === 5) {
                    $date = $date . '/' . Carbon::now()->format('Y');
                }

                Carbon::createFromFormat('d/m/Y', $date);

            } catch (\Exception $e) {
                $date = '';
            }
        } else {
            $date = '';
        }

        $students = Student::where('state_student', 'alive')
            ->orderBy('name', 'asc')
            ->get();

        return view(
            'diagnostic-assessments.create',
            compact(
                'student_id',
                'date',
                'students'
            )
        );
    }


    /**
     * Salva uma nova sondagem diagnóstica.
     */
    public function store(DiagnosticAssessmentRequest $request)
    {
        $data = $request->validated();

        /*
         * Converte a data recebida como dd/mm/aaaa
         * para o formato utilizado no banco.
         */
        $data['date'] = Carbon::createFromFormat(
            'd/m/Y',
            $data['date']
        )->format('Y-m-d');

        /*
         * Garante que os campos dos eixos tenham
         * um valor consistente mesmo quando vazios.
         */
        $data['language'] = $data['language'] ?? [];
        $data['logical_mathematical'] =
            $data['logical_mathematical'] ?? [];

        $data['functional_life'] =
            $data['functional_life'] ?? [];

        $data['body_experience'] =
            $data['body_experience'] ?? [];

        $data['nature_society'] =
            $data['nature_society'] ?? [];

        $data['educational_informatics'] =
            $data['educational_informatics'] ?? [];

        $data['cognitive'] =
            $data['cognitive'] ?? [];

        $assessment = DiagnosticAssessment::create($data);

        if ($assessment) {
            session()->flash(
                'success',
                'Sondagem diagnóstica adicionada com sucesso!'
            );

            return redirect()->route(
                'diagnostic-assessments.index'
            );
        }

        session()->flash(
            'error',
            'Falha ao adicionar a sondagem diagnóstica.'
        );

        return redirect()->route(
            'diagnostic-assessments.create'
        );
    }


    /**
     * Exibe uma sondagem diagnóstica específica.
     */
    public function show($id, Request $request)
    {
        session(['previous_url_secondary' => $request->fullUrl()]);

        $assessment = DiagnosticAssessment::with('student')
            ->findOrFail($id);

        $context = 'diagnostic-assessment';

        return view(
            'diagnostic-assessments.show',
            compact(
                'assessment',
                'context'
            )
        );
    }


    /**
     * Exibe o formulário de edição.
     */
    public function edit($id)
    {
    $assessment = DiagnosticAssessment::findOrFail($id);

    /*
     * O campo date possui cast para Carbon no Model.
     * Não devemos sobrescrever $assessment->date com
     * uma string no formato dd/mm/aaaa.
     *
     * Criamos uma variável separada para a tela.
     */
    $date = $assessment->date
        ? $assessment->date->format('d/m/Y')
        : '';

    /*
     * Se o aluno da sondagem ainda estiver ativo,
     * mostra os alunos ativos.
     *
     * Caso esteja arquivado, mantém o próprio aluno
     * disponível para edição.
     */
    if (
        $assessment->student &&
        $assessment->student->state_student === 'alive'
    ) {

        $students = Student::where(
            'state_student',
            'alive'
        )
            ->orderBy('name', 'asc')
            ->get();

    } else {

        $students = Student::where(
            'id',
            $assessment->student_id
        )->get();
    }

    $context = 'diagnostic-assessment';

    return view(
        'diagnostic-assessments.edit',
        compact(
            'assessment',
            'students',
            'context',
            'date'
        )
    );
}


    /**
     * Atualiza uma sondagem diagnóstica.
     */
    public function update(
        DiagnosticAssessmentRequest $request,
        $id
    ) {
        $data = $request->validated();

        $data['date'] = Carbon::createFromFormat(
            'd/m/Y',
            $data['date']
        )->format('Y-m-d');

        /*
         * Mantém os eixos como arrays.
         */
        $data['language'] = $data['language'] ?? [];
        $data['logical_mathematical'] =
            $data['logical_mathematical'] ?? [];

        $data['functional_life'] =
            $data['functional_life'] ?? [];

        $data['body_experience'] =
            $data['body_experience'] ?? [];

        $data['nature_society'] =
            $data['nature_society'] ?? [];

        $data['educational_informatics'] =
            $data['educational_informatics'] ?? [];

        $data['cognitive'] =
            $data['cognitive'] ?? [];

        $assessment = DiagnosticAssessment::findOrFail($id);

        $updated = $assessment->update($data);

        if ($updated) {
            session()->flash(
                'success',
                'Sondagem diagnóstica atualizada com sucesso!'
            );

            return redirect()->route(
                'diagnostic-assessments.index'
            );
        }

        session()->flash(
            'error',
            'Falha ao atualizar a sondagem diagnóstica.'
        );

        return redirect()->route(
            'diagnostic-assessments.edit',
            $id
        );
    }


    /**
     * Exclui uma sondagem diagnóstica.
     */
    public function destroy($id)
    {
        $assessment = DiagnosticAssessment::findOrFail($id);

        $deleted = $assessment->delete();

        if ($deleted) {
            session()->flash(
                'success',
                'Sondagem diagnóstica excluída com sucesso!'
            );
        } else {
            session()->flash(
                'error',
                'Falha ao excluir a sondagem diagnóstica.'
            );
        }

        return redirect()->route(
            'diagnostic-assessments.index'
        );
    }
}