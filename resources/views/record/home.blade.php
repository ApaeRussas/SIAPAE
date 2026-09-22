<style>
    /* Botão Adicionar Ata de Reunião */
    .record-page .bg-blue-500 {
        background-color: #2F6B4F !important;
    }

    .record-page .bg-blue-500:hover {
        background-color: #23543E !important;
    }

    .record-page .bg-blue-600 {
        background-color: #2F6B4F !important;
    }

    .record-page .bg-blue-600:hover {
        background-color: #23543E !important;
    }
</style>

<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                {{ __('Ata de Reuniões') }}
            </h2>
        </div>
    </x-slot>

    <div class="record-page">

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

    </div>

</x-app-layout>