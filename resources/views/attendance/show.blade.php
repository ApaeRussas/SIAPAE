```blade
<x-app-layout :notRegularSidebar="$notRegularSidebar" :element="$element">

    @php
        if(isset($notRegularSidebar)) {
            $parameter = '?notRegularSidebar=1';
        } else {
            $parameter = null;
        }

        $activityNotPerformed = (bool) $attendance->activity_not_performed;
        $hasAdvances = !empty($attendance->advances);
        $hasDifficulties = !empty($attendance->difficulties);
    @endphp

    <x-table-show
        :title="'Atendimento de data ' . ' - ' . $attendance->date"
        :elementShow="$attendance"
        :labelsVariables="[
            ['Nome do aluno', 'student.name', 'select'],
            ['Assinatura do Professor Responsável', 'professor.name', 'text'],
            ['Eixo educacional trabalhado', 'educational_axis', 'textarea'],
            ['Descrição da atividade realizada', 'activity_description', 'textarea'],
            ['Avanços', 'advances', 'textarea'],
            ['Dificuldades', 'difficulties', 'textarea'],
        ]"
        actionRoute="attendance"
        additional
        notRegularSidebar
        notEditDelete>

        <div class="mt-5 space-y-5">

            {{-- Situação da atividade --}}
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Atividade realizada
                </p>

                @if ($activityNotPerformed)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                        Não realizou a atividade
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                        Sim
                    </span>
                @endif
            </div>

            {{-- Avanços --}}
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Houve avanços?
                </p>

                @if ($hasAdvances)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700 mb-3">
                        Sim
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700 mb-3">
                        Não
                    </span>
                @endif

                @if ($hasAdvances)
                    <div class="mt-2 text-gray-700 dark:text-gray-300 whitespace-pre-line">
                        {{ $attendance->advances }}
                    </div>
                @endif
            </div>

            {{-- Dificuldades --}}
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Houve dificuldades?
                </p>

                @if ($hasDifficulties)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700 mb-3">
                        Sim
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700 mb-3">
                        Não
                    </span>
                @endif

                @if ($hasDifficulties)
                    <div class="mt-2 text-gray-700 dark:text-gray-300 whitespace-pre-line">
                        {{ $attendance->difficulties }}
                    </div>
                @endif
            </div>

            {{-- Botões --}}
            <div class="flex gap-2 items-center justify-between pt-2">

                <div>
                    <x-button
                        href="{{ route('student.show', $attendance->student->id) }}"
                        variant="blue">
                        <p class="flex dark:text-gray-200 px-2">
                            Ir para Aluno
                            <span class="hidden sm:flex ml-1">
                                {{ \Illuminate\Support\Str::limit($attendance->student->name, 15) }}
                            </span>
                        </p>
                    </x-button>
                </div>

                <div class="flex gap-2">

                    {{-- Editar - mobile --}}
                    <x-button
                        href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                        class="flex sm:hidden"
                        title="Editar Atendimento"
                        variant="edit"
                        size="sm">
                        <x-icons.edit />
                    </x-button>

                    {{-- Editar - desktop --}}
                    <x-button
                        href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                        class="hidden sm:flex"
                        title="Editar Atendimento"
                        variant="warning">
                        <p class="text-gray-900 px-2">
                            {{ __('Editar') }}
                        </p>
                    </x-button>

                    {{-- Deletar --}}
                    @if ($attendance->student->state_student === 'alive')
                        <form
                            method="POST"
                            action="{{ route('attendance.destroy', $attendance->id) . $parameter }}"
                            accept-charset="UTF-8"
                            style="display:inline">

                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                            {{-- Mobile --}}
                            <x-button
                                variant="pdf-trash"
                                title="Deletar Atendimento"
                                size="sm"
                                class="flex sm:hidden"
                                onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                                <x-icons.trash />
                            </x-button>

                            {{-- Desktop --}}
                            <x-button
                                type="submit"
                                variant="danger"
                                title="Deletar Atendimento"
                                class="hidden sm:flex"
                                onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">

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
```
