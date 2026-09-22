<style>
    /* =========================================
       BOTÃO ADICIONAR ATA
       ========================================= */

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


    /* =========================================
       CABEÇALHO DA TABELA
       ========================================= */

    .record-page thead th {
        background-color: #E7F0E9 !important;
        color: #2F6B4F !important;
        border-color: #D5E5D9 !important;
    }


    /* =========================================
       BORDAS DA TABELA
       ========================================= */

    .record-page table {
        border-color: #D5E5D9 !important;
    }

    .record-page th,
    .record-page td {
        border-color: #D5E5D9 !important;
    }


    /* =========================================
       ELEMENTOS AZUIS INTERNOS
       ========================================= */

    .record-page .text-blue-400 {
        color: #6F9B80 !important;
    }

    .record-page .text-blue-500 {
        color: #2F6B4F !important;
    }

    .record-page .text-blue-600 {
        color: #2F6B4F !important;
    }

    .record-page .text-blue-700 {
        color: #23543E !important;
    }

    .record-page .border-blue-400 {
        border-color: #6F9B80 !important;
    }

    .record-page .border-blue-500 {
        border-color: #2F6B4F !important;
    }

    .record-page .border-blue-600 {
        border-color: #2F6B4F !important;
    }

    .record-page .border-blue-700 {
        border-color: #23543E !important;
    }


    /* =========================================
       FUNDOS AZUIS
       ========================================= */

    .record-page .bg-blue-50 {
        background-color: #F3F7F4 !important;
    }

    .record-page .bg-blue-100 {
        background-color: #E7F0E9 !important;
    }

    .record-page .bg-blue-200 {
        background-color: #D5E5D9 !important;
    }

    .record-page .bg-blue-300 {
        background-color: #B8CCBD !important;
    }

    .record-page .bg-blue-400 {
        background-color: #6F9B80 !important;
    }


    /* =========================================
       HOVER
       ========================================= */

    .record-page .hover\:bg-blue-500:hover {
        background-color: #2F6B4F !important;
    }

    .record-page .hover\:bg-blue-600:hover {
        background-color: #23543E !important;
    }

    .record-page .hover\:bg-blue-700:hover {
        background-color: #23543E !important;
    }

    .record-page .hover\:text-blue-500:hover {
        color: #2F6B4F !important;
    }

    .record-page .hover\:text-blue-600:hover {
        color: #2F6B4F !important;
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