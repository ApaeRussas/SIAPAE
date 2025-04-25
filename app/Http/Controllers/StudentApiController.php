<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use App\Http\Controllers\Controller;
use App\Models\MedHistory;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    public function getStudentData($id)
    {
        $student = Student::find($id);

        $dateOfBirth = Carbon::parse($student->date_of_birth);
        $now = Carbon::now();

        $ageYears = (int) $dateOfBirth->diffInYears($now);
        $student->age = $ageYears . ' anos';

        //Retorna os dados do aluno em formato JSON
        if ($student) {
            return response()->json([
                'date_of_birth' => Carbon::createFromFormat('Y-m-d', $student->date_of_birth)->format('d/m/Y'),
                'diagnostic' => $student->diagnostic,
                'school' => $student->school,
                'grade_school' => $student->grade_school,
                'sige' => $student->sige,
                'turn_school' => $student->turn_school,
                'age' => $student->age,
                'name_mother' => $student->name_mother,
            ]);
        } else {
            return response()->json(['error' => 'Estudante não encontrado'], 404);
        }

    }
    
    public function deposit() 
    {
        session(['previous_url' => url()->full()]);
        $context = 'student';
        
        $search = request('search');
        
        if ($search) {
            $students = Student::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_student', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15)->appends(request()->query());
        } else {
            $students = Student::where('state_student', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15)->appends(request()->query());
        }

        return view('student.deposit', compact('students', 'search', 'context'));
    }
    public function archive($id, Request $request)
    {
        $request->validate([
            'justificativa' => 'required|string|min:5|max:2000',
        ]);

        $student = Student::find($id);
        
        $student['state_student'] = 'archived';

        if ($student->image) {
            $destination = public_path('img/student/' . $student->image);
            
            if (file_exists($destination) && $destination != public_path('img/student/Foto_Desconhecido.jpg')) {
                $student['image'] = 'Foto_Desconhecido.jpg';
                unlink($destination); // Comando para retirar a imagem
            };
        };

        // Justificativa do desligamento
        $student->archiving_justify = $request->input('justificativa');

        $input = $student->save();

        if ($input) {
            session()->flash('success', 'Aluno arquivado com sucesso!');
            broadcast(new CrudUpdated('archived',  'student'))->toOthers();
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Erro na arquivação do Aluno');
            return redirect()->route('student.index');
        }
    }
    public function restore($id) 
    {
        $student = Student::find($id);

        $student['archiving_justify'] = null;
        $student['state_student'] = 'alive';

        $input = $student->save();

        if ($input) {
            session()->flash('success', 'Aluno Restaurado com sucesso!');
            broadcast(new CrudUpdated('restored',  'student'))->toOthers();
            return redirect()->route('student.deposit');
        } else {
            session()->flash('error', 'Erro na restauração do Aluno');
            return redirect()->route('student.deposit');
        }
    }
}
