<x-app-layout>

    <div class="regional-create-page">

        <x-table-create
            title="Relatório Regional"
            :labelsVariablesTypes="[
                ['Título do Relatório', 'title', 'text'],
                ['Subtítulo', 'subtitle', 'text'],
                ['Texto do Relatório', 'text', 'textarea'],
                ['Data do Relatório', 'date', 'date'],
                ['Assinatura do(a) Cordenador(a) Responsável', 'signature_id', 'select'],
            ]"
            :selects="$coordinators"
            actionRoute="regional"
        />

    </div>


    <style>
        /* =========================================================
           RELATÓRIO REGIONAL - CRIAÇÃO
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .regional-create-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .regional-create-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .regional-create-page .border-gray-200,
        .regional-create-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .regional-create-page .shadow,
        .regional-create-page .shadow-sm,
        .regional-create-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TÍTULO
           ========================================================= */

        .regional-create-page h1,
        .regional-create-page h2,
        .regional-create-page h3 {
            color: #102A43 !important;
        }


        /* =========================================================
           LABELS
           ========================================================= */

        .regional-create-page label {
            color: #334E68 !important;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }


        /* =========================================================
           CAMPOS
           ========================================================= */

        .regional-create-page input,
        .regional-create-page textarea,
        .regional-create-page select {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;

            transition:
                border-color 0.18s ease,
                box-shadow 0.18s ease,
                background-color 0.18s ease;
        }


        /* Placeholder */

        .regional-create-page input::placeholder,
        .regional-create-page textarea::placeholder,
        .regional-create-page select::placeholder {
            color: #8091A5 !important;
            opacity: 1;
        }


        /* Foco */

        .regional-create-page input:focus,
        .regional-create-page textarea:focus,
        .regional-create-page select:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           BOTÕES AZUIS -> VERDE SIAPAE
           ========================================================= */

        .regional-create-page .bg-blue-500,
        .regional-create-page .bg-blue-600,
        .regional-create-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .regional-create-page .bg-blue-500:hover,
        .regional-create-page .bg-blue-600:hover,
        .regional-create-page .bg-blue-700:hover,
        .regional-create-page .hover\:bg-blue-600:hover,
        .regional-create-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           LINKS
           ========================================================= */

        .regional-create-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }

        .regional-create-page a:hover {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           BOTÕES
           ========================================================= */

        .regional-create-page button {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           TEXTOS SECUNDÁRIOS
           ========================================================= */

        .regional-create-page .text-gray-500,
        .regional-create-page .text-gray-600 {
            color: #66788A !important;
        }

        .regional-create-page .text-gray-700,
        .regional-create-page .text-gray-800 {
            color: #334E68 !important;
        }


        /* =========================================================
           ERROS DE VALIDAÇÃO
           ========================================================= */

        .regional-create-page .text-red-600,
        .regional-create-page .text-red-700 {
            color: #B42318 !important;
        }

        .regional-create-page .text-red-500 {
            color: #B42318 !important;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 640px) {

            .regional-create-page {
                padding-bottom: 1rem;
            }

            .regional-create-page label {
                font-size: 0.88rem;
            }
        }
    </style>

</x-app-layout>