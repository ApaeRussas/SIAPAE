<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                {{ __('Ata de Reuniões') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Ata de Reunião" 
        :headers="['Tipo de Ata', 'Data', 'Arquivo']" 
        :rows="$records" 
        :variables_DB="['type_ata', 'date', 'file']"
        iteration="false"
        withSearchSelect
        :years="$years"
        :year="$year"
        withShow
        actionRoute="record">
    </x-table>
 
</x-app-layout> 