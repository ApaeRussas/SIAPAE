<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">

            <div>

                <h2 class="text-2xl font-semibold leading-tight text-[#243129] dark:text-[#F1F5F0] md:text-3xl">
                    Ficha mensal
                </h2>

                <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                    Acompanhamento de {{ $student->name }}
                </p>

            </div>

            <a
                href="{{ route('monthlyStudentRecord.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-[#D7DED8] bg-[#FFFDF9] px-5 py-3 text-sm font-semibold text-[#2F6B4F] transition hover:bg-[#E7F0E9] dark:border-[#2A382F] dark:bg-[#151D18] dark:text-[#A9C9B2] dark:hover:bg-[#1B3025]"
            >
                Voltar
            </a>

        </div>

    </x-slot>

    <div class="bg-[#F8F7F2] py-8 dark:bg-[#101713]">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-6 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">

                    <div>

                        <p class="text-sm font-medium text-[#6E7A72] dark:text-[#A9B5AC]">
                            Estudante
                        </p>

                        <h1 class="mt-1 text-2xl font-semibold text-[#243129] dark:text-[#F1F5F0]">
                            {{ $student->name }}
                        </h1>

                    </div>

                    <div class="text-sm text-[#6E7A72] dark:text-[#A9B5AC]">

                        Período analisado:

                        <strong class="text-[#243129] dark:text-[#F1F5F0]">

                            @if ($month)
                                {{ $monthNames[(int) $month] }} de {{ $year }}
                            @else
                                Todo o ano de {{ $year }}
                            @endif

                        </strong>

                    </div>

                </div>

            </div>

            <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-6 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                <form
                    method="GET"
                    action="{{ route('monthlyStudentRecord.show', ['student' => $student->id]) }}"
                    class="grid grid-cols-1 gap-4 md:grid-cols-4"
                >

                    <div>

                        <label
                            for="professor_id"
                            class="mb-2 block text-sm font-medium text-[#243129] dark:text-[#F1F5F0]"
                        >
                            Professor
                        </label>

                        <select
                            id="professor_id"
                            name="professor_id"
                            class="w-full rounded-xl border border-[#D7DED8] bg-white px-4 py-3 text-sm text-[#243129] outline-none focus:border-[#2F6B4F] focus:ring-2 focus:ring-[#2F6B4F]/20 dark:border-[#365342] dark:bg-[#1A241E] dark:text-[#F1F5F0] dark:focus:border-[#7EAF91] dark:focus:ring-[#7EAF91]/20"
                        >

                            <option value="" class="bg-white dark:bg-[#1A241E]">
                                Todos os professores
                            </option>

                            @foreach ($professors as $professor)

                                <option
                                    value="{{ $professor->id }}"
                                    @selected($professorId == $professor->id)
                                    class="bg-white dark:bg-[#1A241E]"
                                >
                                    {{ $professor->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label
                            for="year"
                            class="mb-2 block text-sm font-medium text-[#243129] dark:text-[#F1F5F0]"
                        >
                            Ano
                        </label>

                        <select
                            id="year"
                            name="year"
                            class="w-full rounded-xl border border-[#D7DED8] bg-white px-4 py-3 text-sm text-[#243129] outline-none focus:border-[#2F6B4F] focus:ring-2 focus:ring-[#2F6B4F]/20 dark:border-[#365342] dark:bg-[#1A241E] dark:text-[#F1F5F0] dark:focus:border-[#7EAF91] dark:focus:ring-[#7EAF91]/20"
                        >

                            @foreach ($years as $availableYear)

                                <option
                                    value="{{ $availableYear }}"
                                    @selected($year == $availableYear)
                                    class="bg-white dark:bg-[#1A241E]"
                                >
                                    {{ $availableYear }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label
                            for="month"
                            class="mb-2 block text-sm font-medium text-[#243129] dark:text-[#F1F5F0]"
                        >
                            Mês
                        </label>

                        <select
                            id="month"
                            name="month"
                            class="w-full rounded-xl border border-[#D7DED8] bg-white px-4 py-3 text-sm text-[#243129] outline-none focus:border-[#2F6B4F] focus:ring-2 focus:ring-[#2F6B4F]/20 dark:border-[#365342] dark:bg-[#1A241E] dark:text-[#F1F5F0] dark:focus:border-[#7EAF91] dark:focus:ring-[#7EAF91]/20"
                        >

                            <option value="" class="bg-white dark:bg-[#1A241E]">
                                Todos os meses
                            </option>

                            @foreach ($monthNames as $monthNumber => $monthName)

                                <option
                                    value="{{ $monthNumber }}"
                                    @selected((int) $month === $monthNumber)
                                    class="bg-white dark:bg-[#1A241E]"
                                >
                                    {{ $monthName }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="flex items-end">

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-[#2F6B4F] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#23543E] dark:bg-[#7EAF91] dark:text-[#101713] dark:hover:bg-[#A9C9B2]"
                        >
                            Filtrar
                        </button>

                    </div>

                </form>

            </div>

            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">

                <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-5 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                    <p class="text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Presenças
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-[#2F6B4F] dark:text-[#A9C9B2]">
                        {{ $presenceCount }}
                    </p>

                    <p class="mt-1 text-xs text-[#6E7A72] dark:text-[#A9B5AC]">
                        {{ $presencePercentage }}% do período
                    </p>

                </div>

                <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-5 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                    <p class="text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Faltas
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-[#243129] dark:text-[#F1F5F0]">
                        {{ $absenceCount }}
                    </p>

                    <p class="mt-1 text-xs text-[#6E7A72] dark:text-[#A9B5AC]">
                        {{ $absencePercentage }}% do período
                    </p>

                </div>

                <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-5 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                    <p class="text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Atividades realizadas
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-[#2F6B4F] dark:text-[#A9C9B2]">
                        {{ $activitiesPerformed }}
                    </p>

                </div>

                <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-5 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                    <p class="text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Participação
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-[#243129] dark:text-[#F1F5F0]">
                        {{ $participationPercentage }}%
                    </p>

                    <p class="mt-1 text-xs text-[#6E7A72] dark:text-[#A9B5AC]">
                        Nas atividades registradas
                    </p>

                </div>

            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-6 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                    <div class="mb-5">

                        <h3 class="text-lg font-semibold text-[#243129] dark:text-[#F1F5F0]">
                            Presenças e faltas
                        </h3>

                        <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">

                            @if ($month)
                                Frequência registrada em {{ $monthNames[(int) $month] }}.
                            @else
                                Frequência registrada durante o ano.
                            @endif

                        </p>

                    </div>

                    <div class="h-72">
                        <canvas id="frequencyChart"></canvas>
                    </div>

                </div>

                <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-6 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                    <div class="mb-5">

                        <h3 class="text-lg font-semibold text-[#243129] dark:text-[#F1F5F0]">
                            Participação nas atividades
                        </h3>

                        <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">

                            @if ($month)
                                Percentual de atividades realizadas em {{ $monthNames[(int) $month] }}.
                            @else
                                Percentual de atividades realizadas por mês.
                            @endif

                        </p>

                    </div>

                    <div class="h-72">
                        <canvas id="participationChart"></canvas>
                    </div>

                </div>

            </div>

            <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-6 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                <div class="mb-6">

                    <h3 class="text-lg font-semibold text-[#243129] dark:text-[#F1F5F0]">
                        Situação das atividades
                    </h3>

                    <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Registros de participação nas atividades.
                    </p>

                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div class="rounded-2xl bg-[#E7F0E9] p-5 dark:bg-[#1B3025]">

                        <p class="text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                            Atividades realizadas
                        </p>

                        <p class="mt-2 text-3xl font-semibold text-[#2F6B4F] dark:text-[#A9C9B2]">
                            {{ $activitiesPerformed }}
                        </p>

                    </div>

                    <div class="rounded-2xl bg-[#F1F2F0] p-5 dark:bg-[#1A241E]">

                        <p class="text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                            Atividades não realizadas
                        </p>

                        <p class="mt-2 text-3xl font-semibold text-[#243129] dark:text-[#F1F5F0]">
                            {{ $activitiesNotPerformed }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                <div class="border-b border-[#E4E8E2] p-6 dark:border-[#2A382F]">

                    <h3 class="text-lg font-semibold text-[#243129] dark:text-[#F1F5F0]">
                        Histórico mensal
                    </h3>

                    <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Frequência e participação no período selecionado.
                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-[#E7F0E9] dark:bg-[#1B3025]">

                            <tr>

                                <th class="px-6 py-4 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                    Mês
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                    Presenças
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                    Faltas
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                    Participação
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-[#E4E8E2] dark:divide-[#2A382F]">

                            @for ($i = 0; $i < count($monthlyLabels); $i++)

                                @if ($monthlyPresences[$i] > 0 || $monthlyAbsences[$i] > 0 || $monthlyParticipation[$i] > 0)

                                    <tr class="transition hover:bg-[#F8F7F2] dark:hover:bg-[#1B3025]/60">

                                        <td class="px-6 py-4 text-sm font-medium text-[#243129] dark:text-[#F1F5F0]">
                                            {{ $monthlyLabels[$i] }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                                            {{ $monthlyPresences[$i] }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                                            {{ $monthlyAbsences[$i] }}
                                        </td>

                                        <td class="px-6 py-4 text-sm font-medium text-[#2F6B4F] dark:text-[#A9C9B2]">
                                            {{ $monthlyParticipation[$i] }}%
                                        </td>

                                    </tr>

                                @endif

                            @endfor

                        </tbody>

                    </table>

                </div>

            </div>

            <div>

                <div class="mb-5">

                    <h3 class="text-xl font-semibold text-[#243129] dark:text-[#F1F5F0]">
                        Histórico de atendimentos
                    </h3>

                    <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Registros realizados pelos professores no período selecionado.
                    </p>

                </div>

                <div class="space-y-6">

                    @forelse ($months as $monthKey => $monthAttendances)

                        @php
                            $monthDate = \Carbon\Carbon::createFromFormat('Y-m', $monthKey);
                            $monthNumber = (int) $monthDate->format('n');
                        @endphp

                        <div class="overflow-hidden rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                            <div class="border-b border-[#E4E8E2] bg-[#E7F0E9] px-6 py-5 dark:border-[#2A382F] dark:bg-[#1B3025]">

                                <h4 class="text-xl font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                    {{ $monthNames[$monthNumber] }}
                                </h4>

                                <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                                    {{ $year }}
                                </p>

                            </div>

                            <div class="space-y-5 p-6">

                                @foreach ($monthAttendances->groupBy('signature_id') as $professorAttendances)

                                    @php
                                        $professor = $professorAttendances->first()->professor;
                                    @endphp

                                    <div class="rounded-2xl border border-[#E4E8E2] bg-white p-5 dark:border-[#2A382F] dark:bg-[#1A241E]">

                                        <div class="mb-5">

                                            <p class="text-xs font-medium uppercase tracking-wide text-[#6E7A72] dark:text-[#A9B5AC]">
                                                Professor
                                            </p>

                                            <h5 class="mt-1 font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                                {{ $professor?->name ?? 'Professor não informado' }}
                                            </h5>

                                        </div>

                                        <div class="space-y-4">

                                            @foreach ($professorAttendances as $attendance)

                                                <div class="rounded-2xl border border-[#E4E8E2] bg-[#FFFDF9] p-5 dark:border-[#2A382F] dark:bg-[#151D18]">

                                                    <div class="mb-5 flex flex-wrap items-center gap-3">

                                                        <span class="rounded-lg bg-[#E7F0E9] px-3 py-1.5 text-sm font-semibold text-[#2F6B4F] dark:bg-[#1B3025] dark:text-[#A9C9B2]">
                                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}
                                                        </span>

                                                        @if ($attendance->educational_axis)

                                                            <span class="rounded-lg bg-[#F1F2F0] px-3 py-1.5 text-sm text-[#5E6962] dark:bg-[#1A241E] dark:text-[#A9B5AC]">
                                                                {{ $attendance->educational_axis }}
                                                            </span>

                                                        @endif

                                                    </div>

                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                                                        @if ($attendance->skills)

                                                            <div class="rounded-xl bg-[#F8F7F2] p-4 dark:bg-[#1A241E]">

                                                                <h6 class="mb-2 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                                                    Habilidades
                                                                </h6>

                                                                <p class="text-sm leading-6 text-[#6E7A72] dark:text-[#A9B5AC]">
                                                                    {{ $attendance->skills }}
                                                                </p>

                                                            </div>

                                                        @endif

                                                        @if ($attendance->skills_evolution)

                                                            <div class="rounded-xl bg-[#F8F7F2] p-4 dark:bg-[#1A241E]">

                                                                <h6 class="mb-2 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                                                    Evolução das habilidades
                                                                </h6>

                                                                <p class="text-sm leading-6 text-[#6E7A72] dark:text-[#A9B5AC]">
                                                                    {{ $attendance->skills_evolution }}
                                                                </p>

                                                            </div>

                                                        @endif

                                                        @if ($attendance->activity_description)

                                                            <div class="rounded-xl bg-[#F8F7F2] p-4 dark:bg-[#1A241E]">

                                                                <h6 class="mb-2 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                                                    Atividade realizada
                                                                </h6>

                                                                <p class="text-sm leading-6 text-[#6E7A72] dark:text-[#A9B5AC]">
                                                                    {{ $attendance->activity_description }}
                                                                </p>

                                                            </div>

                                                        @endif

                                                        @if ($attendance->advances)

                                                            <div class="rounded-xl bg-[#F8F7F2] p-4 dark:bg-[#1A241E]">

                                                                <h6 class="mb-2 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                                                    Avanços
                                                                </h6>

                                                                <p class="text-sm leading-6 text-[#6E7A72] dark:text-[#A9B5AC]">
                                                                    {{ $attendance->advances }}
                                                                </p>

                                                            </div>

                                                        @endif

                                                        @if ($attendance->difficulties)

                                                            <div class="rounded-xl bg-[#F8F7F2] p-4 dark:bg-[#1A241E]">

                                                                <h6 class="mb-2 text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                                                    Dificuldades
                                                                </h6>

                                                                <p class="text-sm leading-6 text-[#6E7A72] dark:text-[#A9B5AC]">
                                                                    {{ $attendance->difficulties }}
                                                                </p>

                                                            </div>

                                                        @endif

                                                    </div>

                                                    @if ($attendance->activity_not_performed)

                                                        <div class="mt-4 rounded-xl bg-[#F1F2F0] p-4 dark:bg-[#1A241E]">

                                                            <p class="text-sm font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                                                Atividade não realizada
                                                            </p>

                                                        </div>

                                                    @endif

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @empty

                        <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] px-6 py-12 text-center shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                            <h3 class="text-lg font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                Nenhum atendimento encontrado
                            </h3>

                            <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                                Não existem atendimentos para este estudante no período selecionado.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const labels = @json($monthlyLabels);
            const presences = @json($monthlyPresences);
            const absences = @json($monthlyAbsences);
            const participation = @json($monthlyParticipation);

            const frequencyCanvas = document.getElementById('frequencyChart');

            if (frequencyCanvas) {

                new Chart(frequencyCanvas, {
                    type: 'bar',

                    data: {
                        labels: labels,

                        datasets: [
                            {
                                label: 'Presenças',
                                data: presences,
                                backgroundColor: '#2F6B4F',
                                borderRadius: 7
                            },
                            {
                                label: 'Faltas',
                                data: absences,
                                backgroundColor: '#5F6D65',
                                borderRadius: 7
                            }
                        ]
                    },

                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#A9B5AC'
                                }
                            }
                        },

                        scales: {
                            x: {
                                ticks: {
                                    color: '#A9B5AC'
                                },
                                grid: {
                                    color: 'rgba(169, 181, 172, 0.08)'
                                }
                            },

                            y: {
                                beginAtZero: true,

                                ticks: {
                                    precision: 0,
                                    color: '#A9B5AC'
                                },

                                grid: {
                                    color: 'rgba(169, 181, 172, 0.08)'
                                }
                            }
                        }
                    }
                });

            }

            const participationCanvas = document.getElementById('participationChart');

            if (participationCanvas) {

                new Chart(participationCanvas, {
                    type: 'line',

                    data: {
                        labels: labels,

                        datasets: [
                            {
                                label: 'Participação',
                                data: participation,
                                borderColor: '#7EAF91',
                                backgroundColor: 'rgba(126, 175, 145, 0.10)',
                                tension: 0.35,
                                fill: true,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointBackgroundColor: '#7EAF91',
                                pointBorderColor: '#151D18'
                            }
                        ]
                    },

                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#A9B5AC'
                                }
                            }
                        },

                        scales: {
                            x: {
                                ticks: {
                                    color: '#A9B5AC'
                                },
                                grid: {
                                    color: 'rgba(169, 181, 172, 0.08)'
                                }
                            },

                            y: {
                                beginAtZero: true,
                                max: 100,

                                ticks: {
                                    color: '#A9B5AC',

                                    callback: function (value) {
                                        return value + '%';
                                    }
                                },

                                grid: {
                                    color: 'rgba(169, 181, 172, 0.08)'
                                }
                            }
                        }
                    }
                });

            }

        });

    </script>

</x-app-layout>