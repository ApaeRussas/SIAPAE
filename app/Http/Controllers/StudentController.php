<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use App\Models\Attendance;
use App\Models\Educational;
use App\Models\Frequency;
use App\Models\MedHistory;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $context = 'student';

        $search = request('search');

        if ($search) {
            $students = Student::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_student', 'alive')
                ->orderBy('name', 'asc')
                ->paginate(15)->appends(request()->query());
        } else {
            $students = Student::where('state_student', 'alive')
                ->orderBy('name', 'asc')
                ->paginate(15)->appends(request()->query());
        }

        return view('student.home', compact('students', 'search', 'context'));
    }

    public function create()
    {   
        $professors = User::where('position', 'Professor(a)')->get();

        return view('student.create', compact('professors'));
    }

    public function store(StudentRequest $request)
    {
        $path = public_path('img/student/');
        $data = $request->validated();
        
        // Pegar os dados menos professors_service que não existe na tabela de students
        $studentData = collect($data)->except('professors_service')->toArray();
        
        // Convert string to data
        $studentData['date_of_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $studentData['date_of_birth'])->format('Y-m-d');

        if ($request->hasfile('image') && $request->file('image')->isValid()) {

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img/student/'), $imageName);
            $studentData['image'] = $imageName;

        } else {
            $studentData['image'] = "Foto_Desconhecido.jpg";
        };

        $input = Student::create($studentData);

        $input->professors()->sync($data['professors_service']);

        if ($input) {
            session()->flash('success', 'Aluno adicionado com sucesso!');
            broadcast(new CrudUpdated('created',  'student'))->toOthers();
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Falha na criação do Aluno');
            return redirect()->route('student.create');
        }
    }
    public function show($id)
    {
        session(['previous_url_secondary' => url()->full()]);
        $student = Student::findOrFail($id);

        $student->load('professors');

        $medHistory = null;
        $medHistoryExists = MedHistory::where('student_id', $id)->exists();
        if ($medHistoryExists) {
            $medHistory = MedHistory::where('student_id', $id)->first();
        }

        $isArchived = null;
        if ($student['state_student'] == 'archived') {
            $isArchived = true;
        }

        // Calcular a idade do aluno detalhadamente
        $dateOfBirth = Carbon::parse($student->date_of_birth);
        $now = Carbon::now();

        $ageYears = (int) $dateOfBirth->diffInYears($now);
        $dateOfBirth = $dateOfBirth->addYears($ageYears);
        $ageMonths = (int) $dateOfBirth->diffInMonths($now);
        $dateOfBirth = $dateOfBirth->addMonths($ageMonths);
        $ageDays = (int) $dateOfBirth->diffInDays($now);

        $student->age = "$ageYears anos, $ageMonths meses e $ageDays dias";

        return view('student.show', compact('student', 'medHistory', 'isArchived'));
    }

    public function showMedhistory($id) 
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $student = Student::findOrFail($id);
        $medHistory = MedHistory::with('student')
            ->where('student_id', $id)
            ->first();

        // Necessario fazer o else
        if($medHistory) {
            $medHistory['date_of_anamnesis'] = Carbon::createFromFormat('Y-m-d', $medHistory['date_of_anamnesis'])->format('d/m/Y');
            $medHistory['date_mother'] = Carbon::createFromFormat('Y-m-d', $medHistory['date_mother'])->format('d/m/Y');
            $medHistory['date_father'] = (isset($medHistory['date_father']) ? Carbon::createFromFormat('Y-m-d', $medHistory['date_father'])->format('d/m/Y') : null);
            
            return view('student.show_parts.medHistoryShow', compact('student', 'medHistory'));
        } else {
            $notRegularSidebar = true;
            return view('errors.404', compact('notRegularSidebar', 'student'));
        }
    }
    public function showAttendancesAndFrequency($id) 
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $student = Student::findOrFail($id);

        // Parte ATENDIMENTO

        $date_range = request('date_range');

        if ($date_range) {
            $dates = explode(' à ', $date_range);
            $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

            $attendances = Attendance::whereDate('date', '>=', $start_date)
                ->whereDate('date', '<=', $end_date)
                ->where('student_id', $id)
                ->with('student')
                ->orderBy('date', 'desc')
                ->paginate(10)->appends(request()->query());
        } else {
            $attendances = Attendance::where('student_id', $id)
                ->with('student')
                ->orderBy('date', 'desc')
                ->paginate(10)->appends(request()->query());
        }

        // Parte FREQUÊNCIA 

        $scrollBack = null;
        $monthYear = request('monthYear');
        if ($monthYear) {
            $frequency = Frequency::where('student_id', $student->id)
                ->where('month_year', $monthYear)
                ->first();

            $scrollBack = true;
        } else {
            $frequency = Frequency::where('student_id', $student->id)->first();
            $monthYear = Carbon::now()->format('m/Y');
        }

        list($month, $year) = explode('/', $monthYear);
        $month = (int) $month;
        $year = (int) $year;
        $numberDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $days = [];
        for ($i = 1; $i <= $numberDaysInMonth; $i++) {
            $days[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        // Definir os feriados 
        $holidays = [
            '01-01', // Ano Novo 
            '03-03', // Carnaval
            '04-03', // Carnaval
            '05-03', // Quarta-feira de cinzas
            '19-03', // Dia de São José
            '25-03', // Abolição da escravidão no Ceará
            '21-04', // Tiradentes
            '01-05', // Dia do Trabalho
            '19-06', // Corpus Christ
            '06-08', // Aniversário de Russas
            '15-08', // Dia de Nossa Senhora da Assunção
            '07-09', // Independência do Brasil
            '07-10', // Dia da Padroeira Nossa Senhora do Rosário
            '12-10', // Nossa Senhora Aparecida
            '02-11', // Finados
            '15-11', // Proclamação da República
            '20-11', // Dia Nacional de Zumbi e da Consciência Negra
            '27-11', // Aniversário da passagem da imagem de Nossa Senhora de Fátima no município
            '24-12', // Véspera Natal 
            '25-12', // Natal
            '31-12', // Véspera Ano novo
        ];
        $formattedHolidays = array_map(function ($holiday) use ($year) {
            return "{$year}-{$holiday}";
        }, $holidays);
        $weekends = [];
        for ($i = 1; $i <= $numberDaysInMonth; $i++) {
            $date = sprintf("%04d-%02d-%02d", $year, $month, $i);
            $dayOfWeek = date('N', strtotime($date));
            if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                $weekends[] = $date;
            }
        }
        $daysNotRequired = []; // P/ armazenar os dias normais, mas que não são os alvos
        if (isset($frequency)) {
            // Fazer os dias não clicáveis
            $daysNotRequired = $this->getDaysNotRequired($frequency->class_apae, $year, $month, $numberDaysInMonth);
            $frequency->nonClickableDays = array_merge($formattedHolidays, $weekends, $daysNotRequired);
            $frequency->weekends = array_merge($weekends);

            // Contar as Faltas
            $countAbsences = 0;
            for ($day = 1; $day <= $numberDaysInMonth; $day++) {
                $date = sprintf("%04d-%02d-%02d", $year, $month, $day);
                if (!in_array($date, $frequency->nonClickableDays) && $frequency->$day === false) {
                    $countAbsences++;
                }
            }
            $frequency->countAbsences = $countAbsences;
        }

        return view('student.show_parts.attendanceShow', compact('student', 'attendances', 'date_range', 'frequency', 'monthYear', 'days', 'numberDaysInMonth', 'scrollBack'));
    }
    public function showEducationals($id) 
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $student = Student::findOrFail($id);

        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $pedagogicals = Educational::whereYear('date_pedagogical', $year)
            ->where('student_id', $id)
            ->orderBy('date_pedagogical', 'desc')
            ->with('student', 'professor')
            ->paginate(15)->appends(request()->query());

            $scrollBack2 = true;
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = Carbon::now()->year;
            $pedagogicals = Educational::whereYear('date_pedagogical', $year)
            ->where('student_id', $id)
            ->orderBy('date_pedagogical', 'desc')
            ->with('student', 'professor')
            ->paginate(15)->appends(request()->query());
        }

        // Obtém os anos disponíveis para o select
        $years = Educational::selectRaw('YEAR(date_pedagogical) as year')
            ->distinct()
            ->where('student_id', $id)
            ->orderByDesc('year')->pluck('year', 'year');

        return view('student.show_parts.educationalShow', compact('student', 'pedagogicals', 'years', 'year',));
    }

    public function edit($id, Request $request)
    {
        $student = Student::with('professors')->findOrFail($id);

        $professors = User::where('position', 'Professor(a)')->get();

        // Convert data to string
        $student['date_of_birth'] = \Carbon\Carbon::createFromFormat('Y-m-d', $student['date_of_birth'])->format('d/m/Y');

        $element = null;
        $notRegularSidebar = null;
        if($request->notRegularSidebar) {
            $element = $student;
            $notRegularSidebar = true;
        }
        return view('student.edit', compact('student', 'professors', 'element', 'notRegularSidebar'));
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->validated();

        // Pegar os dados menos professors_service que não existe na tabela de students
        $studentData = collect($data)->except('professors_service')->toArray();

        // Convert string to data
        $studentData['date_of_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $studentData['date_of_birth'])->format('Y-m-d');

        if ($request->has('image')) {
            //Check old image
            $destination = "img/student/" . $student->image;

            //Remove old images
            if (\File::exists(public_path($destination)) && $student->image !== "Foto_Desconhecido.jpg") {
                \File::delete(public_path($destination));
            }

            //Add new image
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            //Update new image
            $request->image->move(public_path('img/student/'), $imageName);
            $studentData['image'] = $imageName;

        }
        ;

        $input = $student->update($studentData);

        $student->professors()->sync($data['professors_service']); // Atualiza os professores vinculados

        if ($input) {
            session()->flash('success', 'Aluno atualizado com sucesso!');
            broadcast(new CrudUpdated('updated', 'student'))->toOthers();
            if(route('student.index') == session('previous_url_secondary')) {
                return redirect()->route('student.index');
            } 
            elseif (route('student.deposit') == session('previous_url_secondary')) {
                return redirect()->route('student.deposit');
            }
            else {
                $notRegularSidebar = true;
                return redirect()->route('student.show', [
                    'student' => $id,
                    'element' => $student,
                    'notRegularSidebar' => $notRegularSidebar,
                ]);
            }
        } else {
            session()->flash('error', 'Falha na edição do Aluno');
            return redirect()->route('student.edit');
        }

    }
    public function getDaysNotRequired($classType, $year, $month, $numberDaysInMonth)
    {
        $daysNotRequired = [];

        for ($i = 0; $i < $numberDaysInMonth; $i++) {
            $date = sprintf("%04d-%02d-%02d", $year, $month, $i + 1); // Corrigido para o dia 1 até 31
            $dayOfWeek = date('N', strtotime($date)); // Obtém o dia da semana como número (1 = Segunda, 7 = Domingo)

            // Lógica para diferentes combinações de dias da semana
            switch ($classType) {
                case 'Segunda':
                    if ($dayOfWeek != 1)
                        $daysNotRequired[] = $date;
                    break;
                case 'Terça':
                    if ($dayOfWeek != 2)
                        $daysNotRequired[] = $date;
                    break;
                case 'Quarta':
                    if ($dayOfWeek != 3)
                        $daysNotRequired[] = $date;
                    break;
                case 'Quinta':
                    if ($dayOfWeek != 4)
                        $daysNotRequired[] = $date;
                    break;
                case 'Sexta':
                    if ($dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Terça':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Quarta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 3)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Quinta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 4)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Terça e Quarta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 3)
                        $daysNotRequired[] = $date;
                    break;
                case 'Terça e Quinta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 4)
                        $daysNotRequired[] = $date;
                    break;
                case 'Terça e Sexta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Quarta e Quinta':
                    if ($dayOfWeek != 3 && $dayOfWeek != 4)
                        $daysNotRequired[] = $date;
                    break;
                case 'Quarta e Sexta':
                    if ($dayOfWeek != 3 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Quinta e Sexta':
                    if ($dayOfWeek != 4 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Terça e Quarta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2 && $dayOfWeek != 3)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Terça e Quinta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2 && $dayOfWeek != 4)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Terça e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Quarta e Quinta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 3 && $dayOfWeek != 4)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Quarta e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 3 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Quinta e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 4 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Terça, Quarta e Quinta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 3 && $dayOfWeek != 4)
                        $daysNotRequired[] = $date;
                    break;
                case 'Terça, Quarta e Sexta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 3 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Terça, Quinta e Sexta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 4 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                case 'Quarta, Quinta e Sexta':
                    if ($dayOfWeek != 3 && $dayOfWeek != 4 && $dayOfWeek != 5)
                        $daysNotRequired[] = $date;
                    break;
                default:
                    if ($dayOfWeek < 6) { // De segunda a sexta
                        $daysNotRequired[] = $date;
                    }
                    break;
            }
        }

        return $daysNotRequired;
    }
}

// Destroy para as imagens
// if ($data->image) {
//     $destination = public_path('img/student/' . $data->image);

//     if (file_exists($destination) && $destination != public_path('img/student/Foto_Desconhecido.jpg')) {
//         unlink($destination);
//     };
// };