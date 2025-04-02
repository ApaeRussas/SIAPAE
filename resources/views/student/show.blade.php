<x-app-layout>

    @php
        $state_student = '';
        if (isset($isArchived)) {
            $state_student = ' (Arquivado)';
        }
    @endphp

    <x-table-show 
        :title="'Informações do Aluno(a) ' . $student->name . $state_student" 
        :elementShow="$student"
        :labelsVariables="[
        ['Nome do Aluno', 'name', 'text'],
        ['Data de Nascimento', 'date_of_birth', 'date'],
        ['Idade', 'age', 'text'],
        ['ID do Aluno', 'student_id', 'text'],
        ['Dias de Atendimento na APAE', 'class_apae', 'select'],
        ['Turno na Apae', 'turn_apae', 'select'],
        ['Escola', 'school', 'text'],
        ['Nº do SIGE do Aluno', 'class_school', 'text'],
        ['Turno na Escola', 'turn_school', 'select'],
        ['Série na Escola', 'grade_school', 'text'],
        ['Diagnóstico', 'diagnostic', 'text'],
        ['Serviços do Aluno na Apae', 'service', 'text'],
        ]" 
        additional 
        divisionLateral 
        quantLateral="6" 
        notEditDelete
        actionRoute="student" 
        :isArchived="$isArchived">

        <hr class="my-5 border-gray-300 dark:border-gray-500" />

        <h1 class="text-xl font-bold leading-tight -mb-5">
            Registros de Atendimento do(a) {{$student->name}}
        </h1>

        <x-table 
            title="Atendimento" 
            :headers="['Date', 'Advances', 'Difficulties', 'Assinatura']" 
            :rows="$attendances"
            :variables_DB="['date', 'advances', 'difficulties', 'signature']" 
            iteration="false" 
            withSearchDateRange
            :element="$student" 
            searchRoute="student.show" 
            notButtonAdd 
            :range="$date_range" 
            withShow
            actionRoute="attendance"
            numberPages="5"
            inTableShow>
        </x-table>
        
        @if (isset($scrollBack))
            {{-- Alvo para rolagem --}}
            <div class="scroll-target"></div>
        @endif

        <hr class="my-4 border-gray-300 dark:border-gray-500" />

        <h1 class="text-xl font-bold leading-tight -mb-5">
            Lista de Frequência do(a) {{$student->name}}
        </h1>

        <x-table 
            title="Frequência"  
            :headers="array_merge($days, ['Faltas'])" 
            headersSmall 
            :rows="$frequency" 
            onlyHead
            headFrequency
            withSearchFrequency 
            searchFrequencyStudent
            :student="$student"
            :monthYear="$monthYear"
            iteration="false"
            notPaginate
            inTableShow>
        
            @if (isset($frequency))
            <tr>

                @for ($day = 1; $day <= $numberDaysInMonth; $day++)
                    @php 
                        list($month, $year) = explode('/', $monthYear);
                        $date = sprintf("%04d-%02d-%02d", $year, $month, $day);     
                        $isNonClickable = in_array($date, $frequency->nonClickableDays);
                        $isWeekend = in_array($date, $frequency->weekends);
                    @endphp

                    <td class="border border-gray-300 dark:border-gray-600 text-center">
                        @if (!$isNonClickable)
                        <x-button
                            class="btn-toggle {{ $frequency->$day === true ? 'success bg-green-500 hover:bg-green-600' : ($frequency->$day === false ? 'danger bg-red-600 hover:bg-red-700 dark:bg-red-700' : 'indifferent bg-gray-400 hover:bg-gray-500 dark:bg-gray-500') }}"
                            variant="{{ $frequency->$day === true ? 'success' : ($frequency->$day === false ? 'danger' : 'indifferent') }}"  
                            size="hyper-sm"
                            >
                            <i class="fas {{ $frequency->$day === true ? 'fa-check -mx-0.5' : ($frequency->$day === false ? 'fa-times' : 'fa-minus m-minus') }}"></i>
                        </x-button>
                        @elseif ($isWeekend) 
                            <span class="text-gray-600 dark:text-gray-400 text-sm">
                                X
                            </span>
                        @else
                            <hr class="mx-1 border-gray-600 dark:border-gray-400"> 
                        @endif
                    </td>
                @endfor

                <td
                    class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-gray-800 dark:text-gray-300">
                    <h3 class="">
                        {{ $frequency->countAbsences }}
                    </h3>
                </td>

            </tr>
            @else
            <tr class="text-center">
                <td class="border border-gray-300 dark:border-gray-600 p-3 font-normal dark:text-gray-300"
                    colspan="{{ (int) $numberDaysInMonth + 3 }}">
                    Nenhum registro encontrado.
                </td>
            </tr>
            @endif

        </x-table>

        <div class="flex items-center justify-between">
            <div>
                @if (isset($medHistory))
                    <x-button href="{{route('anamnesis.show', $medHistory->id)}}" variant="blue">
                        <p class="dark:text-gray-200 px-2">
                            Ir para Anamnese
                        </p>
                    </x-button>
                @else
                    <p class="text-gray-800 dark:text-gray-200">
                        Aluno não possui uma Anamnese
                    </p>
                @endif
            </div>

            <div class="flex gap-2">
                <x-button href="{{route('student.edit', $student->id)}}" class="flex sm:hidden" title="Editar {{ $student->name }}" variant="edit" size="sm">
                    <x-icons.edit />
                </x-button>

                <x-button href="{{route('student.edit', $student->id)}}" class="hidden sm:flex" title="Editar {{ $student->name }}" variant="warning"
                    title="Editar {{$student->name}}">
                    <p class="text-gray-900 px-2">
                        {{ __('Editar') }}
                    </p>
                </x-button>

                @if(!isset($isArchived))
                    <form method="POST" action="{{ route('student.archive', $student->id) }}" accept-charset="UTF-8"
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
        </div>


    </x-table-show>

</x-app-layout>

<script>
    function scrollToSelector() {
        const element = document.querySelector(".scroll-target");
        element.scrollIntoView({ behavior: 'smooth', });
    }
    // Verificar a variável do Blade e rolar para o seletor se necessário 
    @if(isset($scrollBack))
        document.addEventListener('DOMContentLoaded', function () {
            scrollToSelector();
        });
    @endif
</script>
