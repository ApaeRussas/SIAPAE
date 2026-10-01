<x-app-layout notRegularSidebar :element="$student">

    @php

        /*
        |--------------------------------------------------------------------------
        | ABA ATUAL
        |--------------------------------------------------------------------------
        */

        $tab = request('tab', 'perfil');


        /*
        |--------------------------------------------------------------------------
        | DADOS AUXILIARES DO ALUNO
        |--------------------------------------------------------------------------
        */

        $dateOfBirth = null;

        if ($student->date_of_birth) {

            $dateOfBirth = \Carbon\Carbon::parse(
                $student->date_of_birth
            )->format('d/m/Y');

        }


        $studentAge =
            $student->age ??
            'Não informado';


        $studentImage = $student->image
            ? asset('img/student/' . $student->image)
            : asset('img/student/Foto_Desconhecido.jpg');


        $professors =
            $student->professors ??
            collect();


        $professorNames =
            $professors
                ->pluck('name')
                ->filter()
                ->values()
                ->all();


        $isArchived =
            $student->state_student === 'archived';


        $statusLabel =
            $isArchived
                ? 'Arquivado'
                : 'Ativo';


        $statusClasses =
            $isArchived
                ? 'bg-gray-100 text-gray-700 border-gray-200'
                : 'bg-[#EDF5F0] text-[#2F684A] border-[#DCEBE2]';


        /*
        |--------------------------------------------------------------------------
        | ATENDIMENTOS DO ALUNO
        |--------------------------------------------------------------------------
        */

        $studentAttendances = collect();

        if ($tab === 'atendimentos') {

            $studentAttendances =
                \App\Models\Attendance::where(
                    'student_id',
                    $student->id
                )
                ->with(
                    'student',
                    'professor'
                )
                ->orderByDesc('date')
                ->paginate(10)
                ->withQueryString();

        }


        /*
        |--------------------------------------------------------------------------
        | FREQUÊNCIA DO ALUNO
        |--------------------------------------------------------------------------
        */

        $frequencyMonthYear =
            request(
                'monthYear',
                now()->format('m/Y')
            );


        /*
        | Garante que o valor esteja no formato m/Y.
        */

        try {

            $frequencyDate =
                \Carbon\Carbon::createFromFormat(
                    'm/Y',
                    $frequencyMonthYear
                );

        } catch (\Throwable $e) {

            $frequencyDate =
                now();

            $frequencyMonthYear =
                $frequencyDate->format('m/Y');

        }


        $frequencyMonth =
            (int) $frequencyDate->format('m');

        $frequencyYear =
            (int) $frequencyDate->format('Y');


        $numberDaysInMonth =
            $frequencyDate->daysInMonth;


        $studentFrequency = null;


        if ($tab === 'frequencia') {

            $studentFrequency =
                \App\Models\Frequency::where(
                    'student_id',
                    $student->id
                )
                ->where(
                    'month_year',
                    $frequencyMonthYear
                )
                ->first();

        }


        /*
        |--------------------------------------------------------------------------
        | CONTAGEM DA FREQUÊNCIA
        |--------------------------------------------------------------------------
        */

        $frequencyPresent = 0;

        $frequencyAbsent = 0;

        $frequencyNotRegistered = 0;


        if ($studentFrequency) {

            for (
                $day = 1;
                $day <= $numberDaysInMonth;
                $day++
            ) {

                if ($studentFrequency->{$day} === true) {

                    $frequencyPresent++;

                } elseif ($studentFrequency->{$day} === false) {

                    $frequencyAbsent++;

                } else {

                    $frequencyNotRegistered++;

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | SONDAGENS DO ALUNO
        |--------------------------------------------------------------------------
        */

        $diagnosticAssessments =
            collect();


        if ($tab === 'sondagens') {

            $diagnosticAssessments =
                \App\Models\DiagnosticAssessment::where(
                    'student_id',
                    $student->id
                )
                ->orderByDesc('date')
                ->paginate(10)
                ->withQueryString();

        }


        /*
        |--------------------------------------------------------------------------
        | EVOLUÇÃO DO ALUNO
        |--------------------------------------------------------------------------
        */

        $pedagogicals =
            collect();

        $evolutionAttendances =
            collect();

        $evolutionTotal = 0;

        $evolutionWithAdvances = 0;
        $evolutionWithDifficulties = 0;
        $evolutionWithSkills = 0;
        $evolutionActivitiesPerformed = 0;
        $evolutionActivitiesNotPerformed = 0;

        $firstEvolutionAttendance = null;
        $latestEvolutionAttendance = null;

        $firstAdvancesLevel = null;
        $latestAdvancesLevel = null;
        $firstDifficultiesLevel = null;
        $latestDifficultiesLevel = null;

        $evolutionAxes = collect();

        if ($tab === 'evolucao') {

            $evolutionAttendances =
                \App\Models\Attendance::where(
                    'student_id',
                    $student->id
                )
                ->with('professor')
                ->orderBy('date')
                ->get();

            $evolutionTotal =
                $evolutionAttendances->count();

            $evolutionWithAdvances =
                $evolutionAttendances
                    ->filter(fn ($item) => !empty($item->advances))
                    ->count();

            $evolutionWithDifficulties =
                $evolutionAttendances
                    ->filter(fn ($item) => !empty($item->difficulties))
                    ->count();

            $evolutionWithSkills =
                $evolutionAttendances
                    ->filter(fn ($item) => !empty($item->skills_evolution))
                    ->count();

            $evolutionActivitiesPerformed =
                $evolutionAttendances
                    ->filter(fn ($item) => $item->activity_not_performed === false)
                    ->count();

            $evolutionActivitiesNotPerformed =
                $evolutionAttendances
                    ->filter(fn ($item) => $item->activity_not_performed)
                    ->count();

            $firstEvolutionAttendance =
                $evolutionAttendances->first();

            $latestEvolutionAttendance =
                $evolutionAttendances->last();

            if ($firstEvolutionAttendance) {
                $firstAdvancesLevel =
                    $firstEvolutionAttendance->advances_level;

                $firstDifficultiesLevel =
                    $firstEvolutionAttendance->difficulties_level;
            }

            if ($latestEvolutionAttendance) {
                $latestAdvancesLevel =
                    $latestEvolutionAttendance->advances_level;

                $latestDifficultiesLevel =
                    $latestEvolutionAttendance->difficulties_level;
            }

            $evolutionAxes =
                $evolutionAttendances
                    ->pluck('educational_axis')
                    ->filter()
                    ->countBy()
                    ->sortDesc();

            $pedagogicals =
                \App\Models\Educational::where(
                    'student_id',
                    $student->id
                )
                ->with(
                    'student',
                    'professor'
                )
                ->orderByDesc('date_pedagogical')
                ->get();

        }


        /*
        |--------------------------------------------------------------------------
        | MÊS ANTERIOR / PRÓXIMO
        |--------------------------------------------------------------------------
        */

        $previousMonth =
            $frequencyDate
                ->copy()
                ->subMonth()
                ->format('m/Y');


        $nextMonth =
            $frequencyDate
                ->copy()
                ->addMonth()
                ->format('m/Y');

    @endphp


    {{-- =========================================================
         CONTEÚDO PRINCIPAL
         ========================================================= --}}

    <div class="min-h-screen bg-[#E8F0EA] pt-1 pb-6">


        {{-- =====================================================
             VOLTAR
             ===================================================== --}}

        <div class="w-full px-5 sm:px-7 lg:px-8 pt-0 mb-4">

            <a
                href="{{ route('student.index') }}"
                class="inline-flex items-center gap-3 text-lg font-semibold text-[#506C5E] hover:text-[#23543E] transition"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />

                </svg>

                <span>
                    Voltar
                </span>

            </a>

        </div>


        {{-- =====================================================
             CONTAINER CENTRAL
             ===================================================== --}}

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =====================================================
                 CABEÇALHO
                 ===================================================== --}}

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-7">


                <div>

                    <p class="text-sm font-semibold tracking-wide text-[#3B7D5A] mb-1">
                        SIAPAE
                    </p>


                    <h1 class="text-3xl md:text-4xl font-bold text-[#102A43]">
                        Perfil do estudante
                    </h1>


                    <p class="mt-1 text-sm md:text-base text-[#66788A]">
                        Informações completas do aluno cadastrado.
                    </p>

                </div>


                {{-- =================================================
                     AÇÕES
                     ================================================= --}}

                <div class="flex flex-wrap items-center gap-2">


                    {{-- EDITAR --}}

                    <a
                        href="{{ route('student.edit', $student->id) . '?notRegularSidebar=1' }}"
                        class="inline-flex items-center justify-center rounded-lg bg-[#3B7D5A] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2F684A] transition shadow-sm"
                    >

                        <x-icons.edit class="w-4 h-4 mr-2" />

                        Editar perfil

                    </a>


                    {{-- ARQUIVAR --}}

                    @if (!$isArchived)

                        <form
                            method="POST"
                            action="{{ route('student.archive', $student->id) }}"
                            class="inline"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-lg border border-[#E1E7EC] bg-white px-5 py-2.5 text-sm font-semibold text-[#334E68] hover:bg-[#F8FAF9] transition"
                                onclick="warningConfirm(
                                    event,
                                    'Essa ação irá arquivar o estudante selecionado!',
                                    'warning',
                                    'Arquivar'
                                )"
                            >

                                <x-icons.archive class="w-4 h-4 mr-2" />

                                Arquivar

                            </button>

                        </form>


                    @else

                        {{-- RESTAURAR --}}

                        <form
                            method="POST"
                            action="{{ route('student.restore', $student->id) }}"
                            class="inline"
                            onclick="warningConfirm(
                                event,
                                'Quer restaurar esse estudante?',
                                'question',
                                'Restaurar'
                            )"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-lg border border-[#DCEBE2] bg-[#EDF5F0] px-5 py-2.5 text-sm font-semibold text-[#2F684A] hover:bg-[#E2F0E8] transition"
                            >

                                <x-icons.restore class="w-4 h-4 mr-2" />

                                Restaurar

                            </button>

                        </form>

                    @endif

                </div>

            </div>


            {{-- =====================================================
                 CARTÃO PRINCIPAL DO ALUNO
                 ===================================================== --}}

            <div class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden mb-6">

                <div class="p-6 md:p-8">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">


                        {{-- FOTO + DADOS --}}

                        <div class="flex flex-col sm:flex-row sm:items-center gap-5">


                            <div class="flex-shrink-0">

                                <img
                                    src="{{ $studentImage }}"
                                    alt="Foto de {{ $student->name }}"
                                    class="w-28 h-28 rounded-2xl object-cover border-4 border-[#EDF5F0] shadow-sm"
                                >

                            </div>


                            <div>


                                <div class="flex flex-wrap items-center gap-3">

                                    <h2 class="text-2xl md:text-3xl font-bold text-[#102A43]">
                                        {{ $student->name }}
                                    </h2>


                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                                        {{ $statusLabel }}
                                    </span>

                                </div>


                                @if (!empty($student->name_social))

                                    <p class="mt-1 text-sm text-[#66788A]">

                                        Nome social:

                                        <span class="font-semibold text-[#334E68]">
                                            {{ $student->name_social }}
                                        </span>

                                    </p>

                                @endif


                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 text-sm">


                                    <div class="flex items-center gap-2 text-[#66788A]">

                                        <span class="font-semibold text-[#334E68]">
                                            ID:
                                        </span>

                                        <span>
                                            {{ $student->student_id ?: 'Não informado' }}
                                        </span>

                                    </div>


                                    <div class="flex items-center gap-2 text-[#66788A]">

                                        <span class="font-semibold text-[#334E68]">
                                            SIGE:
                                        </span>

                                        <span>
                                            {{ $student->sige ?: 'Não informado' }}
                                        </span>

                                    </div>


                                    <div class="flex items-center gap-2 text-[#66788A]">

                                        <span class="font-semibold text-[#334E68]">
                                            Nascimento:
                                        </span>

                                        <span>
                                            {{ $dateOfBirth ?: 'Não informado' }}
                                        </span>

                                    </div>


                                    <div class="flex items-center gap-2 text-[#66788A]">

                                        <span class="font-semibold text-[#334E68]">
                                            Idade:
                                        </span>

                                        <span>
                                            {{ $studentAge }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- RESUMO --}}

                        <div class="w-full lg:w-auto lg:min-w-[330px]">

                            <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] p-5">

                                <p class="text-sm font-bold text-[#2F684A]">
                                    Resumo do estudante
                                </p>


                                <div class="mt-4 grid grid-cols-2 gap-4">


                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                            Diagnóstico
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-[#102A43]">
                                            {{ $student->diagnostic ?: 'Não informado' }}
                                        </p>

                                    </div>


                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                            Serviço
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-[#102A43]">
                                            {{ $student->service ?: 'Não informado' }}
                                        </p>

                                    </div>


                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                            Turno APAE
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-[#102A43]">
                                            {{ $student->turn_apae ?: 'Não informado' }}
                                        </p>

                                    </div>


                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                            Escola
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-[#102A43]">
                                            {{ $student->school ?: 'Não informado' }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 ABAS
                 ===================================================== --}}

            <div class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden mb-6">

                <div class="flex flex-wrap border-b border-[#E1E7EC]">


                    {{-- PERFIL --}}

                    <a
                        href="{{ route('student.show', [
                            'student' => $student->id,
                            'tab' => 'perfil'
                        ]) }}"
                        class="profile-tab {{ $tab === 'perfil' ? 'active' : '' }}"
                    >
                        Perfil
                    </a>


                    {{-- ATENDIMENTOS --}}

                    <a
                        href="{{ route('student.show', [
                            'student' => $student->id,
                            'tab' => 'atendimentos'
                        ]) }}"
                        class="profile-tab {{ $tab === 'atendimentos' ? 'active' : '' }}"
                    >
                        Atendimentos
                    </a>


                    {{-- FREQUÊNCIA --}}

                    <a
                        href="{{ route('student.show', [
                            'student' => $student->id,
                            'tab' => 'frequencia',
                            'monthYear' => $frequencyMonthYear
                        ]) }}"
                        class="profile-tab {{ $tab === 'frequencia' ? 'active' : '' }}"
                    >
                        Frequência
                    </a>


                    {{-- SONDAGENS --}}

                    <a
                        href="{{ route('student.show', [
                            'student' => $student->id,
                            'tab' => 'sondagens'
                        ]) }}"
                        class="profile-tab {{ $tab === 'sondagens' ? 'active' : '' }}"
                    >
                        Sondagens
                    </a>


                    {{-- EVOLUÇÃO --}}

                    <a
                        href="{{ route('student.show', [
                            'student' => $student->id,
                            'tab' => 'evolucao'
                        ]) }}"
                        class="profile-tab {{ $tab === 'evolucao' ? 'active' : '' }}"
                    >
                        Evolução
                    </a>

                </div>

            </div>


            {{-- =====================================================
                 ABA ATENDIMENTOS
                 ===================================================== --}}

            @if ($tab === 'atendimentos')


                <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                    {{-- CABEÇALHO --}}

                    <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">


                            <div>

                                <p class="text-sm font-semibold text-[#3B7D5A] mb-1">
                                    Acompanhamento
                                </p>

                                <h2 class="text-xl md:text-2xl font-bold text-[#102A43]">
                                    Atendimentos de {{ $student->name }}
                                </h2>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    Registros de atendimento exclusivamente deste estudante.
                                </p>

                            </div>


                            <a
                                href="{{ route('attendance.create', [
                                    'student_id' => $student->id
                                ]) }}"
                                class="inline-flex items-center justify-center rounded-lg bg-[#3B7D5A] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                            >
                                + Novo atendimento
                            </a>

                        </div>

                    </div>


                    {{-- LISTAGEM --}}

                    @if ($studentAttendances->count())


                        <div class="divide-y divide-[#E1E7EC]">


                            @foreach ($studentAttendances as $attendance)


                                <article class="px-6 md:px-8 py-6 hover:bg-[#F8FAF9] transition">


                                    <div class="flex flex-col gap-5">


                                        {{-- TOPO DO REGISTRO --}}

                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">


                                            <div>

                                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                                    Data do atendimento
                                                </p>

                                                <p class="mt-1 text-lg font-bold text-[#102A43]">

                                                    {{ \Carbon\Carbon::parse(
                                                        $attendance->date
                                                    )->format('d/m/Y') }}

                                                </p>

                                            </div>


                                            <div class="flex flex-wrap gap-2">


                                                @if ($attendance->professor)

                                                    <span class="inline-flex items-center rounded-full bg-[#EDF5F0] border border-[#DCEBE2] px-3 py-1.5 text-xs font-semibold text-[#2F684A]">

                                                        Professor:
                                                        {{ $attendance->professor->name }}

                                                    </span>

                                                @endif


                                                @if ($attendance->activity_not_performed)

                                                    <span class="inline-flex items-center rounded-full bg-gray-100 border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-600">

                                                        Atividade não realizada

                                                    </span>

                                                @endif

                                            </div>

                                        </div>


                                        {{-- INFORMAÇÕES DO ATENDIMENTO --}}

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                                            {{-- EIXO --}}

                                            <div class="rounded-xl border border-[#E1E7EC] bg-[#FAFBFC] p-4 md:col-span-2">

                                                <p class="profile-label">
                                                    Eixo educacional
                                                </p>

                                                <p class="profile-value">
                                                    {{ $attendance->educational_axis ?: 'Não informado' }}
                                                </p>

                                            </div>


                                            {{-- HABILIDADES --}}

                                            @if (!empty($attendance->skills))

                                                <div class="rounded-xl border border-[#E1E7EC] p-4">

                                                    <p class="profile-label">
                                                        Habilidades
                                                    </p>

                                                    <p class="mt-1 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->skills }}
                                                    </p>

                                                </div>

                                            @endif


                                            {{-- EVOLUÇÃO DAS HABILIDADES --}}

                                            @if (!empty($attendance->skills_evolution))

                                                <div class="rounded-xl border border-[#E1E7EC] p-4">

                                                    <p class="profile-label">
                                                        Evolução das habilidades
                                                    </p>

                                                    <p class="mt-1 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->skills_evolution }}
                                                    </p>

                                                </div>

                                            @endif


                                            {{-- ATIVIDADE --}}

                                            @if (!empty($attendance->activity_description))

                                                <div class="rounded-xl border border-[#E1E7EC] p-4 md:col-span-2">

                                                    <p class="profile-label">
                                                        Descrição da atividade
                                                    </p>

                                                    <p class="mt-1 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->activity_description }}
                                                    </p>

                                                </div>

                                            @endif


                                            {{-- AVANÇOS --}}

                                            @if (!empty($attendance->advances))

                                                <div class="rounded-xl border border-[#DCEBE2] bg-[#EDF5F0] p-4">

                                                    <p class="profile-label">
                                                        Avanços
                                                    </p>

                                                    <p class="mt-1 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->advances }}
                                                    </p>

                                                </div>

                                            @endif


                                            {{-- DIFICULDADES --}}

                                            @if (!empty($attendance->difficulties))

                                                <div class="rounded-xl border border-[#F0DFDF] bg-[#FFF9F9] p-4">

                                                    <p class="profile-label">
                                                        Dificuldades
                                                    </p>

                                                    <p class="mt-1 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->difficulties }}
                                                    </p>

                                                </div>

                                            @endif


                                            {{-- NÍVEL DOS AVANÇOS --}}

                                            @if (!is_null($attendance->advances_level))

                                                <div>

                                                    <p class="profile-label">
                                                        Nível dos avanços
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ $attendance->advances_level }}
                                                    </p>

                                                </div>

                                            @endif


                                            {{-- NÍVEL DAS DIFICULDADES --}}

                                            @if (!is_null($attendance->difficulties_level))

                                                <div>

                                                    <p class="profile-label">
                                                        Nível das dificuldades
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ $attendance->difficulties_level }}
                                                    </p>

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </article>


                            @endforeach

                        </div>


                        {{-- PAGINAÇÃO --}}

                        @if ($studentAttendances->hasPages())

                            <div class="px-6 md:px-8 py-5 border-t border-[#E1E7EC]">

                                {{ $studentAttendances->links() }}

                            </div>

                        @endif


                    @else


                        {{-- SEM ATENDIMENTOS --}}

                        <div class="px-6 md:px-8 py-16 text-center">


                            <div class="mx-auto w-14 h-14 rounded-xl bg-[#EDF5F0] flex items-center justify-center text-[#3B7D5A] text-2xl">
                                +
                            </div>


                            <h3 class="mt-4 text-lg font-bold text-[#102A43]">
                                Nenhum atendimento registrado
                            </h3>


                            <p class="mt-1 text-sm text-[#66788A]">
                                Este estudante ainda não possui registros de atendimento.
                            </p>


                            <a
                                href="{{ route('attendance.create', [
                                    'student_id' => $student->id
                                ]) }}"
                                class="inline-flex items-center justify-center mt-5 rounded-lg bg-[#3B7D5A] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                            >
                                Adicionar primeiro atendimento
                            </a>

                        </div>

                    @endif

                </section>


            {{-- =====================================================
                 ABA FREQUÊNCIA
                 ===================================================== --}}

            @elseif ($tab === 'frequencia')


                <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                    {{-- CABEÇALHO --}}

                    <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">


                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">


                            <div>

                                <p class="text-sm font-semibold text-[#3B7D5A] mb-1">
                                    Frequência
                                </p>

                                <h2 class="text-xl md:text-2xl font-bold text-[#102A43]">
                                    Frequência de {{ $student->name }}
                                </h2>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    Frequência mensal exclusivamente deste estudante.
                                </p>

                            </div>


                            {{-- NAVEGAÇÃO DO MÊS --}}

                            <div class="flex items-center gap-2">


                                <a
                                    href="{{ route('student.show', [
                                        'student' => $student->id,
                                        'tab' => 'frequencia',
                                        'monthYear' => $previousMonth
                                    ]) }}"
                                    class="frequency-month-btn"
                                    title="Mês anterior"
                                >
                                    ‹
                                </a>


                                <div class="min-w-[130px] text-center">

                                    <p class="text-sm font-bold text-[#102A43]">
                                        {{ $frequencyDate->translatedFormat('F Y') }}
                                    </p>

                                </div>


                                <a
                                    href="{{ route('student.show', [
                                        'student' => $student->id,
                                        'tab' => 'frequencia',
                                        'monthYear' => $nextMonth
                                    ]) }}"
                                    class="frequency-month-btn"
                                    title="Próximo mês"
                                >
                                    ›
                                </a>

                            </div>

                        </div>

                    </div>


                    @if ($studentFrequency)


                        {{-- RESUMO --}}

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 px-6 md:px-8 py-6 border-b border-[#E1E7EC]">


                            <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] p-4">

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                    Presenças
                                </p>

                                <p class="mt-1 text-2xl font-bold text-[#2F684A]">
                                    {{ $frequencyPresent }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-[#FFF9F9] border border-[#F0DFDF] p-4">

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                    Faltas
                                </p>

                                <p class="mt-1 text-2xl font-bold text-[#B45353]">
                                    {{ $frequencyAbsent }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-[#F8FAF9] border border-[#E1E7EC] p-4">

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                    Sem registro
                                </p>

                                <p class="mt-1 text-2xl font-bold text-[#66788A]">
                                    {{ $frequencyNotRegistered }}
                                </p>

                            </div>

                        </div>


                        {{-- LEGENDA --}}

                        <div class="px-6 md:px-8 pt-6">

                            <div class="flex flex-wrap gap-4 text-xs font-semibold text-[#66788A]">


                                <div class="flex items-center gap-2">

                                    <span class="frequency-status frequency-present">
                                        ✓
                                    </span>

                                    Presente

                                </div>


                                <div class="flex items-center gap-2">

                                    <span class="frequency-status frequency-absent">
                                        ×
                                    </span>

                                    Falta

                                </div>


                                <div class="flex items-center gap-2">

                                    <span class="frequency-status frequency-empty">
                                        —
                                    </span>

                                    Sem registro

                                </div>

                            </div>

                        </div>


                        {{-- DIAS --}}

                        <div class="p-6 md:p-8">

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3">


                                @for ($day = 1; $day <= $numberDaysInMonth; $day++)

                                    @php

                                        $currentDate =
                                            \Carbon\Carbon::create(
                                                $frequencyYear,
                                                $frequencyMonth,
                                                $day
                                            );

                                        $dayValue =
                                            $studentFrequency->{$day};

                                        $isWeekend =
                                            $currentDate->isWeekend();

                                    @endphp


                                    <div
                                        class="rounded-xl border p-3
                                        {{
                                            $isWeekend
                                                ? 'bg-gray-50 border-gray-200 opacity-70'
                                                : 'bg-white border-[#E1E7EC]'
                                        }}"
                                    >


                                        <div class="flex items-center justify-between">


                                            <div>

                                                <p class="text-xs font-semibold text-[#66788A] uppercase">
                                                    {{ $currentDate->translatedFormat('D') }}
                                                </p>

                                                <p class="text-lg font-bold text-[#102A43]">
                                                    {{ $day }}
                                                </p>

                                            </div>


                                            @if ($dayValue === true)

                                                <span class="frequency-status frequency-present">
                                                    ✓
                                                </span>


                                            @elseif ($dayValue === false)

                                                <span class="frequency-status frequency-absent">
                                                    ×
                                                </span>


                                            @else

                                                <span class="frequency-status frequency-empty">
                                                    —
                                                </span>

                                            @endif

                                        </div>


                                        <p class="mt-2 text-xs text-[#66788A]">

                                            @if ($isWeekend)

                                                Fim de semana

                                            @elseif ($dayValue === true)

                                                Presente

                                            @elseif ($dayValue === false)

                                                Falta

                                            @else

                                                Sem registro

                                            @endif

                                        </p>

                                    </div>

                                @endfor

                            </div>

                        </div>


                    @else


                        {{-- SEM FREQUÊNCIA --}}

                        <div class="px-6 md:px-8 py-16 text-center">


                            <div class="mx-auto w-14 h-14 rounded-xl bg-[#EDF5F0] flex items-center justify-center text-[#3B7D5A] text-2xl">
                                ✓
                            </div>


                            <h3 class="mt-4 text-lg font-bold text-[#102A43]">
                                Nenhuma frequência encontrada
                            </h3>


                            <p class="mt-1 text-sm text-[#66788A]">
                                Não existe um registro de frequência para
                                {{ $frequencyMonthYear }} deste estudante.
                            </p>

                        </div>

                    @endif

                </section>


            {{-- =====================================================
                 ABA SONDAGENS
                 ===================================================== --}}

            @elseif ($tab === 'sondagens')


                <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                    {{-- CABEÇALHO --}}

                    <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">


                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">


                            <div>

                                <p class="text-sm font-semibold text-[#3B7D5A] mb-1">
                                    Avaliações
                                </p>

                                <h2 class="text-xl md:text-2xl font-bold text-[#102A43]">
                                    Sondagens de {{ $student->name }}
                                </h2>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    Sondagens diagnósticas registradas exclusivamente para este estudante.
                                </p>

                            </div>


                            <a
                                href="{{ route('diagnostic-assessments.create', [
                                    'student_id' => $student->id
                                ]) }}"
                                class="inline-flex items-center justify-center rounded-lg bg-[#3B7D5A] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                            >
                                + Nova sondagem
                            </a>

                        </div>

                    </div>


                    @if ($diagnosticAssessments->count())


                        <div class="divide-y divide-[#E1E7EC]">


                            @foreach ($diagnosticAssessments as $assessment)


                                <div class="px-6 md:px-8 py-6 hover:bg-[#F8FAF9] transition">


                                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">


                                        <div class="min-w-0 flex-1">


                                            <div class="flex flex-wrap items-center gap-3">


                                                <h3 class="text-base md:text-lg font-bold text-[#102A43]">
                                                    Sondagem Diagnóstica Psicopedagógica
                                                </h3>


                                                @if ($assessment->date)

                                                    <span class="inline-flex items-center rounded-full bg-[#EDF5F0] border border-[#DCEBE2] px-3 py-1 text-xs font-semibold text-[#2F684A]">

                                                        {{ \Carbon\Carbon::parse(
                                                            $assessment->date
                                                        )->format('d/m/Y') }}

                                                    </span>

                                                @endif

                                            </div>


                                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


                                                <div>

                                                    <p class="profile-label">
                                                        Série
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ $assessment->series ?: 'Não informado' }}
                                                    </p>

                                                </div>


                                                <div>

                                                    <p class="profile-label">
                                                        Escola
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ $assessment->school ?: 'Não informado' }}
                                                    </p>

                                                </div>


                                                <div>

                                                    <p class="profile-label">
                                                        CID
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ $assessment->cid ?: 'Não informado' }}
                                                    </p>

                                                </div>


                                                <div>

                                                    <p class="profile-label">
                                                        Idade
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ $assessment->age ?: 'Não informado' }}
                                                    </p>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="flex flex-wrap gap-2 flex-shrink-0">


                                            <a
                                                href="{{ route('diagnostic-assessments.show', $assessment->id) }}"
                                                class="inline-flex items-center justify-center rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-sm font-semibold text-[#334E68] hover:bg-[#F8FAF9] transition"
                                            >
                                                Ver detalhes
                                            </a>


                                            <a
                                                href="{{ route('diagnostic-assessments.edit', $assessment->id) }}"
                                                class="inline-flex items-center justify-center rounded-lg bg-[#3B7D5A] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                                            >
                                                Editar
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        @if ($diagnosticAssessments->hasPages())

                            <div class="px-6 md:px-8 py-5 border-t border-[#E1E7EC]">

                                {{ $diagnosticAssessments->links() }}

                            </div>

                        @endif


                    @else


                        <div class="px-6 md:px-8 py-16 text-center">


                            <div class="mx-auto w-14 h-14 rounded-xl bg-[#EDF5F0] flex items-center justify-center text-[#3B7D5A] text-2xl">
                                ✓
                            </div>


                            <h3 class="mt-4 text-lg font-bold text-[#102A43]">
                                Nenhuma sondagem registrada
                            </h3>


                            <p class="mt-1 text-sm text-[#66788A]">
                                Este estudante ainda não possui uma sondagem diagnóstica cadastrada.
                            </p>


                            <a
                                href="{{ route('diagnostic-assessments.create', [
                                    'student_id' => $student->id
                                ]) }}"
                                class="inline-flex items-center justify-center mt-5 rounded-lg bg-[#3B7D5A] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                            >
                                Adicionar primeira sondagem
                            </a>

                        </div>

                    @endif

                </section>


            {{-- =====================================================
                 ABA EVOLUÇÃO
                 ===================================================== --}}

            @elseif ($tab === 'evolucao')


                {{-- =====================================================
                     CABEÇALHO
                     ===================================================== --}}

                <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden mb-6">

                    <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">

                        <p class="text-sm font-semibold text-[#3B7D5A] mb-1">
                            Análise de acompanhamento
                        </p>

                        <h2 class="text-xl md:text-2xl font-bold text-[#102A43]">
                            Evolução de {{ $student->name }}
                        </h2>

                        <p class="mt-1 text-sm text-[#66788A]">
                            Análise construída a partir dos atendimentos registrados para este estudante.
                        </p>

                    </div>


                    @if ($evolutionTotal > 0)

                        {{-- =================================================
                             INDICADORES
                             ================================================= --}}

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-6 md:p-8 border-b border-[#E1E7EC]">

                            <div class="rounded-2xl border border-[#DCEBE2] bg-[#EDF5F0] p-5">

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                    Atendimentos analisados
                                </p>

                                <p class="mt-2 text-3xl font-bold text-[#2F684A]">
                                    {{ $evolutionTotal }}
                                </p>

                                <p class="mt-1 text-xs text-[#66788A]">
                                    registros encontrados para o estudante
                                </p>

                            </div>


                            <div class="rounded-2xl border border-[#DCEBE2] bg-[#F8FAF9] p-5">

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                    Registros com avanços
                                </p>

                                <p class="mt-2 text-3xl font-bold text-[#2F684A]">
                                    {{ $evolutionWithAdvances }}
                                </p>

                                <p class="mt-1 text-xs text-[#66788A]">
                                    de {{ $evolutionTotal }} atendimento(s)
                                </p>

                            </div>


                            <div class="rounded-2xl border border-[#E1E7EC] bg-[#F8FAF9] p-5">

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                    Evolução de habilidades
                                </p>

                                <p class="mt-2 text-3xl font-bold text-[#102A43]">
                                    {{ $evolutionWithSkills }}
                                </p>

                                <p class="mt-1 text-xs text-[#66788A]">
                                    registro(s) com descrição de evolução
                                </p>

                            </div>


                            <div class="rounded-2xl border border-[#E1E7EC] bg-[#F8FAF9] p-5">

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                    Dificuldades registradas
                                </p>

                                <p class="mt-2 text-3xl font-bold text-[#B45353]">
                                    {{ $evolutionWithDifficulties }}
                                </p>

                                <p class="mt-1 text-xs text-[#66788A]">
                                    ponto(s) acompanhado(s) ao longo do período
                                </p>

                            </div>

                        </div>


                        {{-- =================================================
                             LEITURA DA EVOLUÇÃO
                             ================================================= --}}

                        <div class="px-6 md:px-8 py-7">

                            <div class="rounded-2xl border border-[#DCEBE2] bg-[#F8FAF9] p-6">

                                <div class="flex items-start gap-4">

                                    <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-[#EDF5F0] text-[#3B7D5A] flex items-center justify-center">

                                        <svg
                                            class="w-6 h-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8-8 8-4-4-6 6"
                                            />
                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <h3 class="text-lg font-bold text-[#102A43]">
                                            Leitura da evolução registrada
                                        </h3>

                                        <p class="mt-1 text-sm leading-6 text-[#66788A]">
                                            Esta síntese considera somente as informações que foram efetivamente registradas nos atendimentos do estudante.
                                        </p>

                                    </div>

                                </div>


                                <div class="mt-6 space-y-3">

                                    @if ($firstEvolutionAttendance && $latestEvolutionAttendance)

                                        <div class="rounded-xl border border-[#E1E7EC] bg-white px-4 py-4">

                                            <p class="text-sm leading-6 text-[#334E68]">
                                                O acompanhamento possui registros desde
                                                <strong class="text-[#102A43]">
                                                    {{ \Carbon\Carbon::parse($firstEvolutionAttendance->date)->format('d/m/Y') }}
                                                </strong>
                                                até
                                                <strong class="text-[#102A43]">
                                                    {{ \Carbon\Carbon::parse($latestEvolutionAttendance->date)->format('d/m/Y') }}
                                                </strong>.
                                                Ao longo desse período, foram documentados
                                                <strong class="text-[#2F684A]">
                                                    {{ $evolutionWithAdvances }} registro(s) com avanços
                                                </strong>
                                                e
                                                <strong class="text-[#B45353]">
                                                    {{ $evolutionWithDifficulties }} registro(s) com dificuldades
                                                </strong>.
                                            </p>

                                        </div>

                                    @endif


                                    @if ($evolutionActivitiesPerformed > 0)

                                        <div class="rounded-xl border border-[#E1E7EC] bg-white px-4 py-4">

                                            <p class="text-sm leading-6 text-[#334E68]">
                                                Foram registradas atividades realizadas em
                                                <strong class="text-[#102A43]">
                                                    {{ $evolutionActivitiesPerformed }} de {{ $evolutionTotal }}
                                                </strong>
                                                atendimento(s).
                                                @if ($evolutionActivitiesNotPerformed > 0)
                                                    Também existem
                                                    <strong class="text-[#66788A]">
                                                        {{ $evolutionActivitiesNotPerformed }} registro(s)
                                                    </strong>
                                                    em que a atividade não foi realizada.
                                                @endif
                                            </p>

                                        </div>

                                    @endif


                                    @if ($latestEvolutionAttendance && !empty($latestEvolutionAttendance->skills_evolution))

                                        <div class="rounded-xl border border-[#DCEBE2] bg-[#EDF5F0] px-4 py-4">

                                            <p class="profile-label">
                                                Evolução de habilidades registrada no atendimento mais recente
                                            </p>

                                            <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                {{ $latestEvolutionAttendance->skills_evolution }}
                                            </p>

                                        </div>

                                    @endif


                                    @if ($latestEvolutionAttendance && !empty($latestEvolutionAttendance->advances))

                                        <div class="rounded-xl border border-[#DCEBE2] bg-white px-4 py-4">

                                            <p class="profile-label">
                                                Avanços mais recentes
                                            </p>

                                            <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                {{ $latestEvolutionAttendance->advances }}
                                            </p>

                                        </div>

                                    @endif


                                    @if ($latestEvolutionAttendance && !empty($latestEvolutionAttendance->difficulties))

                                        <div class="rounded-xl border border-[#F0DFDF] bg-[#FFF9F9] px-4 py-4">

                                            <p class="profile-label">
                                                Dificuldades que permanecem em acompanhamento
                                            </p>

                                            <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                {{ $latestEvolutionAttendance->difficulties }}
                                            </p>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="px-6 md:px-8 py-16 text-center">

                            <div class="mx-auto w-14 h-14 rounded-xl bg-[#EDF5F0] flex items-center justify-center text-[#3B7D5A]">

                                <svg
                                    class="w-7 h-7"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8-8 8-4-4-6 6"
                                    />
                                </svg>

                            </div>

                            <h3 class="mt-4 text-lg font-bold text-[#102A43]">
                                Ainda não é possível analisar a evolução
                            </h3>

                            <p class="mt-1 text-sm text-[#66788A] max-w-xl mx-auto">
                                Este estudante ainda não possui atendimentos registrados. Depois que os atendimentos forem cadastrados, esta aba passará a apresentar a análise da evolução.
                            </p>

                        </div>

                    @endif

                </section>


                {{-- =====================================================
                     LINHA DO TEMPO DOS ATENDIMENTOS
                     ===================================================== --}}

                @if ($evolutionTotal > 0)

                    <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden mb-6">

                        <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">

                            <p class="text-sm font-semibold text-[#3B7D5A] mb-1">
                                Histórico de acompanhamento
                            </p>

                            <h2 class="text-xl md:text-2xl font-bold text-[#102A43]">
                                Linha do tempo da evolução
                            </h2>

                            <p class="mt-1 text-sm text-[#66788A]">
                                Veja como os registros de atendimento foram sendo construídos ao longo do tempo.
                            </p>

                        </div>


                        <div class="divide-y divide-[#E1E7EC]">

                            @foreach ($evolutionAttendances->reverse() as $attendance)

                                <article class="px-6 md:px-8 py-6">

                                    <div class="flex flex-col lg:flex-row lg:items-start gap-5">

                                        <div class="lg:w-40 flex-shrink-0">

                                            <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                                Data
                                            </p>

                                            <p class="mt-1 text-lg font-bold text-[#102A43]">
                                                {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}
                                            </p>

                                            @if ($attendance->professor)
                                                <p class="mt-1 text-xs text-[#66788A]">
                                                    {{ $attendance->professor->name }}
                                                </p>
                                            @endif

                                        </div>


                                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">

                                            <div class="rounded-xl border border-[#E1E7EC] bg-[#FAFBFC] p-4 md:col-span-2">

                                                <p class="profile-label">
                                                    Eixo trabalhado
                                                </p>

                                                <p class="profile-value">
                                                    {{ $attendance->educational_axis ?: 'Não informado' }}
                                                </p>

                                            </div>


                                            @if (!empty($attendance->skills))

                                                <div class="rounded-xl border border-[#E1E7EC] p-4">

                                                    <p class="profile-label">
                                                        Habilidades trabalhadas
                                                    </p>

                                                    <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->skills }}
                                                    </p>

                                                </div>

                                            @endif


                                            @if (!empty($attendance->skills_evolution))

                                                <div class="rounded-xl border border-[#DCEBE2] bg-[#EDF5F0] p-4">

                                                    <p class="profile-label">
                                                        Evolução das habilidades
                                                    </p>

                                                    <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->skills_evolution }}
                                                    </p>

                                                </div>

                                            @endif


                                            @if (!empty($attendance->advances))

                                                <div class="rounded-xl border border-[#DCEBE2] bg-[#F8FAF9] p-4">

                                                    <p class="profile-label">
                                                        Avanços observados
                                                    </p>

                                                    <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->advances }}
                                                    </p>

                                                </div>

                                            @endif


                                            @if (!empty($attendance->difficulties))

                                                <div class="rounded-xl border border-[#F0DFDF] bg-[#FFF9F9] p-4">

                                                    <p class="profile-label">
                                                        Dificuldades observadas
                                                    </p>

                                                    <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                        {{ $attendance->difficulties }}
                                                    </p>

                                                </div>

                                            @endif


                                            <div class="md:col-span-2 flex flex-wrap gap-2 pt-1">

                                                @if (!is_null($attendance->advances_level))

                                                    <span class="inline-flex items-center rounded-full border border-[#DCEBE2] bg-[#EDF5F0] px-3 py-1.5 text-xs font-semibold text-[#2F684A]">
                                                        Nível de avanços: {{ $attendance->advances_level }}
                                                    </span>

                                                @endif

                                                @if (!is_null($attendance->difficulties_level))

                                                    <span class="inline-flex items-center rounded-full border border-[#E1E7EC] bg-[#F4F6F8] px-3 py-1.5 text-xs font-semibold text-[#66788A]">
                                                        Nível de dificuldades: {{ $attendance->difficulties_level }}
                                                    </span>

                                                @endif

                                                @if ($attendance->activity_not_performed)

                                                    <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">
                                                        Atividade não realizada
                                                    </span>

                                                @else

                                                    <span class="inline-flex items-center rounded-full border border-[#DCEBE2] bg-[#EDF5F0] px-3 py-1.5 text-xs font-semibold text-[#2F684A]">
                                                        Atividade realizada
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </article>

                            @endforeach

                        </div>

                    </section>


                    {{-- =====================================================
                         EIXOS MAIS TRABALHADOS
                         ===================================================== --}}

                    @if ($evolutionAxes->count())

                        <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden mb-6">

                            <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">

                                <p class="text-sm font-semibold text-[#3B7D5A] mb-1">
                                    Foco do acompanhamento
                                </p>

                                <h2 class="text-xl md:text-2xl font-bold text-[#102A43]">
                                    Eixos mais trabalhados
                                </h2>

                            </div>


                            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                @foreach ($evolutionAxes as $axis => $count)

                                    <div class="rounded-xl border border-[#E1E7EC] bg-[#FAFBFC] p-4">

                                        <p class="text-sm font-semibold text-[#102A43]">
                                            {{ $axis }}
                                        </p>

                                        <p class="mt-1 text-xs text-[#66788A]">
                                            {{ $count }} registro(s)
                                        </p>

                                    </div>

                                @endforeach

                            </div>

                        </section>

                    @endif

                @endif


                {{-- =====================================================
                     RELATÓRIOS PEDAGÓGICOS
                     ===================================================== --}}

                <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden mb-6">

                    <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">

                        <p class="text-sm font-semibold text-[#3B7D5A] mb-1">
                            Registros complementares
                        </p>

                        <h2 class="text-xl md:text-2xl font-bold text-[#102A43]">
                            Relatórios pedagógicos
                        </h2>

                        <p class="mt-1 text-sm text-[#66788A]">
                            Os relatórios continuam disponíveis aqui como complemento da análise, e não como a própria análise de evolução.
                        </p>

                    </div>


                    @if ($pedagogicals->count())

                        <div class="divide-y divide-[#E1E7EC]">

                            @foreach ($pedagogicals as $pedagogical)

                                <article class="px-6 md:px-8 py-6">

                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                        <div class="min-w-0 flex-1">

                                            <div class="flex flex-wrap items-center gap-3">

                                                <h3 class="text-base md:text-lg font-bold text-[#102A43]">
                                                    Registro pedagógico
                                                </h3>

                                                @if ($pedagogical->date_pedagogical)

                                                    <span class="inline-flex items-center rounded-full bg-[#EDF5F0] border border-[#DCEBE2] px-3 py-1 text-xs font-semibold text-[#2F684A]">

                                                        {{ \Carbon\Carbon::parse($pedagogical->date_pedagogical)->format('d/m/Y') }}

                                                    </span>

                                                @endif

                                            </div>


                                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">

                                                <div class="md:col-span-2 rounded-xl border border-[#E1E7EC] bg-[#FAFBFC] p-4">

                                                    <p class="profile-label">
                                                        Eixo pedagógico
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ $pedagogical->educational_axis ?: 'Não informado' }}
                                                    </p>

                                                </div>


                                                <div>

                                                    <p class="profile-label">
                                                        Professor responsável
                                                    </p>

                                                    <p class="profile-value">
                                                        {{ optional($pedagogical->professor)->name ?: 'Não informado' }}
                                                    </p>

                                                </div>


                                                @if (!empty($pedagogical->advances))

                                                    <div>

                                                        <p class="profile-label">
                                                            Avanços
                                                        </p>

                                                        <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                            {{ $pedagogical->advances }}
                                                        </p>

                                                    </div>

                                                @endif


                                                @if (!empty($pedagogical->difficulties))

                                                    <div>

                                                        <p class="profile-label">
                                                            Dificuldades
                                                        </p>

                                                        <p class="mt-2 text-sm leading-6 text-[#334E68] whitespace-pre-line">
                                                            {{ $pedagogical->difficulties }}
                                                        </p>

                                                    </div>

                                                @endif

                                            </div>

                                        </div>


                                        @if (Route::has('educational.show'))

                                            <div class="flex-shrink-0">

                                                <a
                                                    href="{{ route('educational.show', $pedagogical->id) }}"
                                                    class="inline-flex items-center justify-center rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-sm font-semibold text-[#334E68] hover:bg-[#F8FAF9] transition"
                                                >
                                                    Ver detalhes
                                                </a>

                                            </div>

                                        @endif

                                    </div>

                                </article>

                            @endforeach

                        </div>

                    @else

                        <div class="px-6 md:px-8 py-10 text-center">

                            <p class="text-sm text-[#66788A]">
                                Nenhum relatório pedagógico complementar foi registrado para este estudante.
                            </p>

                        </div>

                    @endif

                </section>


            {{-- =====================================================
                 ABA PERFIL
                 ===================================================== --}}

            @else


                <div
                    id="perfil"
                    class="grid grid-cols-1 xl:grid-cols-3 gap-6"
                >


                    {{-- =================================================
                         COLUNA PRINCIPAL
                         ================================================= --}}

                    <div class="xl:col-span-2 space-y-6">


                        {{-- INFORMAÇÕES PESSOAIS --}}

                        <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                            <div class="px-6 md:px-8 py-5 border-b border-[#E1E7EC]">

                                <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                    1. Informações pessoais
                                </h2>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    Dados pessoais registrados no cadastro do estudante.
                                </p>

                            </div>


                            <div class="px-6 md:px-8 py-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">


                                <div>

                                    <p class="profile-label">
                                        Nome completo
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->name ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Nome social
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->name_social ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Data de nascimento
                                    </p>

                                    <p class="profile-value">
                                        {{ $dateOfBirth ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Idade
                                    </p>

                                    <p class="profile-value">
                                        {{ $studentAge }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        CPF
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->cpf ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Diagnóstico
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->diagnostic ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div class="md:col-span-2">

                                    <p class="profile-label">
                                        Nome da mãe
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->name_mother ?: 'Não informado' }}
                                    </p>

                                </div>

                            </div>

                        </section>


                        {{-- INFORMAÇÕES ESCOLARES --}}

                        <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                            <div class="px-6 md:px-8 py-5 border-b border-[#E1E7EC]">

                                <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                    2. Informações escolares
                                </h2>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    Dados relacionados à escola e à rotina escolar do estudante.
                                </p>

                            </div>


                            <div class="px-6 md:px-8 py-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">


                                <div>

                                    <p class="profile-label">
                                        Escola
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->school ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Série
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->grade_school ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Turno na escola
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->turn_school ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Turno na APAE
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->turn_apae ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Serviço realizado na APAE
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->service ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Dias de atendimento
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->class_apae ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        ID do estudante
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->student_id ?: 'Não informado' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="profile-label">
                                        Nº do SIGE
                                    </p>

                                    <p class="profile-value">
                                        {{ $student->sige ?: 'Não informado' }}
                                    </p>

                                </div>

                            </div>

                        </section>


                        {{-- PROFESSORES --}}

                        <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                            <div class="px-6 md:px-8 py-5 border-b border-[#E1E7EC]">

                                <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                    3. Professores responsáveis
                                </h2>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    Profissionais vinculados ao atendimento deste estudante.
                                </p>

                            </div>


                            <div class="px-6 md:px-8 py-6">


                                @if (count($professorNames))


                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">


                                        @foreach ($professorNames as $professorName)


                                            <div class="flex items-center gap-3 rounded-xl border border-[#E1E7EC] bg-[#F8FAF9] px-4 py-3">


                                                <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#EDF5F0] text-[#3B7D5A]">

                                                    <span class="font-bold">

                                                        {{ mb_strtoupper(
                                                            mb_substr(
                                                                $professorName,
                                                                0,
                                                                1
                                                            )
                                                        ) }}

                                                    </span>

                                                </div>


                                                <span class="text-sm font-semibold text-[#334E68]">
                                                    {{ $professorName }}
                                                </span>

                                            </div>


                                        @endforeach

                                    </div>


                                @else


                                    <div class="rounded-xl border border-dashed border-[#D7DEE5] bg-[#F8FAF9] px-5 py-6 text-center">

                                        <p class="text-sm text-[#66788A]">
                                            Nenhum professor responsável informado.
                                        </p>

                                    </div>


                                @endif

                            </div>

                        </section>


                        {{-- ARQUIVAMENTO --}}

                        @if ($isArchived)


                            <section class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">


                                <div class="px-6 md:px-8 py-5 border-b border-gray-200">

                                    <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                        4. Arquivamento
                                    </h2>

                                </div>


                                <div class="px-6 md:px-8 py-6">


                                    <p class="profile-label">
                                        Motivo do arquivamento
                                    </p>


                                    <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-5 py-4">

                                        <p class="text-sm leading-6 text-gray-700 whitespace-pre-line">
                                            {{ $student->archiving_justify ?: 'Nenhum motivo informado.' }}
                                        </p>

                                    </div>

                                </div>

                            </section>


                        @endif


                    </div>


                    {{-- =================================================
                         COLUNA LATERAL
                         ================================================= --}}

                    <div class="space-y-6">


                        {{-- SITUAÇÃO --}}

                        <section class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                            <div class="px-5 py-4 border-b border-[#E1E7EC]">

                                <h2 class="text-base font-bold text-[#102A43]">
                                    Situação do estudante
                                </h2>

                            </div>


                            <div class="p-5">


                                <div
                                    class="rounded-xl border p-4
                                    {{
                                        $isArchived
                                            ? 'bg-gray-50 border-gray-200'
                                            : 'bg-[#EDF5F0] border-[#DCEBE2]'
                                    }}"
                                >

                                    <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                                        Cadastro
                                    </p>

                                    <p
                                        class="mt-1 text-lg font-bold
                                        {{
                                            $isArchived
                                                ? 'text-gray-700'
                                                : 'text-[#2F684A]'
                                        }}"
                                    >
                                        {{ $statusLabel }}
                                    </p>

                                </div>


                                <div class="mt-4 space-y-4">


                                    <div>

                                        <p class="profile-label">
                                            Diagnóstico
                                        </p>

                                        <p class="profile-value">
                                            {{ $student->diagnostic ?: 'Não informado' }}
                                        </p>

                                    </div>


                                    <div>

                                        <p class="profile-label">
                                            Serviço
                                        </p>

                                        <p class="profile-value">
                                            {{ $student->service ?: 'Não informado' }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </section>


                        {{-- IDENTIFICAÇÃO --}}

                        <section class="bg-[#102A43] rounded-2xl shadow-sm overflow-hidden">


                            <div class="p-5">


                                <p class="text-xs font-semibold uppercase tracking-wide text-white/60">
                                    Identificação
                                </p>


                                <p class="mt-2 text-lg font-bold text-white">
                                    {{ $student->name }}
                                </p>


                                <div class="mt-4 space-y-2 text-sm text-white/80">


                                    <p>

                                        <strong class="text-white">
                                            ID:
                                        </strong>

                                        {{ $student->student_id ?: 'Não informado' }}

                                    </p>


                                    <p>

                                        <strong class="text-white">
                                            SIGE:
                                        </strong>

                                        {{ $student->sige ?: 'Não informado' }}

                                    </p>


                                </div>

                            </div>

                        </section>

                    </div>

                </div>


            @endif


        </div>

    </div>


    {{-- =========================================================
         ESTILOS
         ========================================================= --}}

    <style>

        .profile-label {

            color: #66788A;

            font-size: 11px;

            line-height: 1.2;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .06em;

        }


        .profile-value {

            margin-top: 4px;

            color: #334E68;

            font-size: 15px;

            line-height: 1.5;

            font-weight: 500;

        }


        .profile-tab {

            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 56px;

            padding: 0 20px;

            color: #66788A;

            font-size: 14px;

            font-weight: 600;

            text-decoration: none;

            transition:
                color .18s ease,
                background-color .18s ease;

        }


        .profile-tab:hover {

            color: #3B7D5A;

            background-color: #F8FAF9;

        }


        .profile-tab.active {

            color: #2F684A;

        }


        .profile-tab.active::after {

            content: "";

            position: absolute;

            left: 18px;

            right: 18px;

            bottom: 0;

            height: 2px;

            background-color: #3B7D5A;

            border-radius: 999px 999px 0 0;

        }


        .profile-tab-disabled {

            cursor: not-allowed;

            opacity: .55;

            background: transparent;

            border: 0;

            font-family: inherit;

        }


        .profile-tab-disabled:hover {

            color: #66788A;

            background: transparent;

        }


        /* =====================================================
           BOTÕES DE MÊS
           ===================================================== */

        .frequency-month-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 38px;

            height: 38px;

            border-radius: 10px;

            border: 1px solid #D7DEE5;

            background: #FFFFFF;

            color: #334E68;

            font-size: 24px;

            line-height: 1;

            text-decoration: none;

            transition:
                background-color .18s ease,
                border-color .18s ease,
                color .18s ease;

        }


        .frequency-month-btn:hover {

            background: #EDF5F0;

            border-color: #CFE0D6;

            color: #2F684A;

        }


        /* =====================================================
           STATUS DA FREQUÊNCIA
           ===================================================== */

        .frequency-status {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            width: 30px;

            height: 30px;

            border-radius: 9999px;

            font-size: 14px;

            font-weight: 800;

        }


        .frequency-present {

            background: #EDF5F0;

            color: #2F684A;

        }


        .frequency-absent {

            background: #FFF0F0;

            color: #B45353;

        }


        .frequency-empty {

            background: #F4F6F8;

            color: #8A9AAB;

        }


        @media (max-width: 640px) {

            .profile-tab {

                min-height: 50px;

                padding: 0 14px;

                font-size: 13px;

            }


            .profile-tab.active::after {

                left: 12px;

                right: 12px;

            }

        }

    </style>

</x-app-layout>