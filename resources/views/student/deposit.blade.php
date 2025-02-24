<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-xl sm:text-2xl font-bold leading-tight pt-2">
                {{ __('Lista dos Estudantes Arquivados') }}
            </h2>
            <x-button href="{{route('student.index')}}" class="justify-center gap-2 h-10" variant="edit" bg="bg-gray-100 dark:bg-dark-eval-0">
                <x-icons.person class="w-6 h-6 dark:text-gray-300 -ml-1" aria-hidden="true" />

                <span class="hidden sm:block">{{ __('Voltar') }}</span>
            </x-button>
        </div>
    </x-slot>

    <x-table 
        title="Aluno Arquivado" 
        :headers="['Nome', 'Data Nasc.', 'ID do Aluno', 'Escola', 'Diagnóstico', 'Foto']" 
        :rows="$students" 
        :variablesDB="['name', 'date_of_birth', 'student_id', 'school', 'diagnostic.name', 'image']"
        iteration="false"
        withSearchInput
        searchArchive
        :search="$search"
        withShow
        actionRoute="student"
        actionsDeposit>
    </x-table>
    
</x-app-layout> 