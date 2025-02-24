<x-app-layout>
    
    @php
        $state_user = '';
        if (isset($isArchived)) {
            $state_user = ' (Arquivado)';
        }
    @endphp

    <x-table-show 
        :title="'Informações do Usuário'. $state_user" 
        :elementShow="$user"
        :labelsVariables="[
        ['Nome do Usuário', 'name', 'text'],
        ['Email', 'email', 'text'],
        ['Profissão', 'position', 'select'],
        ]" 
        additional 
        notEditDelete
        actionRoute="coordinator" 
        :isArchived="$isArchived">

        @if ($user->position == 'Professor(a)')
        
        <hr class="my-4 border-gray-300 dark:border-gray-500" />

        <h1 class="text-xl font-bold leading-tight -mb-5">
            Registros de Atendimento Realizados por {{\Illuminate\Support\Str::words($user->name, 2, ' ...') }}
        </h1>

        <x-table    
            title="Atendimento" 
            :rows="$attendances"
            :headers="['Nome do Aluno', 'Date', 'Advances', 'Difficulties']" 
            :variables_DB="['student.name', 'date', 'advances', 'difficulties']" 
            iteration="false" 
            withSearchDateRange
            :element="$user" 
            searchRoute="coordinator.show" 
            notButtonAdd 
            :range="$date_range" 
            withShow
            actionRoute="attendance">
        </x-table>

        @if (isset($scrollBack))
            <!-- Alvo para rolagem -->
            <div class="scroll-target"></div>
        @endif

        @else 
        <br>
        @endif
        
        <div class="flex items-center justify-between">
            @if(Auth::user()->can('admin-view'))
                <x-button href="{{route('coordinator.edit', $user->id)}}" variant="warning"
                    title="Editar {{$user->name}}">
                    <p class="text-gray-900 px-2">
                        {{ __('Editar') }}
                    </p>
                </x-button>
            @else
                <p class="text-white dark:text-gray-800">.</p>
            @endif

            @if (!isset($isArchived))
                <form method="POST" action="{{ route('coordinator.archive', $user->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ csrf_field() }}

                    <x-button type="submit" variant="warning" title="Arquivar {{$user->name}}"
                        onclick="warningConfirm(event, 'Essa ação irá arquivar o usuário selecionado!', 'warning', 'Arquivar')">
                        <div class="text-gray-900 px-2">
                            {{ __('Arquivar') }}
                        </div>
                    </x-button>
                </form>
            @else
                <form action="{{route('coordinator.restore', $user->id)}}" method="POST"
                    onclick="warningConfirm(event, 'Quer restaurar o Usuário?', 'question', 'Restaurar')">
                    {{ csrf_field() }}

                    <x-button title="Restaurar o Usuário" variant="blue" >
                        <div class="text-gray-100 px-2">
                            {{ __('Restaurar') }}
                        </div>
                    </x-button>
                </form>
            @endif
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