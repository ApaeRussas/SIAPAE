<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                {{ __('Lista dos Relatórios Pedagógicos') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Relatório Pedagógico" 
        :headers="['Data', 'Nome do Estudante', 'Texto do Relatório', 'Assinatura']" 
        :rows="$pedagogicals" 
        :variables_DB="['date_pedagogical', 'student.name', 'text', 'professor.name']"
        iteration="false"
        withSearchSelect
        :years="$years"
        :year="$year"
        withShow
        strLimit="20"
        actionRoute="educational">
    </x-table>
 
</x-app-layout>