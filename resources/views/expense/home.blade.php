<x-app-layout :context="$context">

    <div class="expense-list-page">

        <x-slot name="header">
            <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">

                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                    {{ __('Controle de Gastos') }}
                </h2>

            </div>
        </x-slot>


        <x-table
            title="Gasto"
            :headers="[
                'Data de Emissão',
                'Tipo',
                'Número',
                'Empresa',
                'Descrição',
                'Valor'
            ]"
            :rows="$expenses"
            :elementsExcelOrPdf="$allExpenses"
            :variables_DB="[
                'date_of_emission',
                'type',
                'number',
                'enterprise',
                'description',
                'price'
            ]"
            iteration="false"
            withShow
            withSearchSelect
            :years="$years"
            :year="$year"
            :valueTotal="$valueTotal"
            withExportExcel
            actionRoute="expense">
        </x-table>

    </div>


    <style>
        /* =========================================================
           CONTROLE DE GASTOS
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .expense-list-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .expense-list-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .expense-list-page .border-gray-200,
        .expense-list-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .expense-list-page .shadow,
        .expense-list-page .shadow-sm,
        .expense-list-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TÍTULOS E TEXTOS
           ========================================================= */

        .expense-list-page .text-gray-700 {
            color: #334E68 !important;
        }

        .expense-list-page .text-gray-800 {
            color: #102A43 !important;
        }

        .expense-list-page .text-gray-500,
        .expense-list-page .text-gray-600 {
            color: #66788A !important;
        }


        /* =========================================================
           CABEÇALHO DA TABELA
           ========================================================= */

        .expense-list-page table thead {
            background-color: #F4F6F8 !important;
        }

        .expense-list-page table thead th {
            color: #102A43 !important;
            background-color: #F4F6F8 !important;
            border-color: #E1E7EC !important;
            font-weight: 600;
            white-space: nowrap;
        }


        /* =========================================================
           LINHAS
           ========================================================= */

        .expense-list-page table tbody tr {
            background-color: #FFFFFF !important;
            transition: background-color 0.18s ease;
        }

        .expense-list-page table tbody tr:hover {
            background-color: #F8FAF9 !important;
        }

        .expense-list-page table tbody td {
            color: #334E68 !important;
            border-color: #E8EDF1 !important;
        }


        /* =========================================================
           LINKS / VISUALIZAÇÃO
           ========================================================= */

        .expense-list-page table a {
            color: #3B7D5A !important;
            transition: color 0.18s ease;
        }

        .expense-list-page table a:hover {
            color: #2F684A !important;
        }


        /* =========================================================
           CAMPO DE BUSCA
           ========================================================= */

        .expense-list-page #search-container {
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .expense-list-page #search-container input {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        .expense-list-page #search-container input::placeholder {
            color: #8091A5 !important;
        }

        .expense-list-page #search-container:focus-within {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }


        /* =========================================================
           SELECT DE ANO
           ========================================================= */

        .expense-list-page select {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
        }

        .expense-list-page select:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           BOTÕES AZUIS DO x-table -> VERDE SIAPAE
           ========================================================= */

        .expense-list-page .bg-blue-500,
        .expense-list-page .bg-blue-600,
        .expense-list-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .expense-list-page .bg-blue-500:hover,
        .expense-list-page .bg-blue-600:hover,
        .expense-list-page .bg-blue-700:hover,
        .expense-list-page .hover\:bg-blue-600:hover,
        .expense-list-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           PAGINAÇÃO
           ========================================================= */

        .expense-list-page nav .bg-blue-500,
        .expense-list-page nav .bg-blue-600 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .expense-list-page nav .bg-blue-500:hover,
        .expense-list-page nav .bg-blue-600:hover {
            background-color: #2F684A !important;
        }


        /* =========================================================
           BOTÕES E LINKS
           ========================================================= */

        .expense-list-page button,
        .expense-list-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 768px) {

            .expense-list-page {
                padding-bottom: 1rem;
            }

            .expense-list-page table {
                font-size: 0.875rem;
            }
        }
    </style>

</x-app-layout>