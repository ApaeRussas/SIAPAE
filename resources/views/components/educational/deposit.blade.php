<x-app-layout :context="$context">

    <div class="educational-archive-page">

        <x-slot name="header">
            <div class="flex items-center justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">

                <h2 class="text-xl sm:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                    {{ __('Lista das Anamneses Arquivadas') }}
                </h2>

                <x-button
                    href="{{ route('educational.index') }}"
                    class="justify-center gap-2 h-10 !bg-white !text-[#102A43] !border !border-[#E1E7EC] hover:!bg-[#F4F7F5] shadow-none"
                >
                    <x-icons.report
                        class="flex-shrink-0 w-6 h-6"
                        aria-hidden="true"
                    />

                    <span class="hidden sm:block">
                        {{ __('Voltar') }}
                    </span>
                </x-button>

            </div>
        </x-slot>


        <x-table
            title="Relatório Pedagógico Arq."
            :headers="['Data', 'Nome do Estudante', 'Texto do Relatório', 'Assinatura']"
            :rows="$pedagogicals"
            :variables_DB="['date_pedagogical', 'student.name', 'text', 'professor.name']"
            iteration="false"
            withSearchSelect
            :years="$years"
            :year="$year"
            withShow
            strLimit="20"
            searchRoute="educational.deposit"
            actionRoute="educational"
            notButtonDelete
            notButtonAdd>
        </x-table>

    </div>


    <style>
        /* =========================================================
           RELATÓRIOS PEDAGÓGICOS ARQUIVADOS
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .educational-archive-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .educational-archive-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .educational-archive-page .border-gray-200,
        .educational-archive-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .educational-archive-page .shadow,
        .educational-archive-page .shadow-sm,
        .educational-archive-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TEXTOS
           ========================================================= */

        .educational-archive-page .text-gray-700 {
            color: #334E68 !important;
        }

        .educational-archive-page .text-gray-800 {
            color: #102A43 !important;
        }

        .educational-archive-page .text-gray-500,
        .educational-archive-page .text-gray-600 {
            color: #66788A !important;
        }


        /* =========================================================
           CABEÇALHO DA TABELA
           ========================================================= */

        .educational-archive-page table thead {
            background-color: #F4F6F8 !important;
        }

        .educational-archive-page table thead th {
            color: #102A43 !important;
            border-color: #E1E7EC !important;
            font-weight: 600;
        }


        /* =========================================================
           LINHAS DA TABELA
           ========================================================= */

        .educational-archive-page table tbody tr {
            background-color: #FFFFFF !important;
            transition: background-color 0.18s ease;
        }

        .educational-archive-page table tbody tr:hover {
            background-color: #F8FAF9 !important;
        }

        .educational-archive-page table tbody td {
            color: #334E68 !important;
            border-color: #E8EDF1 !important;
        }


        /* =========================================================
           LINKS
           ========================================================= */

        .educational-archive-page table a {
            color: #3B7D5A !important;
            transition: color 0.18s ease;
        }

        .educational-archive-page table a:hover {
            color: #2F684A !important;
        }


        /* =========================================================
           CAMPO DE BUSCA
           ========================================================= */

        .educational-archive-page #search-container {
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .educational-archive-page #search-container input {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        .educational-archive-page #search-container input::placeholder {
            color: #8091A5 !important;
        }

        .educational-archive-page #search-container:focus-within {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }


        /* =========================================================
           SELECT DE ANO
           ========================================================= */

        .educational-archive-page select {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
        }

        .educational-archive-page select:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           BOTÕES AZUIS HERDADOS DO x-table
           ========================================================= */

        .educational-archive-page .bg-blue-500,
        .educational-archive-page .bg-blue-600,
        .educational-archive-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .educational-archive-page .bg-blue-500:hover,
        .educational-archive-page .bg-blue-600:hover,
        .educational-archive-page .bg-blue-700:hover,
        .educational-archive-page .hover\:bg-blue-600:hover,
        .educational-archive-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           PAGINAÇÃO
           ========================================================= */

        .educational-archive-page nav .bg-blue-500,
        .educational-archive-page nav .bg-blue-600 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .educational-archive-page nav .bg-blue-500:hover,
        .educational-archive-page nav .bg-blue-600:hover {
            background-color: #2F684A !important;
        }


        /* =========================================================
           BOTÃO VOLTAR
           ========================================================= */

        .educational-archive-page header a,
        .educational-archive-page header button {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }

        .educational-archive-page header a:hover,
        .educational-archive-page header button:hover {
            background-color: #F4F7F5 !important;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 640px) {

            .educational-archive-page {
                padding-bottom: 1rem;
            }

            .educational-archive-page table {
                font-size: 0.875rem;
            }
        }
    </style>

</x-app-layout>