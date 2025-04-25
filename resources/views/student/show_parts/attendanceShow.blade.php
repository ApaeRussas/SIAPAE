<x-app-layout notRegularSidebar :element="$student">
    
    <x-slot name="header">
        <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <div class="flex items-center gap-x-1">
                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                    Registros de Atendimento do(a) {{ \Illuminate\Support\Str::limit($student->name ?? '------', 15) }}
                </h2>
            </div>
        </div>
    </x-slot>

    <x-table 
        title="Atendimento" 
        :headers="['Date', 'Advances', 'Difficulties', 'Assinatura']" 
        :rows="$attendances"
        :variables_DB="['date', 'advances', 'difficulties', 'signature']" 
        iteration="false" 
        withSearchDateRange
        :element="$student" 
        searchRoute="student.showAttendancesAndFrequency" 
        notRegularSidebarForEditShowDelete
        notButtonAdd 
        :range="$date_range" 
        withShow
        actionRoute="attendance"
        numberPages="10">
    </x-table>

    <div class="flex justify-center">
        <hr class="w-5/6 my-2 border-gray-300 dark:border-gray-500" />
    </div>

    <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3 pb-3 sm:pb-6">
        <div class="flex items-center gap-x-1">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                Lista de Frequência do(a) {{ \Illuminate\Support\Str::limit($student->name ?? '------', 15) }}
            </h2>
        </div>
    </div>

    <x-table 
        title="Frequência"  
        :headers="array_merge($days, ['Faltas'])" 
        headersSmall 
        :rows="$frequency" 
        onlyHead
        headFrequency
        withSearchFrequency 
        :element="$student" 
        searchRoute="student.showAttendancesAndFrequency" 
        searchFrequencyStudent
        :student="$student"
        :monthYear="$monthYear"
        iteration="false"
        notPaginate>
    
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

    @if (isset($scrollBack))
        {{-- Alvo para rolagem --}}
        <div class="scroll-target"></div>
    @endif
        
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
