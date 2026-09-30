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
        .regional-create-page {
            background-color: #EAF3ED;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }

        .regional-create-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .regional-create-page input,
        .regional-create-page select,
        .regional-create-page textarea {
            background-color: #FFFFFF !important;
            color: #334E68 !important;
            border-color: #D7DEE5 !important;
        }

        .regional-create-page input:focus,
        .regional-create-page select:focus,
        .regional-create-page textarea:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }

        .regional-create-page button[type="submit"] {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .regional-create-page button[type="submit"]:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
        }

        .regional-create-page label {
            color: #334E68;
        }
    </style>
</x-app-layout>