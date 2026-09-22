{{-- 
$title: string que define o título da tabela.

$headers: Um array que contém os cabeçalhos das colunas da tabela.

$rows: Dados do banco de dados.

$variablesDB: Nomes das colunas que existem no banco de dados.

$actionRoute: URL/rota utilizada pelos botões e ações.
--}}

<div class="py-6 attendance-calendar-component">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden rounded-2xl shadow-sm border border-[#E1E7EC] p-6">

            {{-- =========================================================
                 CALENDÁRIO
                 ========================================================= --}}

            <div>

                {{-- CONTROLE DA SEMANA --}}
                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-1 sm:gap-2 mb-4 flex-wrap">

                        {{-- Botão anterior --}}
                        <button
                            id="btnPrevious"
                            type="button"
                            class="p-2 hover:bg-[#EDF5F0] rounded-lg transition duration-200"
                            aria-label="Semana anterior"
                        >
                            <svg
                                class="w-4 h-4 text-[#334E68]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </button>


                        {{-- Faixa da semana --}}
                        <p
                            id="faixaSemana"
                            x-data="{ faixaSemana: localStorage.getItem('faixaSemana') || '{{ $faixaSemana }}' }"
                            x-init="if (!faixaSemana) { faixaSemana = '{{ $faixaSemana }}' }"
                            x-text="faixaSemana"
                            class="custom-p text-sm pl-3 pr-3 py-1.5 border border-[#D7DEE5] rounded-lg bg-white text-[#102A43]"
                        >
                        </p>


                        {{-- Botão próximo --}}
                        <button
                            id="btnNext"
                            type="button"
                            class="p-2 hover:bg-[#EDF5F0] rounded-lg transition duration-200"
                            aria-label="Próxima semana"
                        >
                            <svg
                                class="w-4 h-4 text-[#334E68]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </button>

                    </div>


                    {{-- ANO --}}
                    <div class="mb-4 px-3 py-1.5 bg-white border border-[#D7DEE5] rounded-lg">

                        <p
                            id="year"
                            x-data="{ year: localStorage.getItem('year') || '{{ $year }}' }"
                            x-init="if (!year) { year = '{{ $year }}' }"
                            x-text="year"
                            class="text-sm text-[#102A43]"
                        >
                        </p>

                    </div>

                </div>


                {{-- =====================================================
                     DIAS DA SEMANA
                     ===================================================== --}}

                @if(isset($students))

                    @php

                        $dias = [
                            'segunda' => [
                                'nome' => 'Segunda',
                                'campo' => 'monday'
                            ],
                            'terca' => [
                                'nome' => 'Terça',
                                'campo' => 'tuesday'
                            ],
                            'quarta' => [
                                'nome' => 'Quarta',
                                'campo' => 'wednesday'
                            ],
                            'quinta' => [
                                'nome' => 'Quinta',
                                'campo' => 'thursday'
                            ],
                            'sexta' => [
                                'nome' => 'Sexta',
                                'campo' => 'friday'
                            ]
                        ];

                    @endphp


                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-3">

                        @foreach($dias as $diaKey => $diaInfo)

                            <div class="bg-[#F8FAF9] rounded-xl border border-[#E1E7EC] overflow-hidden">

                                {{-- CABEÇALHO DO DIA --}}
                                <div class="p-3 border-b border-[#E1E7EC]">

                                    <span class="block text-sm font-semibold text-[#102A43]">
                                        {{ $diaInfo['nome'] }}
                                    </span>

                                    <span
                                        class="block text-xs text-[#66788A] mt-0.5"
                                        id="{{ $diaKey }}"
                                    >
                                        {{ $diasDaSemana[$diaKey] }}
                                    </span>

                                </div>


                                <div class="p-3">

                                    {{-- =================================================
                                         MANHÃ
                                         ================================================= --}}

                                    <details
                                        class="mb-4 group"
                                        open
                                    >

                                        <summary
                                            class="cursor-pointer text-sm font-semibold text-[#334E68] list-none flex items-center justify-between"
                                        >

                                            Manhã

                                            <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180 text-[#66788A]">
                                                &#9660;
                                            </span>

                                        </summary>


                                        <ul
                                            id="{{ $diaKey }}ManhaList"
                                            class="mt-2 space-y-1.5"
                                        >

                                            @php

                                                $hasMorningStudents = false;

                                                [$day, $month] =
                                                    explode('/', $diasDaSemana[$diaKey]);

                                                $day = ltrim($day, '0');

                                                $dateForAttendance =
                                                    $year . '-' .
                                                    str_pad($month, 2, '0', STR_PAD_LEFT) . '-' .
                                                    str_pad($day, 2, '0', STR_PAD_LEFT);

                                                $displayDate =
                                                    str_pad($day, 2, '0', STR_PAD_LEFT) .
                                                    '/' .
                                                    str_pad($month, 2, '0', STR_PAD_LEFT) .
                                                    '/' .
                                                    $year;

                                            @endphp


                                            @foreach($students as $student)

                                                @if(
                                                    $student->{$diaInfo['campo']} === true &&
                                                    $student->turn_apae === 'Manhã'
                                                )

                                                    @php

                                                        $hasMorningStudents = true;

                                                        $frequency = collect($frequencies)
                                                            ->where('student_id', $student->id)
                                                            ->where('month_year', $month . '/' . $year)
                                                            ->first();

                                                        $attendanceExists =
                                                            App\Models\Attendance::where(
                                                                'student_id',
                                                                $student->id
                                                            )
                                                            ->where(
                                                                'date',
                                                                $dateForAttendance
                                                            )
                                                            ->exists();

                                                        $frequencyValue =
                                                            $frequency
                                                                ? $frequency->{$day}
                                                                : null;

                                                    @endphp


                                                    @if($frequency)

                                                        @php

                                                            /*
                                                             * Quando já existe atendimento,
                                                             * abre a Lista de Atendimento
                                                             * filtrada somente para aquela data.
                                                             */
                                                            if ($attendanceExists) {

                                                                $attendanceLink = route(
                                                                    'attendance.list',
                                                                    [
                                                                        'date_range' => $displayDate . ' à ' . $displayDate
                                                                    ]
                                                                );

                                                            } elseif ($frequencyValue === true) {

                                                                $attendanceLink = '#';

                                                            } else {

                                                                $attendanceLink = route(
                                                                    'attendance.create',
                                                                    [
                                                                        'student_id' => $student->id,
                                                                        'date' => $diasDaSemana[$diaKey],
                                                                        'year' => $year
                                                                    ]
                                                                );

                                                            }

                                                        @endphp


                                                        <li
                                                            class="text-sm
                                                            {{
                                                                $frequencyValue === true
                                                                    ? 'text-[#3B7D5A]'
                                                                    : (
                                                                        $frequencyValue === false
                                                                            ? 'text-[#B42318]'
                                                                            : 'text-[#66788A]'
                                                                    )
                                                            }}"
                                                        >

                                                            <div class="flex items-center space-x-1.5">

                                                                <a
                                                                    href="{{ $attendanceLink }}"
                                                                    class="truncate
                                                                    {{
                                                                        $attendanceExists
                                                                            ? 'font-medium hover:underline'
                                                                            : ''
                                                                    }}"
                                                                >

                                                                    {{ $student->name }}

                                                                </a>


                                                                @if($attendanceExists)

                                                                    <span class="flex-shrink-0 text-[#3B7D5A]">
                                                                        ✓
                                                                    </span>

                                                                @elseif($frequencyValue === true)

                                                                    <span class="flex-shrink-0 text-[#B42318]">
                                                                        ✗
                                                                    </span>

                                                                @endif

                                                            </div>

                                                        </li>

                                                    @endif

                                                @endif

                                            @endforeach


                                            @if(!$hasMorningStudents)

                                                <li class="text-sm text-[#8091A5]">
                                                    Nenhum aluno para {{ strtolower($diaInfo['nome']) }} de manhã
                                                </li>

                                            @endif

                                        </ul>

                                    </details>


                                    {{-- =================================================
                                         TARDE
                                         ================================================= --}}

                                    <details
                                        class="group"
                                        open
                                    >

                                        <summary
                                            class="cursor-pointer text-sm font-semibold text-[#334E68] list-none flex items-center justify-between"
                                        >

                                            Tarde

                                            <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180 text-[#66788A]">
                                                &#9660;
                                            </span>

                                        </summary>


                                        <ul
                                            id="{{ $diaKey }}TardeList"
                                            class="mt-2 space-y-1.5"
                                        >

                                            @php
                                                $hasAfternoonStudents = false;
                                            @endphp


                                            @foreach($students as $student)

                                                @if(
                                                    $student->{$diaInfo['campo']} === true &&
                                                    $student->turn_apae === 'Tarde'
                                                )

                                                    @php

                                                        $hasAfternoonStudents = true;

                                                        $frequency = collect($frequencies)
                                                            ->where('student_id', $student->id)
                                                            ->where('month_year', $month . '/' . $year)
                                                            ->first();

                                                        $attendanceExists =
                                                            App\Models\Attendance::where(
                                                                'student_id',
                                                                $student->id
                                                            )
                                                            ->where(
                                                                'date',
                                                                $dateForAttendance
                                                            )
                                                            ->exists();

                                                        $frequencyValue =
                                                            $frequency
                                                                ? $frequency->{$day}
                                                                : null;

                                                    @endphp


                                                    @if($frequency)

                                                        @php

                                                            if ($attendanceExists) {

                                                                $attendanceLink = route(
                                                                    'attendance.list',
                                                                    [
                                                                        'date_range' => $displayDate . ' à ' . $displayDate
                                                                    ]
                                                                );

                                                            } elseif ($frequencyValue === true) {

                                                                $attendanceLink = '#';

                                                            } else {

                                                                $attendanceLink = route(
                                                                    'attendance.create',
                                                                    [
                                                                        'student_id' => $student->id,
                                                                        'date' => $diasDaSemana[$diaKey],
                                                                        'year' => $year
                                                                    ]
                                                                );

                                                            }

                                                        @endphp


                                                        <li
                                                            class="text-sm
                                                            {{
                                                                $frequencyValue === true
                                                                    ? 'text-[#3B7D5A]'
                                                                    : (
                                                                        $frequencyValue === false
                                                                            ? 'text-[#B42318]'
                                                                            : 'text-[#66788A]'
                                                                    )
                                                            }}"
                                                        >

                                                            <div class="flex items-center space-x-1.5">

                                                                <a
                                                                    href="{{ $attendanceLink }}"
                                                                    class="truncate
                                                                    {{
                                                                        $attendanceExists
                                                                            ? 'font-medium hover:underline'
                                                                            : ''
                                                                    }}"
                                                                >

                                                                    {{ $student->name }}

                                                                </a>


                                                                @if($attendanceExists)

                                                                    <span class="flex-shrink-0 text-[#3B7D5A]">
                                                                        ✓
                                                                    </span>

                                                                @elseif($frequencyValue === true)

                                                                    <span class="flex-shrink-0 text-[#B42318]">
                                                                        ✗
                                                                    </span>

                                                                @endif

                                                            </div>

                                                        </li>

                                                    @endif

                                                @endif

                                            @endforeach


                                            @if(!$hasAfternoonStudents)

                                                <li class="text-sm text-[#8091A5]">
                                                    Nenhum aluno para {{ strtolower($diaInfo['nome']) }} de tarde
                                                </li>

                                            @endif

                                        </ul>

                                    </details>

                                </div>

                            </div>

                        @endforeach

                    </div>


                @else

                    <div class="flex items-center justify-center py-8">

                        <p class="text-[#66788A]">
                            Nenhum Aluno Cadastrado no Sistema
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


<style>
    /* =========================================================
       CALENDÁRIO DE ATENDIMENTO
       IDENTIDADE VISUAL SIAPAE
       ========================================================= */

    .attendance-calendar-component {
        background-color: #F4F6F8;
    }

    .attendance-calendar-component .bg-white {
        background-color: #FFFFFF !important;
    }

    .attendance-calendar-component details summary::-webkit-details-marker {
        display: none;
    }

    .attendance-calendar-component details summary {
        user-select: none;
    }

    .attendance-calendar-component a {
        transition:
            color 0.18s ease,
            background-color 0.18s ease;
    }

    .attendance-calendar-component a:hover {
        color: #2F684A;
    }

    @media (max-width: 640px) {

        .attendance-calendar-component {
            padding-bottom: 1rem;
        }

    }
</style>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const clearLocalStorageBtn =
            document.getElementById('clearLocalStorageBtn');

        if (clearLocalStorageBtn) {

            clearLocalStorageBtn.addEventListener(
                'click',
                function () {

                    localStorage.removeItem('faixaSemana');
                    localStorage.removeItem('year');
                    localStorage.removeItem('diasDaSemana');
                    localStorage.removeItem('studentsData');

                    location.reload();

                }
            );

        }

    });


    $(document).ready(function () {

        var faixaSemana =
            localStorage.getItem('faixaSemana')
                ? localStorage.getItem('faixaSemana')
                : '{{ $faixaSemana }}';


        var year =
            localStorage.getItem('year')
                ? localStorage.getItem('year')
                : '{{ $year }}';


        var sessionFaixaSemana =
            "{{ session('faixaSemana') }}";

        var sessionYear =
            "{{ session('year') }}";


        if (sessionFaixaSemana && sessionYear) {

            faixaSemana = sessionFaixaSemana;
            year = sessionYear;


            sessionStorage.removeItem('faixaSemana');
            sessionStorage.removeItem('year');


            mudarSemana(
                faixaSemana,
                0,
                year
            );


            $.ajax({

                url:
                    '{{ route('attendance.clearSession') }}',

                type:
                    'POST',

                data: {

                    _token:
                        '{{ csrf_token() }}'

                },

                success: function (response) {

                    if (response.success) {
                    }

                },

                error: function () {

                    console.error(
                        "Erro ao limpar a sessão."
                    );

                }

            });


            sessionFaixaSemana = null;
            sessionYear = null;

        }


        $('#btnPrevious').on(
            'click',
            function () {

                mudarSemana(
                    faixaSemana,
                    -1,
                    year
                );

            }
        );


        $('#btnNext').on(
            'click',
            function () {

                mudarSemana(
                    faixaSemana,
                    1,
                    year
                );

            }
        );


        // =========================================================
        // MUDAR SEMANA
        // =========================================================

        function mudarSemana(
            faixa,
            direcao,
            year
        ) {

            $.ajax({

                url:
                    '{{ route('attendance.weekChange') }}',

                type:
                    'GET',

                data: {

                    faixaSemana:
                        faixa,

                    direcao:
                        direcao,

                    year:
                        year

                },

                success: function (data) {

                    $('#faixaSemana')
                        .text(data.faixaSemana);

                    $('#year')
                        .text(data.year);


                    faixaSemana =
                        data.faixaSemana;

                    year =
                        data.year;


                    localStorage.setItem(
                        'faixaSemana',
                        data.faixaSemana
                    );

                    localStorage.setItem(
                        'year',
                        data.year
                    );

                    localStorage.setItem(
                        'diasDaSemana',
                        JSON.stringify(
                            data.diasDaSemana
                        )
                    );


                    updateDiasDaSemana(
                        data.diasDaSemana
                    );


                    updateStudentsList(
                        data.studentsWithFrequency,
                        data.diasDaSemana,
                        data.year
                    );

                },

                error: function () {

                    alert(
                        'Erro ao carregar a faixa de semana'
                    );

                }

            });

        }


        // =========================================================
        // ATUALIZA DATAS
        // =========================================================

        function updateDiasDaSemana(
            diasDaSemana
        ) {

            for (
                let day in diasDaSemana
            ) {

                $('#' + day).text(
                    diasDaSemana[day]
                );

            }

        }


        // =========================================================
        // ATUALIZA LISTA DE ALUNOS
        // =========================================================

        function updateStudentsList(
            studentsWithFrequency,
            diasDaSemana,
            year
        ) {

            const studentsData = {};


            for (
                let day in diasDaSemana
            ) {

                var dayName =
                    day;

                var dayDate =
                    diasDaSemana[day];


                var [
                    dayNumber,
                    month
                ] =
                    dayDate.split('/');


                dayNumber =
                    dayNumber.startsWith('0')
                        ? dayNumber.substring(1)
                        : dayNumber;


                var attendanceDate =
                    year +
                    '-' +
                    month.padStart(2, '0') +
                    '-' +
                    dayNumber.padStart(2, '0');


                var displayDate =
                    dayNumber.padStart(2, '0') +
                    '/' +
                    month.padStart(2, '0') +
                    '/' +
                    year;


                $('#' + dayName + 'ManhaList')
                    .empty();

                $('#' + dayName + 'TardeList')
                    .empty();


                let hasMorningStudents =
                    false;

                let hasAfternoonStudents =
                    false;


                const morningStudents = [];

                const afternoonStudents = [];


                studentsWithFrequency.forEach(
                    function (item) {

                        var student =
                            item.student;

                        var frequency =
                            item.frequencies[dayName];

                        var attendanceExists =
                            item.attendanceExists[dayName];


                        if (
                            student.frequencyExists === true
                        ) {

                            var className =
                                frequency === true

                                    ? 'text-[#3B7D5A]'

                                    : (
                                        frequency === false
                                            ? 'text-[#B42318]'
                                            : 'text-[#66788A]'
                                    );


                            var ahref;


                            if (
                                attendanceExists === true
                            ) {

                                ahref =
                                    '<a href="/attendance/list?date_range=' +
                                    encodeURIComponent(
                                        displayDate +
                                        ' à ' +
                                        displayDate
                                    ) +
                                    '" class="hover:underline font-medium">' +
                                    student.name +
                                    '</a>';

                            }

                            else if (
                                frequency === false
                            ) {

                                ahref =
                                    '<a href="#" class="text-[#B42318]">' +
                                    student.name +
                                    '</a>';

                            }

                            else {

                                ahref =
                                    '<a href="/attendance/create?student_id=' +
                                    student.id +
                                    '&date=' +
                                    dayDate +
                                    '&year=' +
                                    year +
                                    '">' +
                                    student.name +
                                    '</a>';

                            }


                            var listItem = `

                                <li class="text-sm ${className}">

                                    <div class="flex items-center space-x-1.5">

                                        <span class="truncate">

                                            ${ahref}

                                        </span>

                                        ${
                                            attendanceExists === true

                                                ? '<span class="flex-shrink-0 text-[#3B7D5A]">✓</span>'

                                                : (
                                                    frequency === true
                                                        ? '<span class="flex-shrink-0 text-[#B42318]">✗</span>'
                                                        : ''
                                                )
                                        }

                                    </div>

                                </li>

                            `;


                            if (

                                (
                                    dayName === 'segunda' &&
                                    student.monday
                                ) ||

                                (
                                    dayName === 'terca' &&
                                    student.tuesday
                                ) ||

                                (
                                    dayName === 'quarta' &&
                                    student.wednesday
                                ) ||

                                (
                                    dayName === 'quinta' &&
                                    student.thursday
                                ) ||

                                (
                                    dayName === 'sexta' &&
                                    student.friday
                                )

                            ) {

                                if (
                                    student.turn_apae === 'Manhã'
                                ) {

                                    $('#' + dayName + 'ManhaList')
                                        .append(listItem);


                                    morningStudents.push(
                                        listItem
                                    );


                                    hasMorningStudents =
                                        true;

                                }

                                else if (
                                    student.turn_apae === 'Tarde'
                                ) {

                                    $('#' + dayName + 'TardeList')
                                        .append(listItem);


                                    afternoonStudents.push(
                                        listItem
                                    );


                                    hasAfternoonStudents =
                                        true;

                                }

                            }

                        }

                    }
                );


                /*
                 * Mensagem manhã
                 */

                const noMorningStudentsMessage =

                    '<li class="text-sm text-[#8091A5]">' +

                    'Nenhum aluno para ' +
                    dayName +
                    ' manhã' +

                    '</li>';


                /*
                 * Mensagem tarde
                 */

                const noAfternoonStudentsMessage =

                    '<li class="text-sm text-[#8091A5]">' +

                    'Nenhum aluno para ' +
                    dayName +
                    ' tarde' +

                    '</li>';


                if (
                    !hasMorningStudents
                ) {

                    $('#' + dayName + 'ManhaList')
                        .append(
                            noMorningStudentsMessage
                        );

                    morningStudents.push(
                        noMorningStudentsMessage
                    );

                }


                if (
                    !hasAfternoonStudents
                ) {

                    $('#' + dayName + 'TardeList')
                        .append(
                            noAfternoonStudentsMessage
                        );

                    afternoonStudents.push(
                        noAfternoonStudentsMessage
                    );

                }


                studentsData[dayName] = {

                    manha:
                        morningStudents,

                    tarde:
                        afternoonStudents

                };

            }


            localStorage.setItem(
                'studentsData',
                JSON.stringify(studentsData)
            );


            loadStudentsFromLocalStorage();

        }


        // =========================================================
        // CARREGA ALUNOS DO LOCALSTORAGE
        // =========================================================

        function loadStudentsFromLocalStorage() {

            const studentsData =
                JSON.parse(
                    localStorage.getItem(
                        'studentsData'
                    )
                );


            if (studentsData) {

                for (
                    let day in studentsData
                ) {

                    const dayData =
                        studentsData[day];


                    if (
                        dayData.manha
                    ) {

                        $('#' + day + 'ManhaList')
                            .html(
                                dayData.manha.join('')
                            );

                    }


                    if (
                        dayData.tarde
                    ) {

                        $('#' + day + 'TardeList')
                            .html(
                                dayData.tarde.join('')
                            );

                    }

                }

            }

        }


        // =========================================================
        // CARREGA DATAS DO LOCALSTORAGE
        // =========================================================

        function loadDiasDaSemana() {

            const diasDaSemana =
                JSON.parse(
                    localStorage.getItem(
                        'diasDaSemana'
                    )
                );


            if (diasDaSemana) {

                for (
                    let day in diasDaSemana
                ) {

                    $('#' + day).text(
                        diasDaSemana[day]
                    );

                }

            }

        }


        loadDiasDaSemana();

        loadStudentsFromLocalStorage();

    });

</script>