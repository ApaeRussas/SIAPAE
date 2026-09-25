<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use App\Models\MedHistory;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de estudantes cadastrados
        $totalStudents = Student::count();

        // Total de atendimentos cadastrados
        $totalAttendances = Attendance::count();

        // Total de históricos médicos/anamneses cadastrados
        $totalAnamneses = MedHistory::count();

        // Últimos 5 atendimentos
        $recentAttendances = Attendance::with('student')
            ->orderByDesc('date')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalStudents',
            'totalAttendances',
            'totalAnamneses',
            'recentAttendances'
        ));
    }
}