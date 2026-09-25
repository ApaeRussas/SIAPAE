<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h2 class="text-2xl md:text-3xl font-bold leading-tight text-[#102A43]">
                {{ __('Lista de Serviços de Convivência e Fortalecimento de Vínculos') }}
            </h2>

        </div>
    </x-slot>


    {{-- CONTEÚDO --}}
    <div class="scfv-page py-6 bg-[#F4F6F8] min-h-screen overflow-x-hidden">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <x-table
                title="SCFV"
                :headers="['Date', 'Tema', 'Objetivo 1ª Quinz', 'Signature']"
                :rows="$scfvs"
                :variables_DB="['date_scfv', 'theme', '1Q_objective', 'professor.name']"
                iteration="false"
                withShow
                withSearchDateRange
                :range="$date_range"
                strLimit="20"
                actionRoute="scfv">
            </x-table>

        </div>

    </div>

</x-app-layout>


<style>

    /* =========================================================
       PADRÃO VISUAL SIAPAE
       PÁGINA SCFV
       ========================================================= */

    .scfv-page {

        --siapae-green: #3B7D5A;
        --siapae-green-dark: #2F684A;
        --siapae-green-soft: #EDF5F0;

        --siapae-text: #102A43;
        --siapae-secondary: #66788A;

        --siapae-border: #E1E7EC;
        --siapae-row-border: #E8EDF1;

        --siapae-input-border: #D7DEE5;

    }


    /* =========================================================
       FUNDO
       ========================================================= */

    body {
        background-color: #F4F6F8 !important;
    }


    /* =========================================================
       CARD PRINCIPAL
       ========================================================= */

    .scfv-page .bg-white {

        background-color: #FFFFFF !important;

    }


    .scfv-page .border-gray-200,
    .scfv-page .border-gray-300,
    .scfv-page .border-gray-400 {

        border-color: var(--siapae-border) !important;

    }


    .scfv-page .shadow,
    .scfv-page .shadow-sm,
    .scfv-page .shadow-md {

        box-shadow:
            0 8px 24px rgba(39, 67, 54, 0.06) !important;

    }


    .scfv-page .rounded-md,
    .scfv-page .rounded-lg,
    .scfv-page .rounded-xl,
    .scfv-page .rounded-2xl {

        border-radius: 10px !important;

    }


    /* =========================================================
       TÍTULOS
       ========================================================= */

    .scfv-page h1,
    .scfv-page h2,
    .scfv-page h3 {

        color: var(--siapae-text) !important;

    }


    /* =========================================================
       PESQUISA / FILTRO DE DATA
       ========================================================= */

    .scfv-page #search-container {

        background-color: #FFFFFF !important;

        border: 1px solid var(--siapae-input-border) !important;

        border-radius: 10px !important;

        box-shadow: none !important;

        overflow: hidden !important;

    }


    .scfv-page #search-container:focus-within {

        border-color: var(--siapae-green) !important;

        box-shadow:
            0 0 0 3px rgba(59, 125, 90, 0.10) !important;

    }


    .scfv-page #search-container input {

        background-color: #FFFFFF !important;

        color: var(--siapae-text) !important;

        border: none !important;

        box-shadow: none !important;

        outline: none !important;

    }


    .scfv-page #search-container input::placeholder {

        color: #8091A5 !important;

        opacity: 1 !important;

    }


    .scfv-page #search-container button {

        background-color: #FFFFFF !important;

        color: var(--siapae-text) !important;

        border-color: var(--siapae-input-border) !important;

    }


    .scfv-page #search-container button:hover {

        background-color: #F4F7F5 !important;

    }


    /* =========================================================
       INPUTS GERAIS
       ========================================================= */

    .scfv-page input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]),
    .scfv-page select {

        background-color: #FFFFFF !important;

        color: var(--siapae-text) !important;

        border: 1px solid var(--siapae-input-border) !important;

        border-radius: 9px !important;

        box-shadow: none !important;

        outline: none !important;

        transition:
            border-color .18s ease,
            box-shadow .18s ease;

    }


    .scfv-page input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]):focus,
    .scfv-page select:focus {

        border-color: var(--siapae-green) !important;

        box-shadow:
            0 0 0 3px rgba(59, 125, 90, 0.10) !important;

        outline: none !important;

    }


    /* =========================================================
       TABELA
       ========================================================= */

    .scfv-page table {

        width: 100% !important;

        background-color: #FFFFFF !important;

        border: 1px solid var(--siapae-border) !important;

        border-radius: 12px !important;

        border-collapse: separate !important;

        border-spacing: 0 !important;

        overflow: hidden !important;

    }


    /* Cabeçalho */

    .scfv-page table thead,
    .scfv-page table thead tr {

        background-color: #F4F6F8 !important;

    }


    .scfv-page table thead th {

        background-color: #F4F6F8 !important;

        color: var(--siapae-text) !important;

        border-color: var(--siapae-border) !important;

        font-weight: 700 !important;

        padding-top: 16px !important;

        padding-bottom: 16px !important;

    }


    /* Corpo */

    .scfv-page table tbody {

        background-color: #FFFFFF !important;

    }


    .scfv-page table tbody tr {

        background-color: #FFFFFF !important;

        border-color: var(--siapae-row-border) !important;

        transition:
            background-color .18s ease !important;

    }


    .scfv-page table tbody tr:hover {

        background-color: #F8FAF9 !important;

    }


    .scfv-page table tbody td {

        color: var(--siapae-secondary) !important;

        border-color: var(--siapae-row-border) !important;

        padding-top: 16px !important;

        padding-bottom: 16px !important;

    }


    /* =========================================================
       LINKS / REGISTROS
       ========================================================= */

    .scfv-page table tbody td a {

        color: var(--siapae-text) !important;

        font-weight: 600 !important;

        transition: color .18s ease !important;

    }


    .scfv-page table tbody td a:hover {

        color: var(--siapae-green) !important;

    }


    /* =========================================================
       BOTÕES
       ========================================================= */

    .scfv-page .bg-blue-500,
    .scfv-page .bg-blue-600,
    .scfv-page .bg-blue-700 {

        background-color: var(--siapae-green) !important;

        background-image: none !important;

        border-color: var(--siapae-green) !important;

        color: #FFFFFF !important;

    }


    .scfv-page .bg-blue-500:hover,
    .scfv-page .bg-blue-600:hover,
    .scfv-page .bg-blue-700:hover {

        background-color: var(--siapae-green-dark) !important;

        border-color: var(--siapae-green-dark) !important;

        color: #FFFFFF !important;

    }


    /* =========================================================
       CORES AZUIS ANTIGAS
       ========================================================= */

    .scfv-page .text-blue-500,
    .scfv-page .text-blue-600,
    .scfv-page .text-blue-700 {

        color: var(--siapae-green) !important;

    }


    .scfv-page .border-blue-500,
    .scfv-page .border-blue-600,
    .scfv-page .border-blue-700 {

        border-color: var(--siapae-green) !important;

    }


    /* =========================================================
       PAGINAÇÃO
       ========================================================= */

    .scfv-page .pagination a,
    .scfv-page .pagination button {

        border-radius: 8px !important;

        transition: all .18s ease !important;

    }


    .scfv-page .pagination .bg-blue-500,
    .scfv-page .pagination .bg-blue-600,
    .scfv-page .pagination .bg-blue-700 {

        background-color: var(--siapae-green) !important;

        border-color: var(--siapae-green) !important;

        color: #FFFFFF !important;

    }


    /* =========================================================
       TEXTOS SECUNDÁRIOS
       ========================================================= */

    .scfv-page .text-gray-500,
    .scfv-page .text-gray-600,
    .scfv-page .text-gray-700 {

        color: var(--siapae-secondary) !important;

    }


    /* =========================================================
       RESPONSIVIDADE
       ========================================================= */

    @media (max-width: 768px) {

        .scfv-page table {

            font-size: 14px !important;

        }


        .scfv-page table thead th,
        .scfv-page table tbody td {

            padding-left: 12px !important;

            padding-right: 12px !important;

        }

    }

</style>