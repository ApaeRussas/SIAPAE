<x-app-layout :context="$context">

    <div class="donation-list-page">

        <x-slot name="header">
            <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl md:text-3xl font-bold leading-tight">
                    {{ __('Controle de Doações') }}
                </h2>

                <p class="hidden sm:block text-sm text-[#62746B]">
                    Atualize a página antes de exportar
                </p>
            </div>
        </x-slot>

        @if ($errors->any())
            <script>
                let errors = '';

                @foreach ($errors->all() as $error)
                    errors += '{{ $error }}\n';
                @endforeach

                alert(errors);
            </script>
        @endif

        <div class="page-content">

            <x-table
                iteration="true"
                title="Doação"
                :headers="['Nome', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez', 'Total']"
                :rows="$donations"
                :elementsExcelOrPdf="$allDonations"
                onlyHead
                withExportExcel
                withExportPdf
                withSearchSelect
                actionRoute="donation"
                :valueTotal="$valueTotal"
                :years="$years"
                :year="$year">

                @forelse ($donations as $donation)

                    <tr
                        data-id="{{ $donation->id }}"
                        id="tabela-gastos"
                        class="donation-row">

                        <td class="donation-cell donation-index">
                            {{ $loop->iteration }}
                        </td>

                        <td class="donation-cell donation-student">
                            {{ $donation->student
                                ? \Illuminate\Support\Str::words($donation->student->name, 2, ' ...')
                                : 'Estudante não encontrado'
                            }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Jan">
                            {{ $donation->Jan == '' ? '---' : $donation->Jan }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Fev">
                            {{ $donation->Fev == '' ? '---' : $donation->Fev }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Mar">
                            {{ $donation->Mar == '' ? '---' : $donation->Mar }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Abr">
                            {{ $donation->Abr == '' ? '---' : $donation->Abr }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Mai">
                            {{ $donation->Mai == '' ? '---' : $donation->Mai }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Jun">
                            {{ $donation->Jun == '' ? '---' : $donation->Jun }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Jul">
                            {{ $donation->Jul == '' ? '---' : $donation->Jul }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Ago">
                            {{ $donation->Ago == '' ? '---' : $donation->Ago }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Set">
                            {{ $donation->Set == '' ? '---' : $donation->Set }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Out">
                            {{ $donation->Out == '' ? '---' : $donation->Out }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Nov">
                            {{ $donation->Nov == '' ? '---' : $donation->Nov }}
                        </td>

                        <td class="donation-cell editable donation-month" data-field="Dez">
                            {{ $donation->Dez == '' ? '---' : $donation->Dez }}
                        </td>

                        <td class="donation-cell donation-total">
                            {{ $donation->Total == '0' ? '---' : $donation->Total }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td class="donation-empty" colspan="14">
                            Nenhum registro encontrado.
                        </td>
                    </tr>

                @endforelse

            </x-table>

        </div>

    </div>

    <style>
        .donation-list-page {
            --green: #2F7658;
            --green-dark: #245E46;
            --green-light: #E7F1EB;
            --green-hover: #F1F7F3;
            --text: #173B2D;
            --secondary: #62746B;
            --border: #D7E4DC;

            background: #EAF3ED;
            min-height: calc(100vh - 64px);
            padding-bottom: 32px;
        }

        .donation-list-page h2 {
            color: #173B2D !important;
        }

        .donation-list-page .page-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 16px 32px;
        }

        .donation-list-page .page-content > div {
            background: #FFFFFF !important;
            border: 1px solid #E0E9E3 !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 14px rgba(39, 67, 54, .06) !important;
            overflow: hidden !important;
        }

        .donation-list-page table {
            width: 100% !important;
            background: #FFFFFF !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        .donation-list-page table thead,
        .donation-list-page table thead tr,
        .donation-list-page table thead th {
            background: var(--green-light) !important;
            color: var(--green) !important;
        }

        .donation-list-page table thead th {
            border-color: var(--border) !important;
            font-weight: 700 !important;
            padding-top: 16px !important;
            padding-bottom: 16px !important;
            white-space: nowrap !important;
        }

        .donation-list-page table tbody {
            background: #FFFFFF !important;
        }

        .donation-list-page .donation-row,
        .donation-list-page .donation-row td {
            background: #FFFFFF !important;
        }

        .donation-list-page .donation-row {
            transition: background-color .18s ease !important;
        }

        .donation-list-page .donation-row:hover,
        .donation-list-page .donation-row:hover td {
            background: var(--green-hover) !important;
        }

        .donation-list-page .donation-row:hover td {
            color: var(--text) !important;
        }

        .donation-list-page .donation-cell {
            color: var(--secondary) !important;
            border-color: #E7EEE9 !important;
            border-width: 1px !important;
            padding: 12px 8px !important;
            text-align: center !important;
        }

        .donation-list-page .donation-index {
            color: #708179 !important;
            font-weight: 600 !important;
        }

        .donation-list-page .donation-student {
            color: var(--text) !important;
            font-weight: 600 !important;
            min-width: 160px !important;
            text-align: left !important;
        }

        .donation-list-page .donation-total {
            color: var(--green) !important;
            background: #F1F7F3 !important;
            font-weight: 700 !important;
        }

        .donation-list-page .donation-month {
            cursor: pointer !important;
            user-select: none !important;
            transition: background-color .18s ease, box-shadow .18s ease !important;
        }

        .donation-list-page .donation-month:hover {
            background: #DDECE3 !important;
            box-shadow: inset 0 0 0 1px #BFD7C9 !important;
            color: var(--green-dark) !important;
        }

        .donation-list-page .donation-edit-input {
            width: 80px !important;
            margin: 0 auto !important;
            padding: 6px 8px !important;
            text-align: center !important;
            color: var(--text) !important;
            background: #FFFFFF !important;
            border: 1px solid #AFC8BA !important;
            border-radius: 8px !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(47,118,88,.10) !important;
        }

        .donation-list-page #search-container {
            background: #FFFFFF !important;
            border: 1px solid #BFCFC5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
        }

        .donation-list-page #search-container input {
            background: #FFFFFF !important;
            color: var(--text) !important;
            border: none !important;
            box-shadow: none !important;
        }

        .donation-list-page #search-container input:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .donation-list-page #search-container:focus-within {
            border-color: var(--green) !important;
            box-shadow: 0 0 0 3px rgba(47,118,88,.10) !important;
        }

        .donation-list-page select {
            background: #FFFFFF !important;
            color: var(--text) !important;
            border: 1px solid #BFCFC5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
        }

        .donation-list-page select:focus {
            border-color: var(--green) !important;
            box-shadow: 0 0 0 3px rgba(47,118,88,.10) !important;
            outline: none !important;
        }

        .donation-list-page .bg-blue-500,
        .donation-list-page .bg-blue-600,
        .donation-list-page .bg-blue-700 {
            background: var(--green) !important;
            border-color: var(--green) !important;
            color: #FFFFFF !important;
        }

        .donation-list-page .bg-blue-500:hover,
        .donation-list-page .bg-blue-600:hover,
        .donation-list-page .bg-blue-700:hover {
            background: var(--green-dark) !important;
            border-color: var(--green-dark) !important;
            color: #FFFFFF !important;
        }

        .donation-list-page .text-blue-500,
        .donation-list-page .text-blue-600,
        .donation-list-page .text-blue-700 {
            color: var(--green) !important;
        }

        .donation-list-page .border-blue-500,
        .donation-list-page .border-blue-600,
        .donation-list-page .border-blue-700 {
            border-color: var(--green) !important;
        }

        .donation-list-page button:hover,
        .donation-list-page a:hover {
            opacity: 1 !important;
        }

        .donation-list-page .donation-empty {
            padding: 20px !important;
            color: var(--secondary) !important;
            background: #FFFFFF !important;
            text-align: center !important;
        }

        @media (max-width: 768px) {
            .donation-list-page .page-content {
                padding: 16px 10px 24px;
            }

            .donation-list-page table {
                font-size: 13px !important;
                min-width: 1000px !important;
            }

            .donation-list-page .donation-cell {
                padding: 9px 5px !important;
            }
        }

        /* FUNDO DA PÁGINA */
        .educational-list-page,
        .expense-list-page,
        .regional-list-page,
        .scfv-page,
        .donation-page {
            background-color: #EAF3ED !important;
            min-height: calc(100vh - 64px);
        }

        /* REMOVE A CAIXA BRANCA CRIADA AO REDOR DA TABELA */
        .educational-list-page div:has(table),
        .expense-list-page div:has(table),
        .regional-list-page div:has(table),
        .scfv-page div:has(table),
        .donation-page div:has(table) {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        /* A TABELA CONTINUA BRANCA */
        .educational-list-page table,
        .expense-list-page table,
        .regional-list-page table,
        .scfv-page table,
        .donation-page table {
            background-color: #FFFFFF !important;
            border: 1px solid #DCE7E1 !important;
            border-radius: 12px !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            overflow: hidden !important;
        }

        /* CABEÇALHO VERDE */
        .educational-list-page table thead,
        .educational-list-page table thead tr,
        .expense-list-page table thead,
        .expense-list-page table thead tr,
        .regional-list-page table thead,
        .regional-list-page table thead tr,
        .scfv-page table thead,
        .scfv-page table thead tr,
        .donation-page table thead,
        .donation-page table thead tr {
            background-color: #EAF3ED !important;
        }

        /* CÉLULAS DO CABEÇALHO */
        .educational-list-page table thead th,
        .expense-list-page table thead th,
        .regional-list-page table thead th,
        .scfv-page table thead th,
        .donation-page table thead th {
            background-color: #EAF3ED !important;
            color: #286048 !important;
            border-color: #D6E5DC !important;
            font-weight: 700 !important;
        }

        /* CORPO SEMPRE BRANCO */
        .educational-list-page table tbody,
        .expense-list-page table tbody,
        .regional-list-page table tbody,
        .scfv-page table tbody,
        .donation-page table tbody {
            background-color: #FFFFFF !important;
        }

        /* LINHAS */
        .educational-list-page table tbody tr,
        .expense-list-page table tbody tr,
        .regional-list-page table tbody tr,
        .scfv-page table tbody tr,
        .donation-page table tbody tr {
            background-color: #FFFFFF !important;
            color: #334E68 !important;
            transition: background-color .18s ease !important;
        }

        /* HOVER SEM SUMIR */
        .educational-list-page table tbody tr:hover,
        .expense-list-page table tbody tr:hover,
        .regional-list-page table tbody tr:hover,
        .scfv-page table tbody tr:hover,
        .donation-page table tbody tr:hover {
            background-color: #F1F7F3 !important;
            color: #334E68 !important;
        }

        /* CÉLULAS */
        .educational-list-page table tbody td,
        .expense-list-page table tbody td,
        .regional-list-page table tbody td,
        .scfv-page table tbody td,
        .donation-page table tbody td {
            background-color: transparent !important;
            color: #334E68 !important;
            border-color: #E2ECE6 !important;
        }

        /* LINKS NÃO SOMEM NO HOVER */
        .educational-list-page table tbody td a,
        .expense-list-page table tbody td a,
        .regional-list-page table tbody td a,
        .scfv-page table tbody td a,
        .donation-page table tbody td a {
            color: #286048 !important;
        }

        .educational-list-page table tbody td a:hover,
        .expense-list-page table tbody td a:hover,
        .regional-list-page table tbody td a:hover,
        .scfv-page table tbody td a:hover,
        .donation-page table tbody td a:hover {
            color: #1F513A !important;
        }

        /* CAMPOS DE PREENCHIMENTO */
        .educational-list-page input,
        .educational-list-page select,
        .expense-list-page input,
        .expense-list-page select,
        .regional-list-page input,
        .regional-list-page select,
        .scfv-page input,
        .scfv-page select,
        .donation-page input,
        .donation-page select {
            background-color: #FFFFFF !important;
            color: #102A43 !important;
            border: 1px solid #C9D9D0 !important;
        }

        /* FOCO DOS CAMPOS */
        .educational-list-page input:focus,
        .educational-list-page select:focus,
        .expense-list-page input:focus,
        .expense-list-page select:focus,
        .regional-list-page input:focus,
        .regional-list-page select:focus,
        .scfv-page input:focus,
        .scfv-page select:focus,
        .donation-page input:focus,
        .donation-page select:focus {
            border-color: #327A58 !important;
            box-shadow: 0 0 0 3px rgba(50, 122, 88, 0.12) !important;
            outline: none !important;
        }

        /* REMOVE SOMBRAS DAS CAIXAS EXTERNAS */
        .educational-list-page .shadow,
        .educational-list-page .shadow-sm,
        .educational-list-page .shadow-md,
        .expense-list-page .shadow,
        .expense-list-page .shadow-sm,
        .expense-list-page .shadow-md,
        .regional-list-page .shadow,
        .regional-list-page .shadow-sm,
        .regional-list-page .shadow-md,
        .scfv-page .shadow,
        .scfv-page .shadow-sm,
        .scfv-page .shadow-md,
        .donation-page .shadow,
        .donation-page .shadow-sm,
        .donation-page .shadow-md {
            box-shadow: none !important;
        }

        /* BOTÕES VERDES */
        .educational-list-page .bg-blue-500,
        .educational-list-page .bg-blue-600,
        .educational-list-page .bg-blue-700,
        .expense-list-page .bg-blue-500,
        .expense-list-page .bg-blue-600,
        .expense-list-page .bg-blue-700,
        .regional-list-page .bg-blue-500,
        .regional-list-page .bg-blue-600,
        .regional-list-page .bg-blue-700,
        .scfv-page .bg-blue-500,
        .scfv-page .bg-blue-600,
        .scfv-page .bg-blue-700,
        .donation-page .bg-blue-500,
        .donation-page .bg-blue-600,
        .donation-page .bg-blue-700 {
            background-color: #327A58 !important;
            border-color: #327A58 !important;
            color: #FFFFFF !important;
        }

        /* HOVER DOS BOTÕES */
        .educational-list-page .bg-blue-500:hover,
        .educational-list-page .bg-blue-600:hover,
        .educational-list-page .bg-blue-700:hover,
        .expense-list-page .bg-blue-500:hover,
        .expense-list-page .bg-blue-600:hover,
        .expense-list-page .bg-blue-700:hover,
        .regional-list-page .bg-blue-500:hover,
        .regional-list-page .bg-blue-600:hover,
        .regional-list-page .bg-blue-700:hover,
        .scfv-page .bg-blue-500:hover,
        .scfv-page .bg-blue-600:hover,
        .scfv-page .bg-blue-700:hover,
        .donation-page .bg-blue-500:hover,
        .donation-page .bg-blue-600:hover,
        .donation-page .bg-blue-700:hover {
            background-color: #245E43 !important;
            border-color: #245E43 !important;
            color: #FFFFFF !important;
        }

        /* ÁREAS EDITÁVEIS DA DOAÇÃO */
        .donation-page .donation-month {
            background-color: #FFFFFF !important;
            cursor: pointer !important;
            color: #334E68 !important;
        }

        .donation-page .donation-month:hover {
            background-color: #EDF5F0 !important;
            color: #1F513A !important;
            box-shadow: inset 0 0 0 1px #BFD8C9 !important;
        }

        /* INPUT CRIADO NA EDIÇÃO DA DOAÇÃO */
        .donation-page .donation-edit-input {
            background-color: #FFFFFF !important;
            color: #102A43 !important;
            border: 1px solid #327A58 !important;
            border-radius: 7px !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(50, 122, 88, 0.12) !important;
        }

        /* TOTAL DA DOAÇÃO */
        .donation-page .donation-total {
            background-color: #F4F8F5 !important;
            color: #1F513A !important;
            font-weight: 700 !important;
        }

        /* NUNCA DEIXAR A LINHA DE DOAÇÃO SUMIR NO HOVER */
        .donation-page .donation-row:hover td {
            background-color: #F1F7F3 !important;
            color: #334E68 !important;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '#tabela-gastos .editable', function () {

                if ($(this).find('input').length) {
                    return;
                }

                let currentText = $(this).text().trim();

                if (currentText === '---') {
                    currentText = '';
                }

                const cell = $(this);

                const inputField = $('<input>', {
                    value: currentText,
                    class: 'donation-edit-input',
                    type: 'text'
                });

                cell.html(inputField);

                inputField.focus();
                inputField.select();

                inputField.on('blur', function () {

                    let newValue = $(this).val().trim();

                    const field = cell.data('field');
                    const rowId = cell.closest('tr').data('id');

                    const displayValue = newValue === '' ? '---' : newValue;

                    cell.html(displayValue);

                    $.ajax({
                        url: '/donation/' + rowId,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            field: field,
                            value: newValue
                        }
                    });
                });

                inputField.on('keydown', function (event) {

                    if (event.key === 'Enter') {
                        $(this).blur();
                    }

                    if (event.key === 'Escape') {
                        cell.html(currentText === '' ? '---' : currentText);
                    }
                });
            });
        });
    </script>

</x-app-layout>