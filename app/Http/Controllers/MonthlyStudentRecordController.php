<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonthlyStudentRecordController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::query()
            ->with([
                'attendances' => function ($query) {
                    $query
                        ->with('professor')
                        ->orderByDesc('date');
                }
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
        $month = $request->input('month');
        $professorId = $request->input('professor_id');

        $attendancesQuery = $student->attendances()
            ->with('professor')
            ->whereYear('date', $year)
            ->when($month, function ($query) use ($month) {
                $query->whereMonth('date', $month);
            })
            ->when($professorId, function ($query) use ($professorId) {
                $query->where('signature_id', $professorId);
            })
            ->orderBy('date');

        $attendances = $attendancesQuery->get();

        $frequencyQuery = $student->frequencies()
            ->where(function ($query) use ($year) {
                $query->where('month_year', 'like', '%/' . $year);
            })
            ->when($month, function ($query) use ($month, $year) {
                $query->where('month_year', $month . '/' . $year);
            })
            ->when($professorId, function ($query) use ($professorId) {
                $query->where('signature_id', $professorId);
            });

        $frequencyRecords = $frequencyQuery->get();

        $professorIdsFromAttendance = $student->attendances()
            ->whereYear('date', $year)
            ->when($month, function ($query) use ($month) {
                $query->whereMonth('date', $month);
            })
            ->whereNotNull('signature_id')
            ->pluck('signature_id');

        $professorIdsFromFrequency = $student->frequencies()
            ->where('month_year', 'like', '%/' . $year)
            ->when($month, function ($query) use ($month, $year) {
                $query->where('month_year', $month . '/' . $year);
            })
            ->whereNotNull('signature_id')
            ->pluck('signature_id');

        $professorIds = $professorIdsFromAttendance
            ->merge($professorIdsFromFrequency)
            ->unique()
            ->values();

        $professors = User::query()
            ->whereIn('id', $professorIds)
            ->orderBy('name')
            ->get();

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

                return isset($parts[1]) ? (int) $parts[1] : null;
            })
            ->filter()
            ->unique();

        $years = $attendanceYears
            ->merge($frequencyYears)
            ->unique()
            ->sortDesc()
            ->values();

        if ($years->isEmpty()) {
            $years = collect([now()->year]);
        }

        $presenceCount = 0;
        $absenceCount = 0;

        foreach ($frequencyRecords as $frequency) {
            foreach ([
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday'
            ] as $day) {
                if ($frequency->{$day} === true) {
                    $presenceCount++;
                } elseif ($frequency->{$day} === false) {
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

        $activitiesPerformed = $attendances
            ->filter(fn ($attendance) => !$attendance->activity_not_performed)
            ->count();

        $activitiesNotPerformed = $attendances
            ->filter(fn ($attendance) => $attendance->activity_not_performed)
            ->count();

        $totalActivities = $activitiesPerformed + $activitiesNotPerformed;

        $participationPercentage = $totalActivities > 0
            ? round(($activitiesPerformed / $totalActivities) * 100, 1)
            : 0;

        $months = $attendances->groupBy(function ($attendance) {
            return Carbon::parse($attendance->date)->format('Y-m');
        });

        $monthNames = [
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

        $monthlyLabels = [];
        $monthlyPresences = [];
        $monthlyAbsences = [];
        $monthlyParticipation = [];

        $monthsToShow = $month
            ? [(int) $month]
            : range(1, 12);

        foreach ($monthsToShow as $monthNumber) {
            $monthFrequency = $frequencyRecords->filter(function ($frequency) use ($monthNumber) {
                return (int) explode('/', $frequency->month_year)[0] === $monthNumber;
            });

            $monthPresence = 0;
            $monthAbsence = 0;

            foreach ($monthFrequency as $frequency) {
                foreach ([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday'
                ] as $day) {
                    if ($frequency->{$day} === true) {
                        $monthPresence++;
                    } elseif ($frequency->{$day} === false) {
                        $monthAbsence++;
                    }
                }
            }

            $monthAttendances = $attendances->filter(function ($attendance) use ($monthNumber) {
                return (int) Carbon::parse($attendance->date)->format('n') === $monthNumber;
            });

            $monthActivities = $monthAttendances->count();

            $monthPerformed = $monthAttendances
                ->filter(fn ($attendance) => !$attendance->activity_not_performed)
                ->count();

            $monthParticipation = $monthActivities > 0
                ? round(($monthPerformed / $monthActivities) * 100, 1)
                : 0;

            $monthlyLabels[] = $monthNames[$monthNumber];
            $monthlyPresences[] = $monthPresence;
            $monthlyAbsences[] = $monthAbsence;
            $monthlyParticipation[] = $monthParticipation;
        }

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
}