<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex items-center justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-xl sm:text-2xl font-bold leading-tight pt-2">
                {{ __('Lista das Anamneses Arquivadas') }}
            </h2>
            <x-button href="{{route('educational.index')}}" class="justify-center gap-2 h-10" variant="edit" bg="bg-gray-100 dark:bg-dark-eval-0">
                <x-icons.report class="flex-shrink-0 w-6 h-6" aria-hidden="true" />

                <span class="hidden sm:block">{{ __('Voltar') }}</span>
            </x-button>
        </div>
    </x-slot>

    <x-table 
        title="Relatório Pedagógico Arq." 
        :headers="['Data', 'Nome do Estudante', 'Texto do Relatório', 'Assinatura']" 
        :rows="$pedagogicals" 
        :variables_DB="['date_pedagogical', 'student.name', 'text', 'professor.name']"
        iteration="false"
        withSearchSelect
        :years="$years"
        :year="$year"
        withShow
        strLimit="20"
        searchRoute="educational.deposit"
        actionRoute="educational"
        notButtonDelete
        notButtonAdd>
    </x-table>
    
</x-app-layout> 