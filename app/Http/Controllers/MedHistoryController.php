<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use App\Http\Requests\MedHistoryRequest;
use App\Models\MedHistory;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class MedHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $context = 'medHistory';

        $search = request('search');
        
        if ($search) {
            $medHistories = MedHistory::with('student', 'user')
                ->whereHas('student', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->select('med_histories.*')
                ->join('students', 'students.id', '=', 'med_histories.student_id')
                ->where('students.state_student', 'alive')
                ->orderBy('students.name', 'asc')
                ->paginate(15)->appends(request()->query());
        } else {
            $medHistories = MedHistory::select('med_histories.*')
                ->join('students', 'students.id', '=', 'med_histories.student_id')
                ->with('student', 'user')
                ->where('students.state_student', 'alive')
                ->orderBy('students.name', 'asc')
                ->paginate(15)->appends(request()->query());
        }

        return view('med_history.home', compact('medHistories', 'search', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $student_id = $request->student_id ?? null;
        $students = Student::orderBy('name', 'asc')
        ->where('state_student', 'alive')
        ->get();

        $users = User::orderBy('name', 'asc')
        ->where('position', '!=', '---')
        ->where('state_user', 'alive')
        ->get();

        return view('med_history.create', compact('students', 'users', 'student_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedHistoryRequest $request)
    {
        $data = $request->validated();

        // Convert string to data
        $data['date_of_anamnesis'] = Carbon::createFromFormat('d/m/Y', $data['date_of_anamnesis'])->format('Y-m-d');
        $data['date_mother'] = Carbon::createFromFormat('d/m/Y', $data['date_mother'])->format('Y-m-d');
        $data['date_father'] = (isset($data['date_father']) ? Carbon::createFromFormat('d/m/Y', $data['date_father'])->format('Y-m-d') : null);

        $input = MedHistory::create($data);
        if ($input) {
            session()->flash('success', 'Anamnese adicionada com sucesso');
            broadcast(new CrudUpdated('created',  'medHistory'))->toOthers();
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
        session(['previous_url_secondary' => url()->full()]);
        $medHistory = MedHistory::with('student')->findOrFail($id);

        $medHistory['date_of_anamnesis'] = Carbon::createFromFormat('Y-m-d', $medHistory['date_of_anamnesis'])->format('d/m/Y');
        $medHistory['date_mother'] = Carbon::createFromFormat('Y-m-d', $medHistory['date_mother'])->format('d/m/Y');
        $medHistory['date_father'] = (isset($medHistory['date_father']) ? Carbon::createFromFormat('Y-m-d', $medHistory['date_father'])->format('d/m/Y') : null);
        
        return view('med_history.show', compact('medHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $medHistory = MedHistory::with('student')
        ->findOrFail($id);
        $users = User::orderBy('name', 'asc')
        ->where('position', '!=', '---')
        ->where('state_user', 'alive')
        ->get();

        $medHistory['date_of_anamnesis'] = Carbon::createFromFormat('Y-m-d', $medHistory['date_of_anamnesis'])->format('d/m/Y');
        $medHistory['date_mother'] = Carbon::createFromFormat('Y-m-d', $medHistory['date_mother'])->format('d/m/Y');
        $medHistory['date_father'] = (isset($medHistory['date_father']) ? Carbon::createFromFormat('Y-m-d', $medHistory['date_father'])->format('d/m/Y') : null);

        $query = Student::orderBy('name', 'asc');
        if($medHistory->student->state_student === 'alive') {
            $query = $query->where('state_student', 'alive');
        } else {
            $query = $query->where('id', $medHistory->student->id);
        }
        $students = $query->get();

        $element = null;
        $notRegularSidebar = null;
        if($request->notRegularSidebar) {
            $element = Student::where('id', $medHistory->student_id)->first();
            $notRegularSidebar = true;
        }

        return view('med_history.edit', compact('medHistory', 'students', 'users', 'element', 'notRegularSidebar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedHistoryRequest $request, $id)
    {
        $medHistory = MedHistory::findOrFail($id);
        $student_id = $medHistory->student_id;

        $data = $request->validated();

        // Convert string to data
        $data['date_of_anamnesis'] = Carbon::createFromFormat('d/m/Y', $data['date_of_anamnesis'])->format('Y-m-d');
        $data['date_mother'] = Carbon::createFromFormat('d/m/Y', $data['date_mother'])->format('Y-m-d');
        $data['date_father'] = (isset($data['date_father']) ? Carbon::createFromFormat('d/m/Y', $data['date_father'])->format('Y-m-d') : null);

        $input = $medHistory->update($data);
        if ($input) {
            session()->flash('success', 'Anamnese atualizada com sucesso');
            broadcast(new CrudUpdated('updated',  'medHistory'))->toOthers();
            if(route('anamnesis.index') == session('previous_url')) {
                return redirect()->route('anamnesis.index');
            } 
            elseif (route('anamnesis.deposit') == session('previous_url')) {
                return redirect()->route('anamnesis.deposit');
            } 
            else {
                $element = Student::where('id', $student_id)->first();
                $notRegularSidebar = true;
                return redirect()->route('student.showMedhistory', [
                    'id' => $student_id,
                    'element' => $element,
                    'notRegularSidebar' => $notRegularSidebar,
                ]);
            }

        } else {
            session()->flash('error', 'Falha na atualização da Anamnese');
            return redirect()->route('anamnesis.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $data = MedHistory::findOrFail($id);
        $student_id = $data->student_id;
        // Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = Carbon::parse($data['date']);
        $year = $carbonDate->year; 

        $input = MedHistory::destroy($id);
        if ($input) {
            session()->flash('success', 'Anamnese excluída com sucesso!');
            broadcast(new CrudUpdated('deleted',  'medHistory'))->toOthers();
            if($request->notRegularSidebar) {
                $element = Student::where('id', $student_id)->first();
                $notRegularSidebar = true;
                return redirect()->route('student.showMedhistory', [
                    'id' => $student_id,
                    'element' => $element,
                    'notRegularSidebar' => $notRegularSidebar,
                ]);
            } else {
                return redirect()->route('anamnesis.index');
            }
        } else {
            session()->flash('error', 'Erro na exclusão da Anamnese');
            return redirect()->route('anamnesis.index');
        }
    }

    public function deposit() 
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $context = 'medHistory';

        $search = request('search');
        
        if ($search) {
            $medHistories = MedHistory::with('student', 'user')
                ->whereHas('student', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->select('med_histories.*')
                ->join('students', 'students.id', '=', 'med_histories.student_id')  
                ->where('students.state_student', 'archived')
                ->orderBy('students.name', 'asc')
                ->paginate(15)->appends(request()->query());
        } else {
            $medHistories = MedHistory::select('med_histories.*')
                ->join('students', 'students.id', '=', 'med_histories.student_id')
                ->with('student', 'user')
                ->where('students.state_student', 'archived')
                ->orderBy('students.name', 'asc')
                ->paginate(15)->appends(request()->query());
        }

        return view('med_history.deposit', compact('medHistories', 'search', 'context'));
    }
}
