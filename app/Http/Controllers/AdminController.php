<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Frequency;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() 
    {
        $students = Student::where('state_student', 'alive');

        $yearsArray = Donation::selectRaw('year_of_donation as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray(); // Converta a coleção em um array simples

        $years = array_map('strval', $yearsArray);
        
        $currentYear = \Carbon\Carbon::now()->year;

        // Verifica se o próximo ano já está no array, se não estiver, adiciona
        $nextYear = strval($currentYear + 1);
        if (!in_array($nextYear, $years)) {
            array_unshift($years, $nextYear);
        }

        return view('admin.index', compact('students', 'years'));
    }

    public function checkStudentsFrequenciesDonations(Request $request) 
    {
        $request->validate([
            'month' => 'required|string',
            'year' => 'required|string',
        ]);

        $month = $this->getMonthNumber($request->month);
        $monthYear = $month . '/' . $request->year;

        // Busca estudantes ativos e inativos
        $activeStudents = Student::where('state_student', 'alive')->orderBy('name', 'asc')->get();
        $archivedStudents = Student::where('state_student', 'archived')->orderBy('name', 'asc')->get();

        // Combina os estudantes
        $students = $activeStudents->merge($archivedStudents);

        // Busca frequências e doações apenas para estudantes ativos
        $studentIds = $students->pluck('id')->toArray();

        $frequencies = Frequency::whereIn('student_id', $studentIds)
            ->where('month_year', $monthYear)
            ->get()
            ->keyBy('student_id'); // Organiza por student_id para fácil acesso

        $donations = Donation::whereIn('student_id', $studentIds)
            ->where('year_of_donation', $request->year)
            ->get()
            ->keyBy('student_id'); // Organiza por student_id para fácil acesso

        $studentsData = $students->map(function ($student) use ($frequencies, $donations) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'state' => $student->state_student, 
                'frequency_status' => $frequencies->has($student->id) ? 'Presente' : 'Não Criado',
                'donation_status' => $donations->has($student->id) ? 'Presente' : 'Não Criado',
            ];
        });

        return response()->json([
            'students' => $studentsData,
            'monthYear' => ' - '. $monthYear,
        ]);
    }

    public function updateFrequenciesDonations(Request $request) 
    {
        try {
            // Validação dos dados enviados
            $request->validate([
                'month' => 'required|string',
                'year' => 'required|string',
                'student_ids' => 'required|array',
            ]);

            $month = $this->getMonthNumber($request->month);
            $monthYear = $month . '/' . $request->year;

            $activeStudents = Student::where('state_student', 'alive')->get();
            $activeStudentIds = $activeStudents->pluck('id')->toArray();

            // Cria frequências e doações apenas para estudantes ativos
            $status = [];

            // Cria frequências e doações apenas para estudantes ativos
            $studentsData = [];

            foreach ($request->student_ids as $studentId) {
                if (in_array($studentId, $activeStudentIds)) {
                    $frequencyStatus = 'Já Presente';
                    $donationStatus = 'Já Presente';

                    // Verifica se a frequência já existe
                    if (!Frequency::where('student_id', $studentId)->where('month_year', $monthYear)->exists()) {
                        $student = Student::where('id', $studentId)->first();
                        Frequency::create([
                            'student_id' => $studentId,
                            'class_apae' => $student->class_apae,
                            'turn_apae' => $student->turn_apae,
                            'month_year' => $monthYear,
                        ]);
                        $frequencyStatus = 'Criado';
                    }

                    // Verifica se a doação já existe
                    if (!Donation::where('student_id', $studentId)->where('year_of_donation', $request->year)->exists()) {
                        Donation::create([
                            'student_id' => $studentId,
                            'year_of_donation' => $request->year,
                        ]);
                        $donationStatus = 'Criado';
                    }

                    // Adiciona os dados do estudante
                    $studentsData[] = [
                        'id' => $studentId,
                        'frequency_status' => $frequencyStatus,
                        'donation_status' => $donationStatus,
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Frequências e doações processadas com sucesso!',
                'students' => $studentsData,
            ]);
        } catch (\Exception $e) {
            // Log do erro
            \Log::error('Erro ao processar frequências e doações: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro interno no servidor.', // Mensagem de erro para o toastr
            ], 500);
        }
    }

    /**
     * Validate password to create, update or delete users
     */
    public function validatePassword(Request $request)
    {
        $senha = $request->input('senha');
        $senhaCorreta = 'apae2006';

        if ($senha === $senhaCorreta) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }
    public function deleteFrequency($studentId, Request $request)
    {
        try {

            $month = $this->getMonthNumber($request->month);
            $monthYear = $month . '/' . $request->year;

            Frequency::where('student_id', $studentId)
            ->where('month_year', $monthYear)
            ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Frequência apagada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao apagar frequência.',
            ], 500);
        }
    }

    public function deleteDonation($studentId, Request $request)
    {
        try {
            
            Donation::where('student_id', $studentId)
            ->where('year_of_donation', $request->year)
            ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Doação apagada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao apagar doação.',
            ], 500);
        }
    }

    public function getMonthNumber($monthName)
    {
        $months = [
            'Janeiro' => '01', 'Fevereiro' => '02', 'Março' => '03',
            'Abril' => '04', 'Maio' => '05', 'Junho' => '06',
            'Julho' => '07', 'Agosto' => '08', 'Setembro' => '09',
            'Outubro' => '10', 'Novembro' => '11', 'Dezembro' => '12',
        ];

        return $months[$monthName] ?? '01';
    }
}
