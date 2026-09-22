<x-app-layout :context="$context">

    <div class="educational-list-page">

        <x-slot name="header">
            <div class="flex justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                    {{ __('Lista dos Relatórios Pedagógicos') }}
                </h2>

                <x-button
                    href="{{ route('educational.deposit') }}"
                    class="justify-center gap-2 !bg-white !text-[#102A43] !border !border-[#E1E7EC] hover:!bg-[#F4F7F5] shadow-none"
                >
                    <x-icons.archive
                        class="w-6 h-6 -ml-1"
                        aria-hidden="true"
                    />

                    <span class="hidden sm:block">
                        {{ __('Armazém') }}
                    </span>
                </x-button>
            </div>
        </x-slot>


        <x-table
            title="Relatório Pedagógico"
            :headers="['Data', 'Nome do Estudante', 'Texto do Relatório', 'Assinatura']"
            :rows="$pedagogicals"
            :variables_DB="['date_pedagogical', 'student.name', 'text', 'professor.name']"
            iteration="false"
            withSearchSelect
            :years="$years"
            :year="$year"
            withShow
            strLimit="20"
            actionRoute="educational">
        </x-table>

    </div>


    <style>
        /* =========================================================
           RELATÓRIOS PEDAGÓGICOS
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .educational-list-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }

        /* Fundo dos elementos principais */
        .educational-list-page .bg-white {
            background-color: #FFFFFF !important;
        }

        /* Bordas suaves */
        .educational-list-page .border-gray-200,
        .educational-list-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        /* Títulos e textos */
        .educational-list-page .text-gray-700 {
            color: #334E68 !important;
        }

        .educational-list-page .text-gray-800 {
            color: #102A43 !important;
        }

        /* =========================================================
           CARD PRINCIPAL DA TABELA
           ========================================================= */

        .educational-list-page .rounded-lg,
        .educational-list-page .rounded-xl,
        .educational-list-page .rounded-2xl {
            border-color: #E1E7EC;
        }

        .educational-list-page .shadow,
        .educational-list-page .shadow-sm,
        .educational-list-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           CABEÇALHO DA TABELA
           ========================================================= */

        .educational-list-page table thead {
            background-color: #F4F6F8 !important;
        }

        .educational-list-page table thead th {
            color: #102A43 !important;
            border-color: #E1E7EC !important;
            font-weight: 600;
        }

        .educational-list-page table tbody td {
            color: #334E68 !important;
            border-color: #E8EDF1 !important;
        }

        .educational-list-page table tbody tr {
            background-color: #FFFFFF !important;
            transition: background-color 0.18s ease;
        }

        .educational-list-page table tbody tr:hover {
            background-color: #F8FAF9 !important;
        }


        /* =========================================================
           LINKS DA TABELA
           ========================================================= */

        .educational-list-page table a {
            color: #3B7D5A !important;
            transition: color 0.18s ease;
        }

        .educational-list-page table a:hover {
            color: #2F684A !important;
        }


        /* =========================================================
           CAMPO DE BUSCA
           ========================================================= */

        .educational-list-page #search-container {
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .educational-list-page #search-container input {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        .educational-list-page #search-container input::placeholder {
            color: #8091A5 !important;
        }

        .educational-list-page #search-container:focus-within {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }


        /* =========================================================
           SELECT DE ANO
           ========================================================= */

        .educational-list-page select {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
        }

        .educational-list-page select:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           BOTÕES AZUIS DO x-table -> VERDE SIAPAE
           ========================================================= */

        .educational-list-page .bg-blue-500,
        .educational-list-page .bg-blue-600,
        .educational-list-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .educational-list-page .bg-blue-500:hover,
        .educational-list-page .bg-blue-600:hover,
        .educational-list-page .bg-blue-700:hover,
        .educational-list-page .hover\:bg-blue-600:hover,
        .educational-list-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           BOTÃO ARMAZÉM
           ========================================================= */

        .educational-list-page .educational-list-page {
            color: #102A43;
        }

        .educational-list-page header a,
        .educational-list-page header button {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }

        .educational-list-page header a:hover,
        .educational-list-page header button:hover {
            background-color: #F4F7F5 !important;
        }


        /* =========================================================
           ÍCONES
           ========================================================= */

        .educational-list-page .text-gray-500,
        .educational-list-page .text-gray-600 {
            color: #66788A !important;
        }


        /* =========================================================
           PAGINAÇÃO
           ========================================================= */

        .educational-list-page nav a,
        .educational-list-page nav button {
            transition:
                background-color 0.18s ease,
                color 0.18s ease,
                border-color 0.18s ease;
        }

        .educational-list-page nav .bg-blue-500,
        .educational-list-page nav .bg-blue-600 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .educational-list-page nav .bg-blue-500:hover,
        .educational-list-page nav .bg-blue-600:hover {
            background-color: #2F684A !important;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 640px) {
            .educational-list-page {
                padding-bottom: 1rem;
            }

            .educational-list-page table {
                font-size: 0.875rem;
            }
        }
    </style>

</x-app-layout>