<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                {{ __('Lista dos Relatórios Pedagógicos') }}
            </h2>

            <x-button href="{{route('educational.deposit')}}" class="justify-center gap-2" variant="edit" bg="bg-gray-100 dark:bg-dark-eval-0">
                 <x-icons.archive class="w-6 h-6 dark:text-gray-300 -ml-1" aria-hidden="true" />

                <span class="hidden sm:block">{{ __('Armazém') }}</span>
            </x-button>
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