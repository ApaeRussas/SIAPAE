<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedHistoryRequest;
use App\Models\MedHistory;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class MedHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = request('search');
        
        if ($search) {
            $medHistories = MedHistory::with('student', 'user')
            ->whereHas('student', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->select('med_histories.*')
            ->join('students', 'students.id', '=', 'med_histories.student_id')  
            ->orderBy('students.name', 'asc')
            ->paginate(15);
        } else {
            $medHistories = MedHistory::select('med_histories.*')
                ->join('students', 'students.id', '=', 'med_histories.student_id')
                ->with('student', 'user')
                ->orderBy('students.name', 'asc')
                ->paginate(15);
        }

        return view('med_history.home', compact('medHistories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('name', 'asc')
        ->where('state_student', 'alive')
        ->get();

        $users = User::orderBy('name', 'asc')
        ->where('position', '!=', '---')
        ->where('state_user', 'alive')
        ->get();

        return view('med_history.create', compact('students', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedHistoryRequest $request)
    {
        $data = $request->validated();

        // Convert string to data
        $data['date_of_anamnesis'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_anamnesis'])->format('Y-m-d');
        $data['date_mother'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_mother'])->format('Y-m-d');
        $data['date_father'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_father'])->format('Y-m-d');

        $input = MedHistory::create($data);
        if ($input) {
            session()->flash('success', 'Anamnese adicionada com sucesso');
            return redirect()->route('anamnesis.index');

        } else {
            session()->flash('error', 'Falha na criação da Anamnese');
            return redirect()->route('anamnesis.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medHistory = MedHistory::with('student')->findOrFail($id);

        $medHistory['date_of_anamnesis'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_of_anamnesis'])->format('d/m/Y');
        $medHistory['date_mother'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_mother'])->format('d/m/Y');
        $medHistory['date_father'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_father'])->format('d/m/Y');
        
        return view('med_history.show', compact('medHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medHistory = MedHistory::with('student')
        ->findOrFail($id);
        $users = User::orderBy('name', 'asc')
        ->where('position', '!=', '---')
        ->where('state_user', 'alive')
        ->get();

        $medHistory['date_of_anamnesis'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_of_anamnesis'])->format('d/m/Y');
        $medHistory['date_mother'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_mother'])->format('d/m/Y');
        $medHistory['date_father'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_father'])->format('d/m/Y');

        $students = Student::orderBy('name', 'asc')
        ->where('state_student', 'alive')
        ->get();

        return view('med_history.edit', compact('medHistory', 'students', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedHistoryRequest $request, $id)
    {
        $medHistory = MedHistory::findOrFail($id);

        $data = $request->validated();

        // Convert string to data
        $data['date_of_anamnesis'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_anamnesis'])->format('Y-m-d');
        $data['date_mother'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_mother'])->format('Y-m-d');
        $data['date_father'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_father'])->format('Y-m-d');

        $input = $medHistory->update($data);
        if ($input) {
            session()->flash('success', 'Anamnese atualizada com sucesso');
            return redirect()->route('anamnesis.index');

        } else {
            session()->flash('error', 'Falha na atualização da Anamnese');
            return redirect()->route('anamnesis.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = MedHistory::findOrFail($id);
        // Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year; 

        $input = MedHistory::destroy($id);
        if ($input) {
            session()->flash('success', 'Anamnese excluída com sucesso!');
            return redirect()->route('anamnesis.index');
        } else {
            session()->flash('error', 'Erro na exclusão da Anamnese');
            return redirect()->route('anamnesis.index');
        }
    }
}
