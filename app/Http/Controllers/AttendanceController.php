<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use App\Models\Attendance;
use App\Models\Frequency;
use App\Models\User;
use App\Models\Student;
use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use Illuminate\Validation\ValidationException;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        $context = 'attendance';

        // OPÇÃO CALENDÁRIO
        
        $dataAtual = Carbon::now();
        $year = Carbon::now()->format('Y');

        // Calcular a faixa de semana
        $primeiroDiaSemana = $dataAtual->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $ultimoDiaSemana = $dataAtual->endOfWeek(Carbon::FRIDAY)->format('Y-m-d');
        
        $faixaSemana = Carbon::parse($primeiroDiaSemana)->format('d/m') . ' - ' . Carbon::parse($ultimoDiaSemana)->format('d/m');
        
        $diasDaSemana = [];
        $diasDaSemana['segunda'] = Carbon::parse($primeiroDiaSemana)->format('d/m');
        $diasDaSemana['terca'] = Carbon::parse($primeiroDiaSemana)->addDay()->format('d/m');
        $diasDaSemana['quarta'] = Carbon::parse($primeiroDiaSemana)->addDays(2)->format('d/m');
        $diasDaSemana['quinta'] = Carbon::parse($primeiroDiaSemana)->addDays(3)->format('d/m');
        $diasDaSemana['sexta'] = Carbon::parse($primeiroDiaSemana)->addDays(4)->format('d/m');
        
        $students = Student::orderBy('name', 'asc')->get();
        $frequencies = Frequency::get();
        if($students) {
            $this->getDaysUseful($students,$year, $primeiroDiaSemana);
        }

        // OPÇÃO - TABELA

        $date_range = request('date_range');

        if ($date_range) {
            $dates = explode(' à ', $date_range);
            $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

            $attendances = Attendance::whereDate('date', '>=', $start_date)
                ->whereDate('date', '<=', $end_date)
                ->with('student', 'professor')
                ->orderBy('date', 'desc')
                ->paginate(15)->appends(request()->query());
        } else {
            $attendances = Attendance::orderBy('date', 'desc')
                ->with('student', 'professor')
                ->paginate(15)->appends(request()->query());
        }

        return view('attendance.home', compact('year', 'faixaSemana', 'diasDaSemana', 'students', 'frequencies', 'attendances', 'date_range', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $student_id = $request->query('student_id');
        if($request->query('date') && $request->query('year')) {
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
        return view('attendance.create', compact('student_id', 'date', 'students', 'professors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        $data = $request->validated();
        // Convert 'string' to data
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        
        $existingAttendance = Attendance::where('student_id', $data['student_id'])
            ->where('signature_id', $data['signature_id'])
            ->whereDate('date', $data['date'])
            ->exists();
        if ($existingAttendance) {
            throw ValidationException::withMessages([
                'date' => 'Já existe um atendimento deste professor para este aluno na data informada.',
            ]);
        }
        
        list($year, $month, $day) = explode('-', $data['date']);
        $frequency = Frequency::where('student_id', $data['student_id'])
            ->where('month_year', $month . '/' . $year)
            ->first();
        if($frequency) {
            $day = ltrim($day, '0');
            if($frequency->{$day} === null) {
                $frequency->{$day} = true;
                $frequency->save();

            } elseif ($frequency->{$day} === false) {
                throw ValidationException::withMessages([
                    'date' => 'Na data informada, a frequência do Aluno consta como se ele tivesse faltado, mude na lista de frequência.',
                ]);
            }
        }

        // Armazena a faixaSemana e o year na sessão
        session()->put('faixaSemana', $request->faixaSemana);
        session()->put('year', $request->year);
        
        $data = Attendance::create($data);
        if ($data) {
            session()->flash('success', 'Atendimento adicionado com sucesso');
            broadcast(new CrudUpdated('created',  'attendance'))->toOthers();
            return redirect()->route('attendance.index');
        } else {
            session()->flash('error', 'Falha na criação do Atendimento');
            return redirect()->route('attendance.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        if($request->student_id && $request->date) {
            $attendanceExists = Attendance::where('student_id', $request->student_id)
                ->where('date', Carbon::createFromFormat('d/m/Y', $request->date . '/' . Carbon::now()->format('Y'))->format('Y-m-d'))
                ->exists();
            if($attendanceExists) {
                $attendance = Attendance::where('student_id', $request->student_id)
                ->where('date', Carbon::createFromFormat('d/m/Y', $request->date . '/' . Carbon::now()->format('Y'))->format('Y-m-d'))
                ->first();
                $attendance['date'] = Carbon::createFromFormat('Y-m-d', $attendance['date'])->format('d/m/Y');
                return view('attendance.show', compact('attendance'));  
            } else {
                $student_id = $request->student_id;
                $date = $request->date . '/' . Carbon::now()->format('Y');
                $students = Student::where('state_student', 'alive')
                    ->orderBy('name', 'asc')
                    ->get();
                $professors = User::orderBy('name', 'asc')
                    ->where('position', 'professor(a)')
                    ->where('state_user', 'alive')
                    ->get();
                return view('attendance.create', compact('student_id', 'date', 'students', 'professors'));
            }
        } else {
            $attendance = Attendance::findOrFail($id);
            $attendance['date'] = Carbon::createFromFormat('Y-m-d', $attendance['date'])->format('d/m/Y');
    
            return view('attendance.show', compact('attendance'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        // Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $attendance['date'] = Carbon::createFromFormat('Y-m-d', $attendance['date'])->format('d/m/Y');

        $students = Student::where('state_student', 'alive')
            ->orderBy('name', 'asc')
            ->get();
        $professors = User::orderBy('name', 'asc')
            ->where('position', 'professor(a)')
            ->get();

        return view('attendance.edit', compact('attendance', 'students', 'professors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, $id)
    {
        $data = $request->validated();
        // Formatando a data que está em Y-m-d para d/m/Y
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        
        $attendance = Attendance::findOrFail($id);

        $existingAttendance = Attendance::where('student_id', $data['student_id'])
            ->where('signature_id', $data['signature_id'])
            ->whereDate('date', $data['date'])
            ->where('id', '!=', $id)  // Ignora o registro atual
            ->exists();
        if ($existingAttendance) {
            throw ValidationException::withMessages([
                'date' => 'Já existe um atendimento deste professor para este aluno na data informada.',
            ]);
        }

        $input = $attendance->update($data);
        if ($input) {
            session()->flash('success', 'Atendimento atualizado com sucesso!');
            broadcast(new CrudUpdated('updated',  'attendance'))->toOthers();
            return redirect()->route('attendance.index');
        } else {
            session()->flash('error', 'Falha na edição do Atendimento');
            return redirect()->route('attendance.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $data = Attendance::find($id);

        list($year, $month, $day) = explode('-', $data->date);
        $frequency = Frequency::where('student_id', $data->student_id)
            ->where('month_year', $month . '/' . $year)
            ->first();
        if($frequency) {
            $day = ltrim($day, '0');
            $frequency->{$day} = null;
            $frequency->save();
        }

        $input = Attendance::destroy($id);
        if ($input) {
            session()->flash('success', 'Atendimento excluído com sucesso!');
            broadcast(new CrudUpdated('deleted',  'attendance'))->toOthers();
            return redirect()->route('attendance.index');
        } else { 
            session()->flash('error', 'Erro na exclusão do Atendimento');
            return redirect()->route('attendance.index');
        }
    }  

    public function mudarSemana(Request $request)
    {
        $faixaSemana = $request->get('faixaSemana');
        $direcao = $request->get('direcao', 0);  // Direção: -1 para semana anterior, 1 para semana próxima
        $ano = $request->get('year');

        list($primeiroDia, $ultimoDia) = explode(' - ', $faixaSemana);
        
        // Cria as datas com base no ano fornecido
        $primeiroDiaSemana = Carbon::createFromFormat('d/m/Y', $primeiroDia . '/' . $ano)->startOfDay();
        $ultimoDiaSemana = Carbon::createFromFormat('d/m/Y', $ultimoDia . '/' . $ano)->endOfDay();

        // Verifica se a semana se estende por dois anos (ex: 30/12 - 03/01)
        if ($ultimoDiaSemana->lt($primeiroDiaSemana)) {
            $ultimoDiaSemana->addYear(); // Ajusta o último dia para o próximo ano
        }

        // Ajustar a data de acordo com a direção
        $anoAtualizado = $ano;

        if ($direcao == -1) {
            if($primeiroDia == '01/01' || $primeiroDia == '02/01' || $primeiroDia == '03/01' || $primeiroDia == '04/01' || $primeiroDia == '05/01' || $primeiroDia == '06/01' || $primeiroDia == '07/01') {
                $ano = (int) $ano;
                $anoAtualizado = (string) (--$ano);
            }
            $primeiroDiaSemana->subWeek();
            $ultimoDiaSemana->subWeek();
        } elseif ($direcao == 1) {
            if($ultimoDia == '31/12' || $ultimoDia == '30/12' || $ultimoDia == '29/12' || $ultimoDia == '28/12' || $ultimoDia == '27/12' || $ultimoDia == '26/12' || $ultimoDia == '25/12') {
                $ano = (int) $ano;
                $anoAtualizado = (string) (++$ano);
            }
            $primeiroDiaSemana->addWeek();
            $ultimoDiaSemana->addWeek();
        } 
        
        // Verifica se a nova faixa de semana tem anos diferentes
        if ($primeiroDiaSemana->year !== $ultimoDiaSemana->year) {
            // Se a semana tem anos diferentes, pula para a próxima ou anterior semana válida
            if ($direcao == -1) {
                $primeiroDiaSemana->subWeek();
                $ultimoDiaSemana->subWeek();
            } elseif ($direcao == 1) {
                $primeiroDiaSemana->addWeek();
                $ultimoDiaSemana->addWeek();
            }
        }

        $novaFaixaSemana = Carbon::parse($primeiroDiaSemana)->format('d/m') . ' - ' . Carbon::parse($ultimoDiaSemana)->format('d/m');
        
        $diasDaSemana = [];
        $diasDaSemana['segunda'] = Carbon::parse($primeiroDiaSemana)->format('d/m');
        $diasDaSemana['terca'] = Carbon::parse($primeiroDiaSemana)->addDay()->format('d/m');
        $diasDaSemana['quarta'] = Carbon::parse($primeiroDiaSemana)->addDays(2)->format('d/m');
        $diasDaSemana['quinta'] = Carbon::parse($primeiroDiaSemana)->addDays(3)->format('d/m');
        $diasDaSemana['sexta'] = Carbon::parse($primeiroDiaSemana)->addDays(4)->format('d/m');

        // Buscar estudantes e frequências
        $frequencies = Frequency::get();
        $students = Student::orderBy('name', 'asc')->get();
        $this->getDaysUseful($students, $anoAtualizado, $primeiroDiaSemana);

        // Mapear as frequências dos alunos por dia
        $studentsWithFrequency = [];
        foreach ($students as $student) {
            $student->frequencyExists = null;
            $attendanceExists = [];
            $studentFrequencies = [];
            
            foreach ($diasDaSemana as $dayKey => $day) {
                list($day, $month) = explode('/', $day);

                // Verificar se há um atendimento associado ao aluno
                $attendance = Attendance::where('student_id', $student->id)
                ->where('date', $anoAtualizado . '-' . $month . '-' . $day)
                ->exists();
                $attendanceExists[$dayKey] = $attendance;

                // Verificar se há uma frequência associada e se o aluno veio ou não naquele dia 
                $day = ltrim($day, '0'); // Remover zero à esquerda
                $frequency = $frequencies->where('student_id', $student->id)
                ->where('month_year', $month . '/' . $anoAtualizado)
                ->first();
                $studentFrequencies[$dayKey] = $frequency ? $frequency->{$day} : null;
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
        // Retorna a nova faixa de semana
        return response()->json([
            'faixaSemana' => $novaFaixaSemana,
            'primeiroDia' => $primeiroDiaSemana,
            'últimoDia' => $ultimoDiaSemana,
            'diasDaSemana' => $diasDaSemana,
            'studentsWithFrequency' => $studentsWithFrequency,
            'year' => $anoAtualizado,
        ]);
    }

    public function clearSession()
    {
        session()->forget(['faixaSemana', 'year']);
        return response()->json(['success' => true]);
    }

    public function getDaysUseful($students, $anoAtualizado, $primeiroDiaSemana)
    {
        foreach ($students as $student) 
        {
            $month = Carbon::parse($primeiroDiaSemana)->format('m');
            $frequency = Frequency::where('student_id', $student->id)
                ->where('month_year', $month . '/' . $anoAtualizado)
                ->first();
            if($frequency) {
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
