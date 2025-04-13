<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                {{ __('Controle de Gastos') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Gasto" 
        :headers="['Data de Emissão', 'Tipo', 'Número', 'Empresa', 'Descrição', 'Valor']" 
        :rows="$expenses" 
        :elementsExcelOrPdf="$allExpenses"
        :variables_DB="['date_of_emission', 'type', 'number', 'enterprise', 'description', 'price']"
        iteration="false"
        withShow
        withSearchSelect
        :years="$years"
        :year="$year"
        :valueTotal="$valueTotal"
        withExportExcel
        actionRoute="expense">
    </x-table>

</x-app-layout>