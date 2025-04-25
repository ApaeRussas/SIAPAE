<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-2xl font-bold leading-tight pt-2">
                {{ __('Tabela de Usuários') }}
            </h2>
            <x-button href="{{route('coordinator.deposit')}}" class="justify-center gap-2" variant="edit" bg="bg-gray-100 dark:bg-dark-eval-0">
                <x-icons.archive class="w-6 h-6 dark:text-gray-300 -ml-1" aria-hidden="true" />

                <span class="hidden sm:block">{{ __('Armazém') }}</span>
            </x-button>
        </div>
    </x-slot>

    @php
        $isNotAdmin = 1;
        if(Auth::user()->can('admin-view') ) {
            $isNotAdmin = null;
        }
    @endphp

    <x-table 
        title="Usuário" 
        :headers="['Nome', 'Email', 'Profissão', 'Acesso']" 
        :rows="$users" 
        :variablesDB="['name', 'email', 'position', 'access_level']"
        iteration="false"
        withSearchInput
        searchRoute="coordinator.index"
        :search="$search"
        withShow
        archiveInsteadDestroy
        :isNotAdmin="$isNotAdmin"
        notArchiveAdmin
        strLimit="22"
        actionRoute="coordinator">
    </x-table>
    
</x-app-layout>
