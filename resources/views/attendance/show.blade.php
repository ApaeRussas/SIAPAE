
<x-app-layout :notRegularSidebar="$notRegularSidebar" :element="$element">

    @php
        if (isset($notRegularSidebar)) {
            $parameter = '?notRegularSidebar=1';
        } else {
            $parameter = null;
        }

        $activityNotPerformed =
            (bool) $attendance->activity_not_performed;

        $hasAdvances =
            !empty($attendance->advances) ||
            !is_null($attendance->advances_level);

        $hasDifficulties =
            !empty($attendance->difficulties) ||
            !is_null($attendance->difficulties_level);

        $advancesLevels = [
            1 => 'Quase nada',
            2 => 'Muito pouco',
            3 => 'Pouco',
            4 => 'Bom',
            5 => 'Excelente',
        ];

        $difficultiesLevels = [
            1 => 'Quase nada',
            2 => 'Muito pouco',
            3 => 'Pouco',
            4 => 'Bom',
            5 => 'Excelente',
        ];
    @endphp


    <x-table-show
        :title="'Atendimento de data ' . ' - ' . $attendance->date"
        :elementShow="$attendance"
        :labelsVariables="[
            ['Nome do aluno', 'student.name', 'select'],
            ['Assinatura do Professor Responsável', 'professor.name', 'text'],
            ['Eixo educacional trabalhado', 'educational_axis', 'textarea'],
            ['Habilidades', 'skills', 'textarea'],
            ['Evolução das habilidades', 'skills_evolution', 'textarea'],
            ['Descrição da atividade realizada', 'activity_description', 'textarea'],
        ]"
        actionRoute="attendance"
        additional
        notRegularSidebar
        notEditDelete
    >

        <div class="mt-5 space-y-5">


            {{-- =====================================================
                 SITUAÇÃO DA ATIVIDADE
                 ===================================================== --}}

            <div
                class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4"
            >

                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Atividade realizada
                </p>

                @if ($activityNotPerformed)

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700"
                    >
                        Não realizou a atividade
                    </span>

                @else

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700"
                    >
                        Sim
                    </span>

                @endif

            </div>


            {{-- =====================================================
                 AVANÇOS
                 ===================================================== --}}

            <div
                class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4"
            >

                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Houve avanços?
                </p>


                @if ($hasAdvances)

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700 mb-4"
                    >
                        Sim
                    </span>


                    {{-- DESCRIÇÃO --}}
                    @if (!empty($attendance->advances))

                        <div class="mb-4">

                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">
                                Descrição dos avanços
                            </p>

                            <div
                                class="text-gray-700 dark:text-gray-300 whitespace-pre-line"
                            >
                                {{ $attendance->advances }}
                            </div>

                        </div>

                    @endif


                    {{-- NÍVEL --}}
                    @if (!is_null($attendance->advances_level))

                        <div>

                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">
                                Nível do avanço
                            </p>

                            <div class="flex flex-wrap items-center gap-2">

                                <span
                                    class="inline-flex items-center justify-center min-w-[38px] h-[38px] rounded-lg bg-[#3B7D5A] text-white font-bold"
                                >
                                    {{ $attendance->advances_level }}
                                </span>

                                <span class="text-sm font-medium text-[#334E68]">
                                    {{ $advancesLevels[$attendance->advances_level] ?? 'Nível não informado' }}
                                </span>

                            </div>

                        </div>

                    @endif

                @else

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700 mb-2"
                    >
                        Não
                    </span>

                @endif

            </div>


            {{-- =====================================================
                 DIFICULDADES
                 ===================================================== --}}

            <div
                class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4"
            >

                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Houve dificuldades?
                </p>


                @if ($hasDifficulties)

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700 mb-4"
                    >
                        Sim
                    </span>


                    {{-- DESCRIÇÃO --}}
                    @if (!empty($attendance->difficulties))

                        <div class="mb-4">

                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">
                                Descrição das dificuldades
                            </p>

                            <div
                                class="text-gray-700 dark:text-gray-300 whitespace-pre-line"
                            >
                                {{ $attendance->difficulties }}
                            </div>

                        </div>

                    @endif


                    {{-- NÍVEL --}}
                    @if (!is_null($attendance->difficulties_level))

                        <div>

                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">
                                Nível das dificuldades
                            </p>

                            <div class="flex flex-wrap items-center gap-2">

                                <span
                                    class="inline-flex items-center justify-center min-w-[38px] h-[38px] rounded-lg bg-[#3B7D5A] text-white font-bold"
                                >
                                    {{ $attendance->difficulties_level }}
                                </span>

                                <span class="text-sm font-medium text-[#334E68]">
                                    {{ $difficultiesLevels[$attendance->difficulties_level] ?? 'Nível não informado' }}
                                </span>

                            </div>

                        </div>

                    @endif

                @else

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700 mb-2"
                    >
                        Não
                    </span>

                @endif

            </div>


            {{-- =====================================================
                 BOTÕES
                 ===================================================== --}}

            <div class="flex gap-2 items-center justify-between pt-2">

                <div>

                    <x-button
                        href="{{ route('student.show', $attendance->student->id) }}"
                        variant="blue"
                    >

                        <p class="flex dark:text-gray-200 px-2">

                            Ir para Aluno

                            <span class="hidden sm:flex ml-1">

                                {{ \Illuminate\Support\Str::limit(
                                    $attendance->student->name,
                                    15
                                ) }}

                            </span>

                        </p>

                    </x-button>

                </div>


                <div class="flex gap-2">


                    {{-- =================================================
                         EDITAR - MOBILE
                         ================================================= --}}

                    <x-button
                        href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                        class="flex sm:hidden"
                        title="Editar Atendimento"
                        variant="edit"
                        size="sm"
                    >

                        <x-icons.edit />

                    </x-button>


                    {{-- =================================================
                         EDITAR - DESKTOP
                         ================================================= --}}

                    <x-button
                        href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                        class="hidden sm:flex"
                        title="Editar Atendimento"
                        variant="warning"
                    >

                        <p class="text-gray-900 px-2">
                            {{ __('Editar') }}
                        </p>

                    </x-button>


                    {{-- =================================================
                         DELETAR
                         ================================================= --}}

                    @if ($attendance->student->state_student === 'alive')

                        <form
                            method="POST"
                            action="{{ route('attendance.destroy', $attendance->id) . $parameter }}"
                            accept-charset="UTF-8"
                            style="display:inline"
                        >

                            {{ method_field('DELETE') }}

                            {{ csrf_field() }}


                            {{-- MOBILE --}}

                            <x-button
                                variant="pdf-trash"
                                title="Deletar Atendimento"
                                size="sm"
                                class="flex sm:hidden"
                                onclick="warningConfirm(
                                    event,
                                    'Essa ação é irreversível!',
                                    'warning',
                                    'Deletar'
                                )"
                            >

                                <x-icons.trash />

                            </x-button>


                            {{-- DESKTOP --}}

                            <x-button
                                type="submit"
                                variant="danger"
                                title="Deletar Atendimento"
                                class="hidden sm:flex"
                                onclick="warningConfirm(
                                    event,
                                    'Essa ação é irreversível!',
                                    'warning',
                                    'Deletar'
                                )"
                            >

                                <div class="text-gray-100 dark:text-gray-200 px-2">

                                    {{ __('Deletar') }}

                                </div>

                            </x-button>

                        </form>

                    @endif

                </div>

            </div>


        </div>

    </x-table-show>

</x-app-layout>
