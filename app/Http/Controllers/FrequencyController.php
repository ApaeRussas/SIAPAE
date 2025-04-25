<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use App\Models\Frequency;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $context = 'frequency';
        
        $professors = User::where('position', 'professor(a)')
            ->where('state_user', 'alive')
            ->orderBy('name', 'asc')
            ->get();

        $turn_apae = request('turn_apae');
        $monthYear = request('monthYear');
        $professor_id = request('professor_select');

        $query = Frequency::join('students', 'frequencies.student_id', '=', 'students.id')
            ->select('frequencies.*')
            ->with('student', 'professor');

        if ($turn_apae) {
            $query->where('students.turn_apae', $turn_apae);
        }

        if ($monthYear) {
            $query->where('frequencies.month_year', $monthYear);
        } else {
            // Condições padrão baseadas na hora local e dia da semana
            $horaLocal = Carbon::now('America/Sao_Paulo')->format('H');
            if ($horaLocal <= 12) {
                $turn_apae = 'Manhã';
            } else {
                $turn_apae = 'Tarde';
            }

            $monthYear = Carbon::now()->format('m/Y');

            $query->where('students.turn_apae', $turn_apae)
                ->where('frequencies.month_year', $monthYear);
        }
        
        if($professor_id) {
            $query->whereHas('student.professors', function ($query) use ($professor_id) {
                $query->where('users.id', $professor_id);
            });
        }

        $frequencies = $query->orderBy('students.name', 'asc')->paginate(15)->appends(request()->query());

        //Para funcionar a gambiarra já que cada aluno tem a sua observação e assinatura na coluna
        $observation = null;
        $signature_id = null;

        // Loop através dos elementos para encontrar as observações e assinaturas
        for ($i = 0; $i < count($frequencies) - 1; $i++) {
            $currentElement = $frequencies[$i];
            $nextElement = $frequencies[$i + 1] ?? null;

            // Verifica se as observações do elemento atual e o próximo são iguais
            if ($currentElement['observation'] == $nextElement['observation']) {
                $observation = $currentElement['observation'] ?? null;
                $signature_id = $nextElement['signature_id'] ?? null;
                break;  // Encontrou uma correspondência, podemos sair do loop
            }
        }
        if (!$frequencies[1]) {
            $observation = $frequencies[0]['observation'] ?? null;
            $signature_id = $frequencies[0]['signature_id'] ?? null;
        }

        // Para contar a quantidade de dias do mês pesquisado ou atual (caso não haja valor no input) 
        list($month, $year) = explode('/', $monthYear);
        $month = (int) $month;
        $year = (int) $year;
        $numberDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Cria uma lista de dias para o mês, formatando-os para ter 1 zero a esquerda em números não decimais 
        $days = [];
        for ($i = 1; $i <= $numberDaysInMonth; $i++) {
            $days[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        // Definir os feriados 
        $holidays = [
            '01-01', // Ano Novo 
            '03-03', // Carnaval
            '03-04', // Carnaval
            '03-05', // Quarta-feira de cinzas
            '03-19', // Dia de São José
            '03-25', // Abolição da escravidão no Ceará
            '04-21', // Tiradentes
            '05-01', // Dia do Trabalho
            '06-19', // Corpus Christ
            '08-06', // Aniversário de Russas
            '08-15', // Dia de Nossa Senhora da Assunção
            '09-07', // Independência do Brasil
            '10-07', // Dia da Padroeira Nossa Senhora do Rosário
            '10-12', // Nossa Senhora Aparecida
            '11-02', // Finados
            '11-15', // Proclamação da República
            '11-20', // Dia Nacional de Zumbi e da Consciência Negra
            '11-27', // Aniversário da passagem da imagem de Nossa Senhora de Fátima no município
            '12-24', // Véspera Natal 
            '12-25', // Natal
            '12-31', // Véspera Ano novo
        ];
        $formattedHolidays = array_map(function ($holiday) use ($year) {
            return "{$year}-{$holiday}";
        }, $holidays);

        $weekends = [];
        for ($i = 1; $i <= $numberDaysInMonth; $i++) {
            $date = sprintf("%04d-%02d-%02d", $year, $month, $i);
            $dayOfWeek = date('N', strtotime($date));
            if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                $weekends[] = $date;
            }
        }
        $daysNotRequired = []; // P/ armazenar os dias normais, mas que não são os alvos
        foreach ($frequencies as $frequency) 
        {
            // Fazer os dias não clicáveis
            $daysNotRequired = $this->getDaysNotRequired($frequency->class_apae, $year, $month, $numberDaysInMonth);
            $frequency->nonClickableDays = array_merge($formattedHolidays, $weekends, $daysNotRequired);
            $frequency->weekends = array_merge($weekends);

            // Contar as Faltas
            $countAbsences = 0;
            for ($day = 1; $day <= $numberDaysInMonth; $day++) {
                $date = sprintf("%04d-%02d-%02d", $year, $month, $day);
                if (!in_array($date, $frequency->nonClickableDays) && $frequency->$day === false) {
                    $countAbsences++;
                }
            }
            $frequency->countAbsences = $countAbsences;
        }

        return view('frequencyF.home', compact('frequencies', 'professors', 'turn_apae', 'professor_id', 'monthYear', 'days', 'numberDaysInMonth', 'observation', 'signature_id', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('errors.404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Frequency $frequency)
    {
        return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Frequency $frequency)
    {
        return view('errors.404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'frequencyId' => 'required',
            'day' => 'required',
            'status' => 'nullable|boolean',
        ]);

        // Encontrar o aluno
        $frequency = Frequency::find($id);

        if (!$frequency) {
            return response()->json(['success' => false, 'message' => 'Aluno da frequência não encontrado.']);
        }

        $frequency->{$request->day} = $request->status;
        $frequency->save();
        
        broadcast(new CrudUpdated('updated',  'frequency'))->toOthers();
        return response()->json([
            'success' => true
        ]);
    }

    public function updateDetails(Request $request)
    {
        // Decodifique o JSON recebido
        $frequencies = json_decode($request->input('frequencies'), true);
        $observation = $request->input('observation');
        $signature_id = $request->input('signature_id');
        $class_apae = null;
        $turn_apae = null;
        $monthYear = null;

        DB::transaction(function () use ($frequencies, $observation, $signature_id, &$class_apae, &$turn_apae, &$monthYear) {
            foreach ($frequencies['data'] as $frequencyData) {
                $frequency = Frequency::find($frequencyData['id']);
                if ($frequency) {
                    if ($observation == '') {
                        $observation = '-------- Sem Observações --------';
                    }
                    $updated = $frequency->update([
                        'observation' => $observation, // Atualize conforme necessário
                        'signature_id' => $signature_id, // Assinatura comum para todos
                    ]);
                    if (!$updated) {
                        throw new \Exception("Falha ao atualizar a frequência com ID {$frequencyData['id']}");
                    }
                } else {
                    throw new \Exception("Frequência com ID {$frequencyData['id']} não encontrada");
                }
                $class_apae = $frequency->student->class_apae;
                $turn_apae = $frequency->student->turn_apae;
                $monthYear = $frequency->month_year;
            }
        });
        // Se a transação for bem-sucedida, retornamos com uma mensagem de sucesso
        broadcast(new CrudUpdated('updated',  'frequency'))->toOthers();
        session()->flash('success', 'Observações atualizadas com sucesso!');
        return redirect()->route('frequency.index', compact('class_apae', 'turn_apae', 'monthYear'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frequency $frequency)
    {
        //
    }
    public function getDaysNotRequired($classType, $year, $month, $numberDaysInMonth) {
        $daysNotRequired = [];
        
        for ($i = 0; $i < $numberDaysInMonth; $i++) {
            $date = sprintf("%04d-%02d-%02d", $year, $month, $i + 1); // Corrigido para o dia 1 até 31
            $dayOfWeek = date('N', strtotime($date)); // Obtém o dia da semana como número (1 = Segunda, 7 = Domingo)
    
            // Lógica para diferentes combinações de dias da semana
            switch ($classType) {
                case 'Segunda':
                    if ($dayOfWeek != 1) $daysNotRequired[] = $date;
                    break;
                case 'Terça':
                    if ($dayOfWeek != 2) $daysNotRequired[] = $date;
                    break;
                case 'Quarta':
                    if ($dayOfWeek != 3) $daysNotRequired[] = $date;
                    break;
                case 'Quinta':
                    if ($dayOfWeek != 4) $daysNotRequired[] = $date;
                    break;
                case 'Sexta':
                    if ($dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Terça':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2) $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Quarta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 3) $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Quinta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 4) $daysNotRequired[] = $date;
                    break;
                case 'Segunda e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Terça e Quarta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 3) $daysNotRequired[] = $date;
                    break;
                case 'Terça e Quinta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 4) $daysNotRequired[] = $date;
                    break;
                case 'Terça e Sexta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Quarta e Quinta':
                    if ($dayOfWeek != 3 && $dayOfWeek != 4) $daysNotRequired[] = $date;
                    break;
                case 'Quarta e Sexta':
                    if ($dayOfWeek != 3 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Quinta e Sexta':
                    if ($dayOfWeek != 4 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Terça e Quarta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2 && $dayOfWeek != 3) $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Terça e Quinta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2 && $dayOfWeek != 4) $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Terça e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 2 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Quarta e Quinta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 3 && $dayOfWeek != 4) $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Quarta e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 3 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Segunda, Quinta e Sexta':
                    if ($dayOfWeek != 1 && $dayOfWeek != 4 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Terça, Quarta e Quinta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 3 && $dayOfWeek != 4) $daysNotRequired[] = $date;
                    break;
                case 'Terça, Quarta e Sexta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 3 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Terça, Quinta e Sexta':
                    if ($dayOfWeek != 2 && $dayOfWeek != 4 && $dayOfWeek != 5) $daysNotRequired[] = $date;
                    break;
                case 'Quarta, Quinta e Sexta':
                    if ($dayOfWeek != 3 && $dayOfWeek != 4 && $dayOfWeek != 5) $daysNotRequired[] = $date;
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
