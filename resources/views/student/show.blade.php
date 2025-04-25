<x-app-layout notRegularSidebar :element="$student">

    @php
        $titleBase = 'Informações do Aluno(a) ';
        $studentName = \Illuminate\Support\Str::limit($student->name, 15);
        $state_student = '';
        if ($student->state_student === 'archived') {
            $state_student = ' (Arquivado)';
        }
        $title = $titleBase . $studentName . $state_student;
    
        $parameter = '?notRegularSidebar=1';
    @endphp

    <x-table-show 
        :title="$title" 
        :elementShow="$student"
        :labelsVariables="[
        ['Nome do Aluno', 'name', 'text'],
        ['CPF do Aluno', 'cpf', 'text'],
        ['Data de Nascimento', 'date_of_birth', 'date'],
        ['Idade', 'age', 'text'],
        ['Diagnóstico', 'diagnostic', 'text'],
        ['Serviços do Aluno na Apae', 'service', 'text'],
        ['Dias de Atendimento na APAE', 'class_apae', 'select'],
        ['Professores responsáveis pelo Atendimento', 'professor', 'array_pivot'],
        ['Nome da Mãe do Aluno', 'name_mother', 'text'],
        ['Turno na Apae', 'turn_apae', 'select'],
        ['Escola', 'school', 'text'],
        ['ID do Aluno', 'student_id', 'text'],
        ['Nº do SIGE do Aluno', 'sige', 'text'],
        ['Turno na Escola', 'turn_school', 'select'],
        ['Série na Escola', 'grade_school', 'text'],
        ]" 
        additional 
        divisionLateral 
        quantLateral="8" 
        notEditDelete
        actionRoute="student" 
        :isArchived="$isArchived">

        @if ($student->state_student === 'archived')
            <x-anamnesis.label isShow>
                Motivo do Arquivamento:
            </x-anamnesis.label>
            <x-form.textarea disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base">
                {{ $student->archiving_justify }}
            </x-form.textarea>
        @endif

        <div class="flex items-center justify-between mt-4 sm:mt-6">
                <x-button href="{{route('student.edit', $student->id) . $parameter}}" class="flex sm:hidden" title="Editar {{ $student->name }}" variant="edit" size="sm">
                    <x-icons.edit />
                </x-button>

                <x-button href="{{route('student.edit', $student->id) . $parameter}}" class="hidden sm:flex" title="Editar {{ $student->name }}" variant="warning"
                    title="Editar {{$student->name}}">
                    <p class="text-gray-900 px-2">
                        {{ __('Editar') }}
                    </p>
                </x-button>

                @if(!isset($isArchived))
                    <form method="POST" action="{{ route('student.archive', $student->id)}}" accept-charset="UTF-8"
                        style="display:inline" class="flex">
                        {{ csrf_field() }}

                        <x-button variant="edit" class="flex sm:hidden" title="Arquivar {{$student->name}}" size="sm"
                            onclick="warningConfirm(event, 'Essa ação irá arquivar o item selecionado!', 'warning', 'Arquivar')">
                            <x-icons.archive />
                        </x-button>

                        <x-button type="submit" class="hidden sm:flex" variant="primary" title="Arquivar {{$student->name}}"
                            onclick="warningConfirm(event, 'Essa ação irá arquivar o item selecionado!', 'warning', 'Arquivar')">
                            <div class="text-gray-100 px-2">
                                {{ __('Arquivar') }}
                            </div>
                        </x-button>
                    </form>
                @else
                    <form action="{{route('student.restore', $student->id)}}" method="POST"
                        onclick="warningConfirm(event, 'Quer restaurar esse Aluno?', 'question', 'Restaurar')">
                        {{ csrf_field() }}
                        <x-button title="Restaurar {{$student->name}}" variant="restore" size="sm" class="flex sm:hidden">
                            <x-icons.restore />
                        </x-button>

                        <x-button title="Restaurar {{$student->name}}" variant="blue" class="hidden sm:flex">
                         <span class="text-gray-100 dark:text-gray-200">Restaurar</span>
                        </x-button>
                    </form>
                @endif
        </div>

    </x-table-show>

</x-app-layout>