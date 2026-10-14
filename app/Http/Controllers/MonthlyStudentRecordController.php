<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonthlyStudentRecordController extends Controller
{
    private array $monthNames = [
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

    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::query()
            ->with([
                'attendances' => function ($query) {
                    $query->with('professor')->orderByDesc('date');
                },
            ])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->get();

        return view('monthlyStudentRecord.home', compact(
            'students',
            'search'
        ));
    }

    public function show(Request $request, Student $student)
    {
        $year = (int) $request->input('year', now()->year);
        $monthInput = $request->input('month');
        $month = is_numeric($monthInput)
            && (int) $monthInput >= 1
            && (int) $monthInput <= 12
                ? (int) $monthInput
                : null;

        $professorInput = $request->input('professor_id');
        $professorId = is_numeric($professorInput)
            ? (int) $professorInput
            : null;

        /*
         * Atendimentos registrados no período.
         * São usados somente campos existentes na tabela de produção.
         */
        $attendances = $student->attendances()
            ->with('professor')
            ->whereYear('date', $year)
            ->when($month, function ($query) use ($month) {
                $query->whereMonth('date', $month);
            })
            ->when($professorId, function ($query) use ($professorId) {
                $query->where('signature_id', $professorId);
            })
            ->orderBy('date')
            ->get();

        /*
         * Frequências no período.
         * month_year utiliza o formato MM/YYYY.
         */
        $frequencyRecords = $student->frequencies()
            ->where('month_year', 'like', '%/' . $year)
            ->when($month, function ($query) use ($month, $year) {
                $query->where('month_year', sprintf('%02d/%04d', $month, $year));
            })
            ->when($professorId, function ($query) use ($professorId) {
                $query->where('signature_id', $professorId);
            })
            ->get();

        /*
         * Lista de professores que aparecem nos registros filtrados.
         */
        $professorIds = $attendances->pluck('signature_id')
            ->merge($frequencyRecords->pluck('signature_id'))
            ->filter()
            ->unique()
            ->values();

        $professors = User::query()
            ->whereIn('id', $professorIds)
            ->orderBy('name')
            ->get();

        /*
         * Anos disponíveis para o filtro.
         */
        $attendanceYears = $student->attendances()
            ->whereNotNull('date')
            ->selectRaw('YEAR(date) as year')
            ->distinct()
            ->pluck('year');

        $frequencyYears = $student->frequencies()
            ->whereNotNull('month_year')
            ->pluck('month_year')
            ->map(function ($monthYear) {
                $parts = explode('/', $monthYear);

                return isset($parts[1]) && is_numeric($parts[1])
                    ? (int) $parts[1]
                    : null;
            })
            ->filter()
            ->unique();

        $years = $attendanceYears
            ->merge($frequencyYears)
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        if ($years->isEmpty()) {
            $years = collect([now()->year]);
        }

        /*
         * Indicadores de frequência.
         * A leitura do valor original diferencia:
         * 1 = presente, 0 = falta, null = sem registro.
         */
        $presenceCount = 0;
        $absenceCount = 0;

        foreach ($frequencyRecords as $frequency) {
            $daysInMonth = $this->daysInFrequencyMonth($frequency);

            if (!$daysInMonth) {
                continue;
            }

            $yearMonth = explode('/', $frequency->month_year);
            $frequencyMonth = (int) $yearMonth[0];
            $frequencyYear = (int) $yearMonth[1];

            $nonRequiredDays = $this->getNonRequiredDates(
                $frequency->class_apae,
                $frequencyYear,
                $frequencyMonth,
                $daysInMonth
            );

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = sprintf(
                    '%04d-%02d-%02d',
                    $frequencyYear,
                    $frequencyMonth,
                    $day
                );

                if (in_array($date, $nonRequiredDays, true)) {
                    continue;
                }

                $rawValue = $frequency->getRawOriginal((string) $day);

                if ($rawValue === null) {
                    continue;
                }

                if ($rawValue === true || $rawValue === 1 || $rawValue === '1') {
                    $presenceCount++;
                } elseif ($rawValue === false || $rawValue === 0 || $rawValue === '0') {
                    $absenceCount++;
                }
            }
        }

        $totalFrequencyDays = $presenceCount + $absenceCount;

        $presencePercentage = $totalFrequencyDays > 0
            ? round(($presenceCount / $totalFrequencyDays) * 100, 1)
            : 0;

        $absencePercentage = $totalFrequencyDays > 0
            ? round(($absenceCount / $totalFrequencyDays) * 100, 1)
            : 0;

        /*
         * A tabela de produção não possui activity_not_performed.
         * Portanto, não é possível classificar atividades como realizadas
         * ou não realizadas nem calcular uma porcentagem de participação.
         */
        $activitiesPerformed = null;
        $activitiesNotPerformed = null;
        $participationPercentage = null;

        /*
         * Histórico de atendimentos agrupado por mês.
         */
        $months = $attendances->groupBy(function ($attendance) {
            return Carbon::parse($attendance->date)->format('Y-m');
        })->sortKeysDesc();

        /*
         * Dados mensais para os gráficos.
         */
        $monthlyLabels = [];
        $monthlyPresences = [];
        $monthlyAbsences = [];
        $monthlyParticipation = [];

        $monthsToShow = $month
            ? [$month]
            : range(1, 12);

        foreach ($monthsToShow as $monthNumber) {
            $monthFrequencyRecords = $frequencyRecords->filter(
                function ($frequency) use ($monthNumber) {
                    return (int) explode('/', $frequency->month_year)[0]
                        === $monthNumber;
                }
            );

            $monthPresence = 0;
            $monthAbsence = 0;

            foreach ($monthFrequencyRecords as $frequency) {
                $daysInMonth = $this->daysInFrequencyMonth($frequency);

                if (!$daysInMonth) {
                    continue;
                }

                [$frequencyMonth, $frequencyYear] = array_map(
                    'intval',
                    explode('/', $frequency->month_year)
                );

                $nonRequiredDays = $this->getNonRequiredDates(
                    $frequency->class_apae,
                    $frequencyYear,
                    $frequencyMonth,
                    $daysInMonth
                );

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $date = sprintf(
                        '%04d-%02d-%02d',
                        $frequencyYear,
                        $frequencyMonth,
                        $day
                    );

                    if (in_array($date, $nonRequiredDays, true)) {
                        continue;
                    }

                    $rawValue = $frequency->getRawOriginal((string) $day);

                    if ($rawValue === null) {
                        continue;
                    }

                    if ($rawValue === true || $rawValue === 1 || $rawValue === '1') {
                        $monthPresence++;
                    } elseif ($rawValue === false || $rawValue === 0 || $rawValue === '0') {
                        $monthAbsence++;
                    }
                }
            }

            $monthlyLabels[] = $this->monthNames[$monthNumber];
            $monthlyPresences[] = $monthPresence;
            $monthlyAbsences[] = $monthAbsence;

            // Não há dados suficientes na tabela atual para calcular participação.
            $monthlyParticipation[] = null;
        }

        $monthNames = $this->monthNames;

        return view('monthlyStudentRecord.show', compact(
            'student',
            'attendances',
            'months',
            'professors',
            'years',
            'year',
            'month',
            'professorId',
            'presenceCount',
            'absenceCount',
            'presencePercentage',
            'absencePercentage',
            'activitiesPerformed',
            'activitiesNotPerformed',
            'participationPercentage',
            'monthlyLabels',
            'monthlyPresences',
            'monthlyAbsences',
            'monthlyParticipation',
            'monthNames'
        ));
    }

    /**
     * Retorna a quantidade de dias do mês da frequência.
     */
    private function daysInFrequencyMonth($frequency): int
    {
        if (empty($frequency->month_year)) {
            return 0;
        }

        $parts = explode('/', $frequency->month_year);

        if (
            count($parts) !== 2
            || !is_numeric($parts[0])
            || !is_numeric($parts[1])
        ) {
            return 0;
        }

        $month = (int) $parts[0];
        $year = (int) $parts[1];

        if ($month < 1 || $month > 12 || $year < 1) {
            return 0;
        }

        return Carbon::create($year, $month, 1)->daysInMonth;
    }

    /**
     * Calcula datas que não devem contar como dias letivos,
     * seguindo as regras de calendário do FrequencyController.
     */
    private function getNonRequiredDates(
        ?string $classType,
        int $year,
        int $month,
        int $numberDaysInMonth
    ): array {
        $holidays = [
            '01-01',
            '03-03',
            '03-04',
            '03-05',
            '03-19',
            '03-25',
            '04-21',
            '05-01',
            '06-19',
            '08-06',
            '08-15',
            '09-07',
            '10-07',
            '10-12',
            '11-02',
            '11-15',
            '11-20',
            '11-27',
            '12-24',
            '12-25',
            '12-31',
        ];

        $nonRequired = [];

        for ($day = 1; $day <= $numberDaysInMonth; $day++) {
            $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
            $dateObject = Carbon::create($year, $month, $day);

            $weekday = (int) $dateObject->format('N');
            $holidayKey = $dateObject->format('m-d');

            // Finais de semana e feriados não entram no cálculo.
            if ($weekday >= 6 || in_array($holidayKey, $holidays, true)) {
                $nonRequired[] = $date;
                continue;
            }

            $allowedDays = $this->allowedWeekdays($classType);

            // Reproduz o comportamento do método atual para turmas desconhecidas.
            if ($allowedDays === null || !in_array($weekday, $allowedDays, true)) {
                $nonRequired[] = $date;
            }
        }

        return $nonRequired;
    }

    /**
     * Dias da semana previstos para cada tipo de turma.
     * 1 = segunda-feira; 5 = sexta-feira.
     */
    private function allowedWeekdays(?string $classType): ?array
    {
        $schedules = [
            'Segunda' => [1],
            'Terça' => [2],
            'Quarta' => [3],
            'Quinta' => [4],
            'Sexta' => [5],

            'Segunda e Terça' => [1, 2],
            'Segunda e Quarta' => [1, 3],
            'Segunda e Quinta' => [1, 4],
            'Segunda e Sexta' => [1, 5],
            'Terça e Quarta' => [2, 3],
            'Terça e Quinta' => [2, 4],
            'Terça e Sexta' => [2, 5],
            'Quarta e Quinta' => [3, 4],
            'Quarta e Sexta' => [3, 5],
            'Quinta e Sexta' => [4, 5],

            'Segunda, Terça e Quarta' => [1, 2, 3],
            'Segunda, Terça e Quinta' => [1, 2, 4],
            'Segunda, Terça e Sexta' => [1, 2, 5],
            'Segunda, Quarta e Quinta' => [1, 3, 4],
            'Segunda, Quarta e Sexta' => [1, 3, 5],
            'Segunda, Quinta e Sexta' => [1, 4, 5],
            'Terça, Quarta e Quinta' => [2, 3, 4],
            'Terça, Quarta e Sexta' => [2, 3, 5],
            'Terça, Quinta e Sexta' => [2, 4, 5],
            'Quarta, Quinta e Sexta' => [3, 4, 5],
        ];

        return $schedules[$classType] ?? null;
    }
}
