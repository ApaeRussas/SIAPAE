<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                {{ __('Lista de Serviços de Convivência e Fortalecimento de Vínculos') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="SCFV" 
        :headers="['Date', 'Tema', 'Objetivo 1ª Quinz', 'Signature']" 
        :rows="$scfvs" 
        :variables_DB="['date_scfv', 'theme', '1Q_objective', 'professor.name']"
        iteration="false"
        withShow
        withSearchDateRange
        :range="$date_range"
        strLimit="20"
        actionRoute="scfv">
    </x-table>

</x-app-layout>