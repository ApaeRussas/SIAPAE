<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-2">
                <h2 class="text-2xl md:text-3xl font-semibold leading-tight text-[#1F513A] dark:text-[#E5EAE7]">
                    {{ __('Lista de Estudantes') }}
                </h2>

                <button
                    type="button"
                    class="!bg-transparent hover:!bg-transparent !border-0 !shadow-none !p-0 !outline-none text-[#2F7658] dark:text-[#5FBE8C]"
                    onclick="guestText('info', 'Esta tabela é essencial para registros relacionados, como anamnese, lista de frequência, registro de atendimento e relatório pedagógico, que dependem de um estudante criado para funcionarem. <br> <br> <span class=&quot;text-red-500&quot;> Importante: </span> ao arquivar um estudante, seus registros associados, como anamnese, atendimento e relatório pedagógico, serão automaticamente arquivados para fins de organização e espaço. Esses registros só podem ser restaurados se o estudante também for restaurado. Observação: a lista de frequência não será arquivada.')"
                >
                    <x-icons.question class="w-6 h-6" />
                </button>
            </div>

            <x-button
                href="{{ route('student.deposit') }}"
                class="!bg-transparent hover:!bg-transparent !text-[#102A43] dark:!text-gray-200 !border !border-[#E1E7EC] dark:!border-dark-eval-2 shadow-none justify-center gap-2"
            >
                <x-icons.archive
                    class="w-5 h-5 text-[#102A43] dark:text-gray-200"
                    aria-hidden="true"
                />
                <span>{{ __('Armazém') }}</span>
            </x-button>

        </div>
    </x-slot>


    {{-- CONTEÚDO --}}
    <div class="student-list-page py-6 bg-transparent overflow-x-hidden">

        <div class="w-full px-4 sm:px-6 lg:px-8">

            <x-table
                title="Aluno"
                :headers="['Nome', 'Data Nasc.', 'ID do Aluno', 'Escola', 'Diagnóstico', 'Foto']"
                :rows="$students"
                :variablesDB="['name', 'date_of_birth', 'student_id', 'school', 'diagnostic', 'image']"
                iteration="false"
                withSearchInput
                :search="$search"
                withShow
                archiveInsteadDestroy
                actionRoute="student">
            </x-table>

        </div>

    </div>

</x-app-layout>


<style>
    /* =========================================================
       FICHA DOS ESTUDANTES
       MESMO PADRÃO VISUAL DA PÁGINA DE ANAMNESE
       (com suporte correto ao tema claro/escuro)
       ========================================================= */

    .student-list-page {
        /* -------- tema claro (padrão) -------- */
        --siapae-green: #3B7D5A;
        --siapae-green-dark: #2F684A;
        --siapae-green-soft: #EDF5F0;
        --siapae-text: #183C2C;
        --siapae-secondary: #66788A;
        --siapae-border: #E1E7EC;
        --siapae-row-border: #E8EDF1;
        --siapae-card-bg: #F7F5EF;
        --siapae-input-bg: #FFFFFF;
        --siapae-listing-bg: #FFFFFF;
        --siapae-header-bg: #EAF0EB;
        --siapae-row-hover: #F8FAF9;
        --siapae-shadow: rgba(1, 71, 38, 0.06);
    }

    /* -------- tema escuro: usa as mesmas cores do restante do painel -------- */
    .dark .student-list-page {
        --siapae-green: #4CA57A;
        --siapae-green-dark: #3E8C67;
        --siapae-green-soft: #17301F;
        --siapae-text: #E5EAE7;
        --siapae-secondary: #9CB0A6;
        --siapae-border: #24382C;
        --siapae-row-border: #1F332A;
        --siapae-card-bg: #16241B;
        --siapae-input-bg: #1B2E22;
        --siapae-listing-bg: #1B2E22;
        --siapae-header-bg: #10251A;
        --siapae-row-hover: #1B2E22;
        --siapae-shadow: rgba(0, 0, 0, 0.35);
    }


    /* =========================================================
       CARD PRINCIPAL (resto da tela — permanece off-white)
       ========================================================= */

    .student-list-page .bg-white {
        background-color: var(--siapae-card-bg) !important;
    }

    .student-list-page .border-gray-200,
    .student-list-page .border-gray-300 {
        border-color: var(--siapae-border) !important;
    }

    .student-list-page .shadow-md,
    .student-list-page .shadow-sm {
        box-shadow: 0 8px 24px var(--siapae-shadow) !important;
    }

    .student-list-page .rounded-lg,
    .student-list-page .rounded-xl,
    .student-list-page .rounded-2xl {
        border-radius: 14px !important;
    }


    /* =========================================================
       TÍTULOS
       ========================================================= */

    .student-list-page h1,
    .student-list-page h2,
    .student-list-page h3 {
        color: var(--siapae-text) !important;
    }


    /* =========================================================
       ÁREA DE PESQUISA (input — branco)
       ========================================================= */

    .student-list-page #search-container {
        background-color: var(--siapae-input-bg) !important;
        border: 1px solid var(--siapae-border) !important;
        border-radius: 10px !important;
        box-shadow: none !important;
        overflow: hidden !important;
    }

    .student-list-page #search-container:focus-within {
        border-color: var(--siapae-green) !important;
        box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
    }

    .student-list-page #search-container input {
        background-color: var(--siapae-input-bg) !important;
        color: var(--siapae-text) !important;
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
    }

    .student-list-page #search-container input::placeholder {
        color: var(--siapae-secondary) !important;
        opacity: 1 !important;
    }

    .student-list-page #search-container button {
        background-color: var(--siapae-input-bg) !important;
        color: var(--siapae-text) !important;
        border-left: 1px solid var(--siapae-border) !important;
    }

    .student-list-page #search-container button:hover {
        background-color: var(--siapae-row-hover) !important;
    }

    /* Busca caso o componente utilize outra estrutura */
    .student-list-page input[placeholder="Nome do Aluno"] {
        background-color: var(--siapae-input-bg) !important;
        color: var(--siapae-text) !important;
        border: 1px solid var(--siapae-border) !important;
        box-shadow: none !important;
        outline: none !important;
    }

    .student-list-page input[placeholder="Nome do Aluno"]::placeholder {
        color: var(--siapae-secondary) !important;
        opacity: 1 !important;
    }

    .student-list-page input[placeholder="Nome do Aluno"]:focus {
        border-color: var(--siapae-green) !important;
        box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
    }


    /* =========================================================
       BOTÃO "ADICIONAR ALUNO"
       ========================================================= */

    .student-list-page .bg-blue-500,
    .student-list-page .bg-blue-600,
    .student-list-page .bg-blue-700 {
        background-color: var(--siapae-green) !important;
        background-image: none !important;
        border-color: var(--siapae-green) !important;
        color: #ffffff !important;
    }

    .student-list-page .bg-blue-500:hover,
    .student-list-page .bg-blue-600:hover,
    .student-list-page .bg-blue-700:hover {
        background-color: var(--siapae-green-dark) !important;
        border-color: var(--siapae-green-dark) !important;
        color: #ffffff !important;
    }


    /* =========================================================
       TABELA (listagem de alunos — branca)
       ========================================================= */

    .student-list-page table {
        width: 100% !important;
        background-color: var(--siapae-listing-bg) !important;
        border: 1px solid var(--siapae-border) !important;
        border-radius: 12px !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        overflow: hidden !important;
    }


    /* Cabeçalho */
    .student-list-page table thead,
    .student-list-page table thead tr {
        background-color: var(--siapae-header-bg) !important;
    }

    .student-list-page table thead th {
        background-color: var(--siapae-header-bg) !important;
        color: var(--siapae-text) !important;
        border-color: var(--siapae-border) !important;
        font-weight: 700 !important;
        padding-top: 16px !important;
        padding-bottom: 16px !important;
    }


    /* Corpo (listagem — branco) */
    .student-list-page table tbody {
        background-color: var(--siapae-listing-bg) !important;
    }

    .student-list-page table tbody tr {
        background-color: var(--siapae-listing-bg) !important;
        border-color: var(--siapae-row-border) !important;
        transition: background-color .18s ease !important;
    }

    .student-list-page table tbody tr:hover {
        background-color: var(--siapae-row-hover) !important;
    }

    .student-list-page table tbody td {
        color: var(--siapae-secondary) !important;
        border-color: var(--siapae-row-border) !important;
        padding-top: 18px !important;
        padding-bottom: 18px !important;
        font-size: 0.875rem !important;
    }


    /* Nome do estudante */
    .student-list-page table tbody td a {
        color: var(--siapae-secondary) !important;
        font-size: 0.875rem !important;
        font-weight: 400 !important;
        transition: color .18s ease !important;
        text-decoration: none !important;
    }

    .student-list-page table tbody td a:hover {
        color: var(--siapae-green) !important;
    }


    /* =========================================================
       FOTO
       ========================================================= */

    .student-list-page table tbody td img {
        border-radius: 9999px !important;
        object-fit: cover !important;
        border: 2px solid var(--siapae-green-soft) !important;
    }


    /* =========================================================
       BOTÕES DAS AÇÕES
       ========================================================= */

    .student-list-page table tbody td button,
    .student-list-page table tbody td a.action-btn {
        transition: all .18s ease !important;
    }

    .student-list-page table tbody td button:hover,
    .student-list-page table tbody td a.action-btn:hover {
        transform: translateY(-1px);
    }


    /* Botões que ainda possuem classes azuis */
    .student-list-page .text-blue-500,
    .student-list-page .text-blue-600,
    .student-list-page .text-blue-700 {
        color: var(--siapae-green) !important;
    }


    /* =========================================================
       ÍCONE / TEXTO DE NENHUM REGISTRO
       ========================================================= */

    .student-list-page table tbody .text-gray-500,
    .student-list-page table tbody .text-gray-600,
    .student-list-page table tbody .text-gray-700 {
        color: var(--siapae-secondary) !important;
    }

    .student-list-page table tbody svg {
        color: var(--siapae-green) !important;
    }


    /* =========================================================
       PAGINAÇÃO
       ========================================================= */

    .student-list-page .pagination a,
    .student-list-page .pagination button {
        border-radius: 8px !important;
        transition: all .18s ease !important;
        color: var(--siapae-text) !important;
    }

    .student-list-page .pagination .bg-blue-500,
    .student-list-page .pagination .bg-blue-600,
    .student-list-page .pagination .bg-blue-700 {
        background-color: var(--siapae-green) !important;
        color: #ffffff !important;
        border-color: var(--siapae-green) !important;
    }


    /* =========================================================
       HOVER / FOCO GERAL
       ========================================================= */

    .student-list-page button:focus,
    .student-list-page a:focus {
        outline: none !important;
    }


    /* =========================================================
       RESPONSIVIDADE
       ========================================================= */

    @media (max-width: 768px) {

        .student-list-page table {
            font-size: 14px !important;
        }

        .student-list-page table thead th,
        .student-list-page table tbody td {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }
    }
</style>