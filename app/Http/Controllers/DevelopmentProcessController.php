<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentProcess;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DevelopmentProcessController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $processes = DevelopmentProcess::with([
            'student',
            'user',
            'teacher',
        ])
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('development_processes.index', compact(
            'processes',
            'search'
        ));
    }

    public function create()
    {
        $students = Student::query()
            ->where(function ($query) {
                $query->where('state_student', 'alive')
                    ->orWhereNull('state_student');
            })
            ->orderBy('name')
            ->get(['id', 'name']);

        $teachers = User::query()
            ->where('position', '!=', '---')
            ->orderBy('name')
            ->get(['id', 'name']);

        $process = new DevelopmentProcess();

        return view('development_processes.create', compact(
            'students',
            'teachers',
            'process'
        ));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProcess($request);

        $validated['user_id'] = auth()->id();

        $process = DevelopmentProcess::create($validated);

        return redirect()
            ->route('development-processes.show', $process)
            ->with(
                'success',
                'Registro de Processo de Desenvolvimento Individual CAEE salvo com sucesso.'
            );
    }

    public function show(DevelopmentProcess $development_process)
    {
        $development_process->load([
            'student',
            'user',
            'teacher',
        ]);

        return view('development_processes.show', [
            'process' => $development_process,
        ]);
    }

    public function edit(DevelopmentProcess $development_process)
    {
        $students = Student::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        $teachers = User::query()
            ->where('position', '!=', '---')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('development_processes.edit', [
            'process' => $development_process,
            'students' => $students,
            'teachers' => $teachers,
        ]);
    }

    public function update(
        Request $request,
        DevelopmentProcess $development_process
    ) {
        $validated = $this->validateProcess($request);

        $development_process->update($validated);

        return redirect()
            ->route('development-processes.show', $development_process)
            ->with('success', 'Registro atualizado com sucesso.');
    }

    public function destroy(DevelopmentProcess $development_process)
    {
        $development_process->delete();

        return redirect()
            ->route('development-processes.index')
            ->with('success', 'Registro excluído com sucesso.');
    }

    private function validateProcess(Request $request): array
    {
        return $request->validate([
            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
            ],
            'teacher_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->where('position', '!=', '---'),
            ],
            'evaluation_date' => [
                'nullable',
                'date',
            ],
            'responses' => [
                'nullable',
                'array',
            ],
            'responses.*' => [
                'nullable',
            ],
            'responses.*.*' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'observations' => [
                'nullable',
                'string',
            ],
            'family_guidance' => [
                'nullable',
                'string',
            ],
            'teacher_signature' => [
                'nullable',
                'string',
                'max:255',
            ],
            'coordination_signature' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);
    }
}