<x-app-layout>

    <x-table-show 
        :title="'Atendimento de data ' . ' - ' . $attendance->date" 
        :elementShow="$attendance" 
        :labelsVariables="[
            ['Nome do aluno', 'student.name', 'select'],
            ['Assinatura do Professor Responsável', 'professor.name', 'text'],
            ['Eixo educacional trabalhado', 'educational_axis', 'textarea'],
            ['Avanços', 'advances', 'textarea'],
            ['Dificuldades', 'difficulties', 'select'],
        ]" 
        actionRoute="attendance"
        additional
        notEditDelete>

        <div class="flex gap-2 items-center justify-between mt-5">
            <div>
                <x-button href="{{route('student.show', $attendance->student->id)}}" variant="blue">
                    <p class="flex dark:text-gray-200 px-2">
                        Ir para Aluno <span class="hidden sm:flex ml-1"> {{ \Illuminate\Support\Str::limit($attendance->student->name, 15)}}</span>
                    </p>
                </x-button>
            </div>

            <div class="flex gap-2">
                <x-button href="{{route('attendance.edit', $attendance->id)}}" class="flex sm:hidden" title="Editar Atendimento" variant="edit" size="sm">
                    <x-icons.edit />
                </x-button>

                <x-button href="{{route('attendance.edit', $attendance->id)}}" class="hidden sm:flex" title="Editar Atendimento" variant="warning"
                    title="Editar {{$attendance->student->name}}">
                    <p class="text-gray-900 px-2">
                        {{ __('Editar') }}
                    </p>
                </x-button>
    
                <form method="POST" action="{{ route('attendance.destroy', $attendance->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
    
                    <x-button variant="pdf-trash" title="Deletar Atendimento" size="sm" class="flex sm:hidden"
                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                        <x-icons.trash />
                    </x-button>

                    <x-button type="submit" variant="danger" title="Deletar {{$attendance->student->name}}"  class="hidden sm:flex"
                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">

                        <div class="text-gray-100 dark:text-gray-200 px-2">
                            {{ __('Deletar') }}
                        </div>
                    </x-button>
                </form>
            </div>
        </div>

    </x-table-show>

</x-app-layout>
