<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
                'class_school' => $student->class_school,
                'turn_school' => $student->turn_school,
                'age' => $student->age,
            ]);
        } else {
            return response()->json(['error' => 'Estudante não encontrado'], 404);
        }

    }
    
    public function deposit() 
    {
        $search = request('search');
        
        if ($search) {
            $students = Student::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_student', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        } else {
            $students = Student::where('state_student', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        }

        return view('student.deposit', compact('students', 'search'));
    }
    public function archive($id)
    {
        $student = Student::find($id);

        $student['state_student'] = 'archived';

        if ($student->image) {
            $destination = public_path('img/student/' . $student->image);
            
            if (file_exists($destination) && $destination != public_path('img/student/Foto_Desconhecido.jpg')) {
                $student['image'] = 'Foto_Desconhecido.jpg';
                unlink($destination); // Comando para retirar a imagem
            };
        };

        $input = $student->save();

        if ($input) {
            session()->flash('success', 'Aluno arquivado com sucesso!');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Erro na arquivação do Aluno');
            return redirect()->route('student.index');
        }
    }
    public function restore($id) 
    {
        $student = Student::find($id);

        $student['state_student'] = 'alive';

        $input = $student->save();

        if ($input) {
            session()->flash('success', 'Aluno Restaurado com sucesso!');
            return redirect()->route('student.deposit');
        } else {
            session()->flash('error', 'Erro na restauração do Aluno');
            return redirect()->route('student.deposit');
        }
    }
}
