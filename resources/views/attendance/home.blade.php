<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <div class="flex items-center gap-x-1">
                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                    {{ __('Lista dos Registros de Atendimento') }}
                </h2>
                <x-button button variant="question" class="mt-2" size="sm" 
                    onclick="guestText('', '<br> Esse setor é dividido em duas partes: Calendário e Tabela. <br> <br> A tabela serve para criar um novo registro de atendimento para um aluno, além de mostrar outros registros anteriores, também é possível fazer uma consulta por intervalo de tempo utilizando a lupa. <br> <br> O calendário mostra para o usuário quais são os alunos que aparecem em seus respectivos turnos ao longo da semana, se na frequência do estudante na Apae o aluno estiver vindo naquele data, seu nome ficará verde, caso ele tenha faltado seu nome ficará vermelho. <br> <br> <div class=&quot;text-sm text-gray-500&quot;> Obs: O código tem um pequeno bug na questão da mudança de ano no calendário, para poder mudar de um ano ao outro se é necessário que você recarregue a página na faixa de semana após a mudança de ano, após isso se é possível mudar entre faixas de semana daquele ano</div> ')">
                    <x-icons.question />
                </x-button>
            </div>

            <x-button id="clearLocalStorageBtn" size="sm" variant="restart" title="Recarregar para Voltar ao Estado Original do Calendário">
                <x-icons.restart />  
            </x-button>
        </div>
    </x-slot>

    <x-table-attendance 
        title="Atendimento" 
        :year="$year"
        :faixaSemana="$faixaSemana" 
        :diasDaSemana="$diasDaSemana"
        :students="$students"
        :frequencies="$frequencies"
        :headers="['Date', 'Aluno', 'Educational axis', 'Signature']" 
        :rows="$attendances" 
        :variables_DB="['date', 'student.name', 'educational_axis', 'professor.name']"
        iteration="false"
        withSearchDateRange
        :range="$date_range"
        withShow
        strLimit="21"
        actionRoute="attendance" />
        
</x-app-layout>
