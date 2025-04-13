<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Educational;
use App\Models\User;
use App\Models\Student;
use App\Http\Requests\EducationalRequest;
use Carbon\Carbon;

class EducationalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        $context = 'educational';
        
        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $pedagogicals = Educational::whereYear('date_pedagogical', $year)
            ->orderBy('date_pedagogical', 'desc')
            ->with('student', 'professor')
            ->paginate(15)->appends(request()->query());
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = Carbon::now()->year;
            $pedagogicals = Educational::whereYear('date_pedagogical', $year)
            ->orderBy('date_pedagogical', 'desc')
            ->with('student', 'professor')
            ->paginate(15)->appends(request()->query());
        }

        // Obtém os anos disponíveis para o select
        $years = Educational::selectRaw('YEAR(date_pedagogical) as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');
        
        return view('educational.home', compact('pedagogicals', 'years', 'year', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::where('state_student', 'alive')
        ->orderBy('name', 'asc')
        ->get();
        foreach($students as $student) {
            $dateOfBirth = Carbon::parse($student->date_of_birth);
            $now = Carbon::now();
            $student->age = (int) $dateOfBirth->diffInYears($now);
        }
        $professors = User::orderBy('name', 'asc')
        ->where('position', 'professor(a)')  
        ->where('state_user', 'alive')
        ->get();

        return view("educational.create", compact('students', 'professors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationalRequest $request)
    {   
        $data = $request->validated();
        // Convert string to data
        $data['date_pedagogical'] = Carbon::createFromFormat('d/m/Y', $data['date_pedagogical'])->format('Y-m-d');

        $input = Educational::create($data);
        if ($input) {
            session()->flash('success', 'Relatório Pedagógico adicionado com sucesso');
            broadcast(new CrudUpdated('created',  'educational'))->toOthers();
            return redirect()->route('educational.index');
        } else {
            session()->flash('error', 'Falha na criação do Relatório Pedagógico');
            return redirect()->route('educational.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pedagogical = Educational::with('student', 'professor')->findOrFail($id);
        $pedagogical['date_pedagogical'] = Carbon::createFromFormat('Y-m-d', $pedagogical['date_pedagogical'])->format('d/m/Y');

        // Obter a data de nascimento do aluno e formatá-la
        $pedagogical->student->date_of_birth = Carbon::createFromFormat('Y-m-d', $pedagogical->student->date_of_birth)->format('d/m/Y');

        // Passar as variáveis para a view
        return view('educational.show', compact('pedagogical'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pedagogical = Educational::with('student')->findOrFail($id);

        $students = Student::where('state_student', 'alive')
        ->orderBy('name', 'asc')
        ->get();
        $professors = User::orderBy('name', 'asc')
        ->where('position', 'professor(a)')  
        ->get();

        //Convert data to string
        $pedagogical['date_pedagogical'] = Carbon::createFromFormat('Y-m-d', $pedagogical['date_pedagogical'])->format('d/m/Y');

        return view('educational.edit', compact('pedagogical', 'students', 'professors')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationalRequest $request, $id)
    {
        $pedagogical = Educational::findOrFail($id);
        $data = $request->validated();
        // Convert string to data
        $data['date_pedagogical'] = Carbon::createFromFormat('d/m/Y', $data['date_pedagogical'])->format('Y-m-d');

        $input = $pedagogical->update($data);
        
        if ($input) {
            session()->flash('success', 'Relatório Pedagógico atualizado com sucesso!');
            broadcast(new CrudUpdated('updated',  'educational'))->toOthers();
            return redirect()->route('educational.index');
        } else {
            session()->flash('error', 'Falha na edição do Relatório Pedagógico');
            return redirect()->route('educational.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $input = Educational::destroy($id);

        if ($input) {
            session()->flash('success', 'Relatório Pedagógico excluído com sucesso!');
            broadcast(new CrudUpdated('deleted',  'educational'))->toOthers();
            return redirect()->route('educational.index');
        } else {
            session()->flash('error', 'Erro na exclusão do Relatório Pedagógico');
            return redirect()->route('educational.index');
        }
    }
    public function generatePdf($id) 
    {
        $data = Educational::with('student', 'professor')->findOrFail($id);
        $data->student['date_of_birth'] = Carbon::createFromFormat('Y-m-d', $data->student['date_of_birth'])->format('d/m/Y');
        
        list($year, $month, $day) = explode('-', $data->date_pedagogical);
        $nameMonth = $this->getMonthName((int) $month);
        $data->date_pedagogical = $day . '/' . $nameMonth . '/' . $year;

        $html = view('export.educationalPdf', compact('data'))->render();
    
        // Para adicionar o css diretamente ao html
        $css = file_get_contents(public_path('css/export.css'));
        $html = str_replace('</head>', '<style>' . $css . '</style></head>', $html);

        // Gera o PDF
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        // $filename = 'Relatório - ' . $data->student->name . ' ' . $data->period . ' Semestre.pdf';
        // return $pdf->download($filename);
        return $pdf->stream();
    }

    public function getMonthName($monthNumber)
    {
        $months = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];

        return $months[$monthNumber] ?? 'Mês inválido';
    }
}
