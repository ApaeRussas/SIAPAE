<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                {{ __('Lista de Anamneses') }}
            </h2>
            <x-button href="{{route('anamnesis.deposit')}}" class="justify-center gap-2" variant="edit" bg="bg-gray-100 dark:bg-dark-eval-0">
                 <x-icons.archive class="w-6 h-6 dark:text-gray-300 -ml-1" aria-hidden="true" />

                <span class="hidden sm:block">{{ __('Armazém') }}</span>
            </x-button>
        </div>
    </x-slot>

    <x-table title="Anamnese" 
        :headers="['Nome', 'ID do Assistido', 'Data Anamnese', 'Assinatura']"
        :rows="$medHistories" 
        :variablesDB="['student.name', 'student.student_id', 'date_of_anamnesis', 'user.name']" 
        iteration="false" 
        withSearchInput
        :search="$search"
        withShow
        actionRoute="anamnesis">
    </x-table>

</x-app-layout>