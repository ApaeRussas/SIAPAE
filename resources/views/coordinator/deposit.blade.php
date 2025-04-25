<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-2xl font-bold leading-tight pt-2">
                {{ __('Lista dos Usuários Arquivados') }}
            </h2>
            <x-button href="{{route('coordinator.index')}}" class="justify-center gap-2" variant="edit" bg="bg-gray-100 dark:bg-dark-eval-0">
                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />

                <span class="hidden sm:block">{{ __('Voltar') }}</span>
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
        title="Usuário Arquivado" 
        :headers="['Nome', 'Email', 'Profissão', 'Acesso']" 
        :rows="$users" 
        :variablesDB="['name', 'email', 'position', 'access_level']"
        iteration="false"
        withSearchInput
        searchRoute="coordinator.deposit"
        :search="$search"
        withShow
        actionRoute="coordinator"
        :isNotAdmin="$isNotAdmin"
        actionsDeposit
        actionsDepositWithDelete
        deleteWithPassword>
    </x-table>
    
</x-app-layout> 