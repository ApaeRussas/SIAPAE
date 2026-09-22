<x-app-layout :context="$context">

    <div class="regional-list-page">

        <x-slot name="header">
            <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">

                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                    {{ __('Lista dos Relatórios Regionais') }}
                </h2>

            </div>
        </x-slot>


        <x-table
            title="Relatório Regional"
            :headers="['Data', 'Título', 'Subtítulo', 'Assinatura']"
            :rows="$regionals"
            :variables_DB="['date', 'title', 'subtitle', 'coordinator.name']"
            iteration="false"
            withSearchSelect
            :years="$years"
            :year="$year"
            withShow
            strLimit="20"
            actionRoute="regional">
        </x-table>

    </div>


    <style>
        /* =========================================================
           RELATÓRIOS REGIONAIS
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .regional-list-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .regional-list-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .regional-list-page .border-gray-200,
        .regional-list-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .regional-list-page .shadow,
        .regional-list-page .shadow-sm,
        .regional-list-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TÍTULOS E TEXTOS
           ========================================================= */

        .regional-list-page .text-gray-700 {
            color: #334E68 !important;
        }

        .regional-list-page .text-gray-800 {
            color: #102A43 !important;
        }

        .regional-list-page .text-gray-500,
        .regional-list-page .text-gray-600 {
            color: #66788A !important;
        }


        /* =========================================================
           CABEÇALHO DA TABELA
           ========================================================= */

        .regional-list-page table thead {
            background-color: #F4F6F8 !important;
        }

        .regional-list-page table thead th {
            color: #102A43 !important;
            border-color: #E1E7EC !important;
            font-weight: 600;
        }


        /* =========================================================
           CORPO DA TABELA
           ========================================================= */

        .regional-list-page table tbody tr {
            background-color: #FFFFFF !important;
            transition: background-color 0.18s ease;
        }

        .regional-list-page table tbody tr:hover {
            background-color: #F8FAF9 !important;
        }

        .regional-list-page table tbody td {
            color: #334E68 !important;
            border-color: #E8EDF1 !important;
        }


        /* =========================================================
           LINKS / VISUALIZAÇÃO
           ========================================================= */

        .regional-list-page table a {
            color: #3B7D5A !important;
            transition: color 0.18s ease;
        }

        .regional-list-page table a:hover {
            color: #2F684A !important;
        }


        /* =========================================================
           BUSCA
           ========================================================= */

        .regional-list-page #search-container {
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .regional-list-page #search-container input {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        .regional-list-page #search-container input::placeholder {
            color: #8091A5 !important;
        }

        .regional-list-page #search-container:focus-within {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }


        /* =========================================================
           SELECT DE ANO
           ========================================================= */

        .regional-list-page select {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
        }

        .regional-list-page select:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           BOTÕES AZUIS DO x-table -> VERDE SIAPAE
           ========================================================= */

        .regional-list-page .bg-blue-500,
        .regional-list-page .bg-blue-600,
        .regional-list-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .regional-list-page .bg-blue-500:hover,
        .regional-list-page .bg-blue-600:hover,
        .regional-list-page .bg-blue-700:hover,
        .regional-list-page .hover\:bg-blue-600:hover,
        .regional-list-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           PAGINAÇÃO
           ========================================================= */

        .regional-list-page nav .bg-blue-500,
        .regional-list-page nav .bg-blue-600 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .regional-list-page nav .bg-blue-500:hover,
        .regional-list-page nav .bg-blue-600:hover {
            background-color: #2F684A !important;
        }


        /* =========================================================
           TRANSIÇÕES
           ========================================================= */

        .regional-list-page button,
        .regional-list-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 640px) {

            .regional-list-page {
                padding-bottom: 1rem;
            }

            .regional-list-page table {
                font-size: 0.875rem;
            }
        }
    </style>

</x-app-layout>