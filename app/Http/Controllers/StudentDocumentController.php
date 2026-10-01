<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentDocumentController extends Controller
{
    /**
     * Lista os documentos cadastrados.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::query()
            ->where('state_student', '!=', 'Arquivado')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->get();

        $documents = StudentDocument::with(['student', 'uploadedBy'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        return view('student-document.index', compact(
            'students',
            'documents',
            'search'
        ));
    }

    /**
     * Mostra o formulário para adicionar um documento.
     */
    public function create()
    {
        $students = Student::query()
            ->where('state_student', '!=', 'Arquivado')
            ->orderBy('name')
            ->get();

        return view('student-document.create', compact('students'));
    }

    /**
     * Salva um novo documento.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'document_type' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'document' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,doc,docx',
                'max:10240',
            ],
        ]);

        $file = $request->file('document');

        $path = $file->store('student-documents');

        StudentDocument::create([
            'student_id' => $validated['student_id'],
            'uploaded_by' => Auth::id(),
            'document_type' => $validated['document_type'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()
            ->route('student-documents.index')
            ->with('success', 'Documento cadastrado com sucesso.');
    }

    /**
     * Faz o download do documento.
     */
    public function download(StudentDocument $studentDocument)
    {
        if (!Storage::exists($studentDocument->file_path)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return Storage::download(
            $studentDocument->file_path,
            $studentDocument->original_name
        );
    }

    /**
     * Exclui um documento.
     */
    public function destroy(StudentDocument $studentDocument)
    {
        if (Storage::exists($studentDocument->file_path)) {
            Storage::delete($studentDocument->file_path);
        }

        $studentDocument->delete();

        return redirect()
            ->route('student-documents.index')
            ->with('success', 'Documento excluído com sucesso.');
    }
}