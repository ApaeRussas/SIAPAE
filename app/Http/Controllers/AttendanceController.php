<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Frequency;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use \Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Calendário de atendimentos
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);

        $context = 'attendance';

        $dataAtual = Carbon::now();
        $year = Carbon::now()->format('Y');

        $primeiroDiaSemana = $dataAtual
            ->startOfWeek(Carbon::MONDAY)
            ->format('Y-m-d');

        $ultimoDiaSemana = $dataAtual
            ->endOfWeek(Carbon::FRIDAY)
            ->format('Y-m-d');

        $faixaSemana =
            Carbon::parse($primeiroDiaSemana)->format('d/m') .
            ' - ' .
            Carbon::parse($ultimoDiaSemana)->format('d/m');

        $diasDaSemana = [];

        $diasDaSemana['segunda'] =
            Carbon::parse($primeiroDiaSemana)->format('d/m');

        $diasDaSemana['terca'] =
            Carbon::parse($primeiroDiaSemana)->addDay()->format('d/m');

        $diasDaSemana['quarta'] =
            Carbon::parse($primeiroDiaSemana)->addDays(2)->format('d/m');

        $diasDaSemana['quinta'] =
            Carbon::parse($primeiroDiaSemana)->addDays(3)->format('d/m');

        $diasDaSemana['sexta'] =
            Carbon::parse($primeiroDiaSemana)->addDays(4)->format('d/m');

        $students = Student::orderBy('name', 'asc')->get();

        $frequencies = Frequency::get();

        if ($students) {
            $this->getDaysUseful(
                $students,
                $year,
                $primeiroDiaSemana
            );
        }

        return view(
            'attendance.home',
            compact(
                'year',
                'faixaSemana',
                'diasDaSemana',
                'students',
                'frequencies',
                'context'
            )
        );
    }

    /**
     * Lista de atendimentos
     */
    public function attendanceList(Request $request)
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);

        $context = 'attendance';

        $date_range = $request->input('date_range');

        if ($date_range) {
            $dates = explode(' à ', $date_range);

            $start_date = Carbon::createFromFormat(
                'd/m/Y',
                trim($dates[0])
            )->format('Y-m-d');

            $end_date = Carbon::createFromFormat(
                'd/m/Y',
                trim($dates[1])
            )->format('Y-m-d');

            $attendances = Attendance::whereDate(
                'date',
                '>=',
                $start_date
            )
                ->whereDate(
                    'date',
                    '<=',
                    $end_date
                )
                ->with('student', 'professor')
                ->whereHas('student', function ($query) {
                    $query->where('state_student', 'alive');
                })
                ->orderBy('date', 'desc')
                ->paginate(15)
                ->appends($request->query());
        } else {
            $attendances = Attendance::orderBy(
                'date',
                'desc'
            )
                ->with('student', 'professor')
                ->whereHas('student', function ($query) {
                    $query->where('state_student', 'alive');
                })
                ->paginate(15)
                ->appends($request->query());
        }

        return view(
            'attendance.list',
            compact(
                'attendances',
                'date_range',
                'context'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $student_id = $request->query('student_id');

        if ($request->query('date') && $request->query('year')) {
            $date = $request->query('date') . '/' . $request->query('year');
        } else {
            $date = '';
        }

        $students = Student::where('state_student', 'alive')
            ->orderBy('name', 'asc')
            ->get();

        $professors = User::orderBy('name', 'asc')
            ->where('position', 'professor(a)')
            ->where('state_user', 'alive')
            ->get();

        return view(
            'attendance.create',
            compact(
                'student_id',
                'date',
                'students',
                'professors'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        $data = $request->validated();

        $data['date'] = Carbon::createFromFormat(
            'd/m/Y',
            $data['date']
        )->format('Y-m-d');

        $existingAttendance = Attendance::where(
            'student_id',
            $data['student_id']
        )
            ->where(
                'signature_id',
                $data['signature_id']
            )
            ->whereDate(
                'date',
                $data['date']
            )
            ->exists();

        if ($existingAttendance) {
            throw ValidationException::withMessages([
                'date' => 'Já existe um atendimento deste professor para este aluno na data informada.',
            ]);
        }

        list($year, $month, $day) = explode(
            '-',
            $data['date']
        );

        $frequency = Frequency::where(
            'student_id',
            $data['student_id']
        )
            ->where(
                'month_year',
                $month . '/' . $year
            )
            ->first();

        if ($frequency) {
            $day = ltrim($day, '0');

            if ($frequency->{$day} === null) {
                $frequency->{$day} = true;
                $frequency->save();
            } elseif ($frequency->{$day} === false) {
                throw ValidationException::withMessages([
                    'date' => 'Na data informada, a frequência do Aluno consta como se ele tivesse faltado, mude na lista de frequência.',
                ]);
            }
        }

        session()->put(
            'faixaSemana',
            $request->faixaSemana
        );

        session()->put(
            'year',
            $request->year
        );

        $attendance = Attendance::create($data);

        if ($attendance) {
            session()->flash(
                'success',
                'Atendimento adicionado com sucesso'
            );

            broadcast(
                new CrudUpdated(
                    'created',
                    'attendance'
                )
            )->toOthers();

            return redirect()->route(
                'attendance.index'
            );
        }

        session()->flash(
            'error',
            'Falha na criação do Atendimento'
        );

        return redirect()->route(
            'attendance.create'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        session([
            'previous_url_secondary' => url()->full()
        ]);

        if ($request->student_id && $request->date) {
            $attendanceDate = Carbon::createFromFormat(
                'd/m/Y',
                $request->date . '/' . Carbon::now()->format('Y')
            )->format('Y-m-d');

            $attendanceExists = Attendance::where(
                'student_id',
                $request->student_id
            )
                ->where(
                    'date',
                    $attendanceDate
                )
                ->exists();

            if ($attendanceExists) {
                $attendance = Attendance::where(
                    'student_id',
                    $request->student_id
                )
                    ->where(
                        'date',
                        $attendanceDate
                    )
                    ->first();

                $attendance['date'] = Carbon::createFromFormat(
                    'Y-m-d',
                    $attendance['date']
                )->format('d/m/Y');

                $element = null;
                $notRegularSidebar = null;

                return view(
                    'attendance.show',
                    compact(
                        'attendance',
                        'element',
                        'notRegularSidebar'
                    )
                );
            }

            $student_id = $request->student_id;

            $date =
                $request->date .
                '/' .
                Carbon::now()->format('Y');

            $students = Student::where(
                'state_student',
                'alive'
            )
                ->orderBy('name', 'asc')
                ->get();

            $professors = User::orderBy(
                'name',
                'asc'
            )
                ->where(
                    'position',
                    'professor(a)'
                )
                ->where(
                    'state_user',
                    'alive'
                )
                ->get();

            return view(
                'attendance.create',
                compact(
                    'student_id',
                    'date',
                    'students',
                    'professors'
                )
            );
        }

        $attendance = Attendance::findOrFail($id);

        $attendance['date'] = Carbon::createFromFormat(
            'Y-m-d',
            $attendance['date']
        )->format('d/m/Y');

        $element = null;
        $notRegularSidebar = null;

        if ($request->notRegularSidebar) {
            $element = Student::where(
                'id',
                $attendance->student_id
            )->first();

            $notRegularSidebar = true;
        }

        return view(
            'attendance.show',
            compact(
                'attendance',
                'element',
                'notRegularSidebar'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance['date'] = Carbon::createFromFormat(
            'Y-m-d',
            $attendance['date']
        )->format('d/m/Y');

        if ($attendance->student->state_student === 'alive') {
            $students = Student::where(
                'state_student',
                'alive'
            )
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $students = Student::where(
                'id',
                $attendance->student->id
            )->get();
        }

        $professors = User::orderBy(
            'name',
            'asc'
        )
            ->where(
                'position',
                'professor(a)'
            )
            ->get();

        $element = null;
        $notRegularSidebar = null;

        if ($request->notRegularSidebar) {
            $element = Student::where(
                'id',
                $attendance->student_id
            )->first();

            $notRegularSidebar = true;
        }

        return view(
            'attendance.edit',
            compact(
                'attendance',
                'students',
                'professors',
                'element',
                'notRegularSidebar'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AttendanceRequest $request,
        $id
    ) {
        $data = $request->validated();

        $data['date'] = Carbon::createFromFormat(
            'd/m/Y',
            $data['date']
        )->format('Y-m-d');

        $attendance = Attendance::findOrFail($id);

        $student_id = $attendance->student_id;

        $existingAttendance = Attendance::where(
            'student_id',
            $data['student_id']
        )
            ->where(
                'signature_id',
                $data['signature_id']
            )
            ->whereDate(
                'date',
                $data['date']
            )
            ->where(
                'id',
                '!=',
                $id
            )
            ->exists();

        if ($existingAttendance) {
            throw ValidationException::withMessages([
                'date' => 'Já existe um atendimento deste professor para este aluno na data informada.',
            ]);
        }

        $input = $attendance->update($data);

        if ($input) {
            session()->flash(
                'success',
                'Atendimento atualizado com sucesso!'
            );

            broadcast(
                new CrudUpdated(
                    'updated',
                    'attendance'
                )
            )->toOthers();

            $previousUrl = session('previous_url_secondary');

            if (
                $previousUrl &&
                str_contains(
                    $previousUrl,
                    route('attendance.list')
                )
            ) {
                return redirect()->route(
                    'attendance.list'
                );
            }

            if (
                route('attendance.index') !=
                $previousUrl
            ) {
                $element = Student::where(
                    'id',
                    $student_id
                )->first();

                $notRegularSidebar = true;

                return redirect()->route(
                    'student.showAttendancesAndFrequency',
                    [
                        'id' => $student_id,
                        'element' => $element,
                        'notRegularSidebar' => $notRegularSidebar,
                    ]
                );
            }

            return redirect()->route(
                'attendance.index'
            );
        }

        session()->flash(
            'error',
            'Falha na edição do Atendimento'
        );

        return redirect()->route(
            'attendance.edit',
            $id
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        $id,
        Request $request
    ) {
        $data = Attendance::findOrFail($id);

        $student_id = $data->student_id;

        list($year, $month, $day) = explode(
            '-',
            $data->date
        );

        $frequency = Frequency::where(
            'student_id',
            $data->student_id
        )
            ->where(
                'month_year',
                $month . '/' . $year
            )
            ->first();

        if ($frequency) {
            $day = ltrim(
                $day,
                '0'
            );

            $frequency->{$day} = null;
            $frequency->save();
        }

        $input = Attendance::destroy($id);

        if ($input) {
            session()->flash(
                'success',
                'Atendimento excluído com sucesso!'
            );

            broadcast(
                new CrudUpdated(
                    'deleted',
                    'attendance'
                )
            )->toOthers();

            if ($request->notRegularSidebar) {
                $element = Student::where(
                    'id',
                    $student_id
                )->first();

                $notRegularSidebar = true;

                return redirect()->route(
                    'student.showAttendancesAndFrequency',
                    [
                        'id' => $student_id,
                        'element' => $element,
                        'notRegularSidebar' => $notRegularSidebar,
                    ]
                );
            }

            $previousUrl = session('previous_url_secondary');

            if (
                $previousUrl &&
                str_contains(
                    $previousUrl,
                    route('attendance.list')
                )
            ) {
                return redirect()->route(
                    'attendance.list'
                );
            }

            return redirect()->route(
                'attendance.index'
            );
        }

        session()->flash(
            'error',
            'Erro na exclusão do Atendimento'
        );

        return redirect()->route(
            'attendance.index'
        );
    }

    /**
     * Arquivados
     */
    public function deposit()
    {
        session([
            'previous_url' => url()->full()
        ]);

        $context = 'attendance';

        $date_range = request('date_range');

        if ($date_range) {
            $dates = explode(
                ' à ',
                $date_range
            );

            $start_date = Carbon::createFromFormat(
                'd/m/Y',
                trim($dates[0])
            )->format('Y-m-d');

            $end_date = Carbon::createFromFormat(
                'd/m/Y',
                trim($dates[1])
            )->format('Y-m-d');

            $attendances = Attendance::whereDate(
                'date',
                '>=',
                $start_date
            )
                ->whereDate(
                    'date',
                    '<=',
                    $end_date
                )
                ->with(
                    'student',
                    'professor'
                )
                ->whereHas(
                    'student',
                    function ($query) {
                        $query->where(
                            'state_student',
                            'archived'
                        );
                    }
                )
                ->orderBy(
                    'date',
                    'desc'
                )
                ->paginate(15)
                ->appends(
                    request()->query()
                );
        } else {
            $attendances = Attendance::orderBy(
                'date',
                'desc'
            )
                ->with(
                    'student',
                    'professor'
                )
                ->whereHas(
                    'student',
                    function ($query) {
                        $query->where(
                            'state_student',
                            'archived'
                        );
                    }
                )
                ->paginate(15)
                ->appends(
                    request()->query()
                );
        }

        return view(
            'attendance.deposit',
            compact(
                'attendances',
                'date_range',
                'context'
            )
        );
    }

    /**
     * Alterar semana do calendário
     */
    public function mudarSemana(Request $request)
    {
        $faixaSemana = $request->get('faixaSemana');

        $direcao = $request->get(
            'direcao',
            0
        );

        $ano = $request->get('year');

        list(
            $primeiroDia,
            $ultimoDia
        ) = explode(
            ' - ',
            $faixaSemana
        );

        $primeiroDiaSemana = Carbon::createFromFormat(
            'd/m/Y',
            $primeiroDia . '/' . $ano
        )->startOfDay();

        $ultimoDiaSemana = Carbon::createFromFormat(
            'd/m/Y',
            $ultimoDia . '/' . $ano
        )->endOfDay();

        if ($ultimoDiaSemana->lt($primeiroDiaSemana)) {
            $ultimoDiaSemana->addYear();
        }

        $anoAtualizado = $ano;

        if ($direcao == -1) {
            if (
                $primeiroDia == '01/01' ||
                $primeiroDia == '02/01' ||
                $primeiroDia == '03/01' ||
                $primeiroDia == '04/01' ||
                $primeiroDia == '05/01' ||
                $primeiroDia == '06/01' ||
                $primeiroDia == '07/01'
            ) {
                $ano = (int) $ano;
                $anoAtualizado = (string) (--$ano);
            }

            $primeiroDiaSemana->subWeek();
            $ultimoDiaSemana->subWeek();
        } elseif ($direcao == 1) {
            if (
                $ultimoDia == '31/12' ||
                $ultimoDia == '30/12' ||
                $ultimoDia == '29/12' ||
                $ultimoDia == '28/12' ||
                $ultimoDia == '27/12' ||
                $ultimoDia == '26/12' ||
                $ultimoDia == '25/12'
            ) {
                $ano = (int) $ano;
                $anoAtualizado = (string) (++$ano);
            }

            $primeiroDiaSemana->addWeek();
            $ultimoDiaSemana->addWeek();
        }

        if (
            $primeiroDiaSemana->year !==
            $ultimoDiaSemana->year
        ) {
            if ($direcao == -1) {
                $primeiroDiaSemana->subWeek();
                $ultimoDiaSemana->subWeek();
            } elseif ($direcao == 1) {
                $primeiroDiaSemana->addWeek();
                $ultimoDiaSemana->addWeek();
            }
        }

        $novaFaixaSemana =
            Carbon::parse($primeiroDiaSemana)->format('d/m') .
            ' - ' .
            Carbon::parse($ultimoDiaSemana)->format('d/m');

        $diasDaSemana = [];

        $diasDaSemana['segunda'] =
            Carbon::parse($primeiroDiaSemana)->format('d/m');

        $diasDaSemana['terca'] =
            Carbon::parse($primeiroDiaSemana)
                ->addDay()
                ->format('d/m');

        $diasDaSemana['quarta'] =
            Carbon::parse($primeiroDiaSemana)
                ->addDays(2)
                ->format('d/m');

        $diasDaSemana['quinta'] =
            Carbon::parse($primeiroDiaSemana)
                ->addDays(3)
                ->format('d/m');

        $diasDaSemana['sexta'] =
            Carbon::parse($primeiroDiaSemana)
                ->addDays(4)
                ->format('d/m');

        $frequencies = Frequency::get();

        $students = Student::orderBy(
            'name',
            'asc'
        )->get();

        $this->getDaysUseful(
            $students,
            $anoAtualizado,
            $primeiroDiaSemana
        );

        $studentsWithFrequency = [];

        foreach ($students as $student) {
            $student->frequencyExists = null;

            $attendanceExists = [];

            $studentFrequencies = [];

            foreach (
                $diasDaSemana as $dayKey => $day
            ) {
                list(
                    $day,
                    $month
                ) = explode(
                    '/',
                    $day
                );

                $attendance = Attendance::where(
                    'student_id',
                    $student->id
                )
                    ->where(
                        'date',
                        $anoAtualizado .
                        '-' .
                        $month .
                        '-' .
                        $day
                    )
                    ->exists();

                $attendanceExists[$dayKey] =
                    $attendance;

                $day = ltrim(
                    $day,
                    '0'
                );

                $frequency = $frequencies
                    ->where(
                        'student_id',
                        $student->id
                    )
                    ->where(
                        'month_year',
                        $month .
                        '/' .
                        $anoAtualizado
                    )
                    ->first();

                $studentFrequencies[$dayKey] =
                    $frequency
                        ? $frequency->{$day}
                        : null;

                if ($frequency) {
                    $student->frequencyExists = true;
                }
            }

            $studentsWithFrequency[] = [
                'student' => $student,
                'frequencies' => $studentFrequencies,
                'attendanceExists' => $attendanceExists,
            ];
        }

        return response()->json([
            'faixaSemana' => $novaFaixaSemana,
            'primeiroDia' => $primeiroDiaSemana,
            'últimoDia' => $ultimoDiaSemana,
            'diasDaSemana' => $diasDaSemana,
            'studentsWithFrequency' => $studentsWithFrequency,
            'year' => $anoAtualizado,
        ]);
    }

    /**
     * Limpar sessão
     */
    public function clearSession()
    {
        session()->forget([
            'faixaSemana',
            'year'
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Identifica os dias em que cada aluno possui atendimento/aula.
     */
    public function getDaysUseful(
        $students,
        $anoAtualizado,
        $primeiroDiaSemana
    ) {
        foreach ($students as $student) {
            $month = Carbon::parse(
                $primeiroDiaSemana
            )->format('m');

            $frequency = Frequency::where(
                'student_id',
                $student->id
            )
                ->where(
                    'month_year',
                    $month . '/' . $anoAtualizado
                )
                ->first();

            if ($frequency) {
                $classType = $frequency->class_apae;
            } else {
                $classType = $student->class_apae;
            }

            $student->monday = null;
            $student->tuesday = null;
            $student->wednesday = null;
            $student->thursday = null;
            $student->friday = null;

            switch ($classType) {
                case 'Segunda':
                    $student->monday = true;
                    break;

                case 'Terça':
                    $student->tuesday = true;
                    break;

                case 'Quarta':
                    $student->wednesday = true;
                    break;

                case 'Quinta':
                    $student->thursday = true;
                    break;

                case 'Sexta':
                    $student->friday = true;
                    break;

                case 'Segunda e Terça':
                    $student->monday = true;
                    $student->tuesday = true;
                    break;

                case 'Segunda e Quarta':
                    $student->monday = true;
                    $student->wednesday = true;
                    break;

                case 'Segunda e Quinta':
                    $student->monday = true;
                    $student->thursday = true;
                    break;

                case 'Segunda e Sexta':
                    $student->monday = true;
                    $student->friday = true;
                    break;

                case 'Terça e Quarta':
                    $student->tuesday = true;
                    $student->wednesday = true;
                    break;

                case 'Terça e Quinta':
                    $student->tuesday = true;
                    $student->thursday = true;
                    break;

                case 'Terça e Sexta':
                    $student->tuesday = true;
                    $student->friday = true;
                    break;

                case 'Quarta e Quinta':
                    $student->wednesday = true;
                    $student->thursday = true;
                    break;

                case 'Quarta e Sexta':
                    $student->wednesday = true;
                    $student->friday = true;
                    break;

                case 'Quinta e Sexta':
                    $student->thursday = true;
                    $student->friday = true;
                    break;

                case 'Segunda, Terça e Quarta':
                    $student->monday = true;
                    $student->tuesday = true;
                    $student->wednesday = true;
                    break;

                case 'Segunda, Terça e Quinta':
                    $student->monday = true;
                    $student->tuesday = true;
                    $student->thursday = true;
                    break;

                case 'Segunda, Terça e Sexta':
                    $student->monday = true;
                    $student->tuesday = true;
                    $student->friday = true;
                    break;

                case 'Segunda, Quarta e Quinta':
                    $student->monday = true;
                    $student->wednesday = true;
                    $student->thursday = true;
                    break;

                case 'Segunda, Quarta e Sexta':
                    $student->monday = true;
                    $student->wednesday = true;
                    $student->friday = true;
                    break;

                case 'Segunda, Quinta e Sexta':
                    $student->monday = true;
                    $student->thursday = true;
                    $student->friday = true;
                    break;

                case 'Terça, Quarta e Quinta':
                    $student->tuesday = true;
                    $student->wednesday = true;
                    $student->thursday = true;
                    break;

                case 'Terça, Quarta e Sexta':
                    $student->tuesday = true;
                    $student->wednesday = true;
                    $student->friday = true;
                    break;

                case 'Terça, Quinta e Sexta':
                    $student->tuesday = true;
                    $student->thursday = true;
                    $student->friday = true;
                    break;

                case 'Quarta, Quinta e Sexta':
                    $student->wednesday = true;
                    $student->thursday = true;
                    $student->friday = true;
                    break;

                default:
                    break;
            }
        }

        return $students;
    }
}