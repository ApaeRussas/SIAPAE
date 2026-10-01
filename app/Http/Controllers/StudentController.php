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
use App\Models\DiagnosticAssessment;

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
    public function show($id, Request $request)
    {
        session(['previous_url_secondary' => url()->full()]);

        $student = Student::findOrFail($id);

        $student->load('professors');

        /*
        |--------------------------------------------------------------------------
        | ABA ATUAL DO PERFIL
        |--------------------------------------------------------------------------
        */

        $tab = $request->get('tab', 'perfil');


        /*
        |--------------------------------------------------------------------------
        | HISTÓRICO MÉDICO
        |--------------------------------------------------------------------------
        */

        $medHistory = null;

        $medHistoryExists = MedHistory::where(
            'student_id',
            $id
        )->exists();

        if ($medHistoryExists) {

            $medHistory = MedHistory::where(
                'student_id',
                $id
            )->first();

        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $isArchived = null;

        if ($student->state_student === 'archived') {

            $isArchived = true;

        }


        /*
        |--------------------------------------------------------------------------
        | IDADE
        |--------------------------------------------------------------------------
        */

        $dateOfBirth = Carbon::parse(
            $student->date_of_birth
        );

        $now = Carbon::now();

        $ageYears = (int) $dateOfBirth->diffInYears($now);

        $dateOfBirth = $dateOfBirth->addYears($ageYears);

        $ageMonths = (int) $dateOfBirth->diffInMonths($now);

        $dateOfBirth = $dateOfBirth->addMonths($ageMonths);

        $ageDays = (int) $dateOfBirth->diffInDays($now);

        $student->age =
            "$ageYears anos, $ageMonths meses e $ageDays dias";


        /*
        |--------------------------------------------------------------------------
        | SONDAGENS DO ALUNO
        |--------------------------------------------------------------------------
        */

        $diagnosticAssessments = collect();

        if ($tab === 'sondagens') {

            $diagnosticAssessments = DiagnosticAssessment::where(
                'student_id',
                $id
            )
                ->orderByDesc('date')
                ->paginate(10)
                ->appends(request()->query());

        }


        /*
        |--------------------------------------------------------------------------
        | EVOLUÇÕES PEDAGÓGICAS DO ALUNO
        |--------------------------------------------------------------------------
        */

        $pedagogicals = collect();

        if ($tab === 'evolucao') {

            $pedagogicals = Educational::where(
                'student_id',
                $id
            )
                ->orderByDesc('date_pedagogical')
                ->with('student', 'professor')
                ->paginate(10)
                ->appends(request()->query());

        }


        return view(
            'student.show',
            compact(
                'student',
                'medHistory',
                'isArchived',
                'tab',
                'diagnosticAssessments',
                'pedagogicals'
            )
        );
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