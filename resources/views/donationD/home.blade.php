<x-app-layout :context="$context">

    <div class="donation-page">

        <x-slot name="header">
            <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">

                <div class="flex justify-between items-center w-full">

                    <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                        {{ __('Controle de Doações') }}
                    </h2>

                    <p class="hidden sm:block py-2 text-xs md:text-base opacity-50 text-[#66788A]">
                        (Atualize a Página Antes de Exportar)
                    </p>

                </div>

            </div>
        </x-slot>


        {{-- =====================================================
             MENSAGENS DE ERRO
             ===================================================== --}}

        @if ($errors->any())
            <script>
                let errors = '';

                @foreach ($errors->all() as $error)
                    errors += '{{ $error }}\n';
                @endforeach

                alert(errors);
            </script>
        @endif


        {{-- =====================================================
             TABELA DE DOAÇÕES
             ===================================================== --}}

        <x-table
            iteration="true"
            title="Doação"
            :headers="['Nome', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez', 'Total']"
            :rows="$donations"
            :elementsExcelOrPdf="$allDonations"
            onlyHead
            notButtonAdd
            notActions
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

                    {{-- Nº --}}
                    <td class="donation-cell donation-index">
                        {{ $loop->iteration }}
                    </td>

                    {{-- NOME --}}
                    <td class="donation-cell donation-student">
                        {{ $donation->student
                            ? \Illuminate\Support\Str::words($donation->student->name, 2, ' ...')
                            : 'Estudante não encontrado'
                        }}
                    </td>


                    {{-- JANEIRO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Jan">
                        {{ $donation->Jan == '' ? '---' : $donation->Jan }}
                    </td>


                    {{-- FEVEREIRO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Fev">
                        <div class="flex justify-center items-center">
                            {{ $donation->Fev == '' ? '---' : $donation->Fev }}
                        </div>
                    </td>


                    {{-- MARÇO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Mar">
                        <div class="flex justify-center items-center">
                            {{ $donation->Mar == '' ? '---' : $donation->Mar }}
                        </div>
                    </td>


                    {{-- ABRIL --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Abr">
                        <div class="flex justify-center items-center">
                            {{ $donation->Abr == '' ? '---' : $donation->Abr }}
                        </div>
                    </td>


                    {{-- MAIO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Mai">
                        <div class="flex justify-center items-center">
                            {{ $donation->Mai == '' ? '---' : $donation->Mai }}
                        </div>
                    </td>


                    {{-- JUNHO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Jun">
                        <div class="flex justify-center items-center">
                            {{ $donation->Jun == '' ? '---' : $donation->Jun }}
                        </div>
                    </td>


                    {{-- JULHO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Jul">
                        <div class="flex justify-center items-center">
                            {{ $donation->Jul == '' ? '---' : $donation->Jul }}
                        </div>
                    </td>


                    {{-- AGOSTO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Ago">
                        <div class="flex justify-center items-center">
                            {{ $donation->Ago == '' ? '---' : $donation->Ago }}
                        </div>
                    </td>


                    {{-- SETEMBRO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Set">
                        <div class="flex justify-center items-center">
                            {{ $donation->Set == '' ? '---' : $donation->Set }}
                        </div>
                    </td>


                    {{-- OUTUBRO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Out">
                        <div class="flex justify-center items-center">
                            {{ $donation->Out == '' ? '---' : $donation->Out }}
                        </div>
                    </td>


                    {{-- NOVEMBRO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Nov">
                        <div class="flex justify-center items-center">
                            {{ $donation->Nov == '' ? '---' : $donation->Nov }}
                        </div>
                    </td>


                    {{-- DEZEMBRO --}}
                    <td
                        class="donation-cell editable donation-month"
                        data-field="Dez">
                        <div class="flex justify-center items-center">
                            {{ $donation->Dez == '' ? '---' : $donation->Dez }}
                        </div>
                    </td>


                    {{-- TOTAL --}}
                    <td class="donation-cell donation-total">
                        <div class="flex justify-center items-center">
                            {{ $donation->Total == '0' ? '---' : $donation->Total }}
                        </div>
                    </td>

                </tr>

            @empty

                <tr class="text-center">
                    <td
                        class="donation-empty"
                        colspan="{{ 14 }}">
                        Nenhum registro encontrado.
                    </td>
                </tr>

            @endforelse

        </x-table>

    </div>


    <style>
        /* =========================================================
           CONTROLE DE DOAÇÕES
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .donation-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .donation-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .donation-page .border-gray-200,
        .donation-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .donation-page .shadow,
        .donation-page .shadow-sm,
        .donation-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TABELA
           ========================================================= */

        .donation-page table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }


        /* Cabeçalho */

        .donation-page table thead {
            background-color: #F4F6F8 !important;
        }

        .donation-page table thead th {
            color: #102A43 !important;
            background-color: #F4F6F8 !important;
            border-color: #E1E7EC !important;
            font-weight: 600;
            white-space: nowrap;
        }


        /* Linhas */

        .donation-page .donation-row {
            background-color: #FFFFFF !important;
            transition: background-color 0.18s ease;
        }

        .donation-page .donation-row:hover {
            background-color: #F8FAF9 !important;
        }


        /* Células */

        .donation-page .donation-cell {
            color: #334E68 !important;
            border-color: #E8EDF1 !important;
            border-width: 1px;
            padding: 0.7rem 0.45rem;
            text-align: center;
        }


        /* Número */

        .donation-page .donation-index {
            color: #66788A !important;
            font-weight: 500;
        }


        /* Nome do estudante */

        .donation-page .donation-student {
            color: #102A43 !important;
            font-weight: 500;
            min-width: 160px;
        }


        /* Total */

        .donation-page .donation-total {
            color: #102A43 !important;
            font-weight: 600;
            background-color: #F8FAF9 !important;
        }


        /* =========================================================
           CÉLULAS EDITÁVEIS
           ========================================================= */

        .donation-page .donation-month {
            cursor: pointer;
            user-select: none;
            transition:
                background-color 0.18s ease,
                box-shadow 0.18s ease;
        }

        .donation-page .donation-month:hover {
            background-color: #EDF5F0 !important;
            box-shadow: inset 0 0 0 1px #C9DED1;
        }


        /* Input criado pelo JavaScript */

        .donation-page .donation-edit-input {
            width: 5rem;
            margin: 0;
            padding: 0.35rem 0.45rem;
            text-align: center;
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 8px !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }


        /* =========================================================
           BUSCA
           ========================================================= */

        .donation-page #search-container {
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .donation-page #search-container input {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        .donation-page #search-container input::placeholder {
            color: #8091A5 !important;
        }

        .donation-page #search-container:focus-within {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }


        /* =========================================================
           SELECT DE ANO
           ========================================================= */

        .donation-page select {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
        }

        .donation-page select:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           BOTÕES DE EXPORTAÇÃO / COMPONENTE x-table
           ========================================================= */

        .donation-page .bg-blue-500,
        .donation-page .bg-blue-600,
        .donation-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .donation-page .bg-blue-500:hover,
        .donation-page .bg-blue-600:hover,
        .donation-page .bg-blue-700:hover,
        .donation-page .hover\:bg-blue-600:hover,
        .donation-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           BOTÕES E LINKS
           ========================================================= */

        .donation-page button,
        .donation-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           PAGINAÇÃO
           ========================================================= */

        .donation-page nav .bg-blue-500,
        .donation-page nav .bg-blue-600 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .donation-page nav .bg-blue-500:hover,
        .donation-page nav .bg-blue-600:hover {
            background-color: #2F684A !important;
        }


        /* =========================================================
           ESTADO VAZIO
           ========================================================= */

        .donation-page .donation-empty {
            padding: 1rem;
            color: #66788A !important;
            background-color: #FFFFFF !important;
            border-color: #E1E7EC !important;
            font-weight: 400;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 768px) {

            .donation-page {
                padding-bottom: 1rem;
            }

            .donation-page table {
                font-size: 0.82rem;
            }

            .donation-page .donation-cell {
                padding: 0.55rem 0.3rem;
            }

            .donation-page .donation-student {
                min-width: 130px;
            }
        }

        @media (max-width: 640px) {

            .donation-page table {
                min-width: 900px;
            }
        }
    </style>


    {{-- =========================================================
         EDIÇÃO INLINE DAS DOAÇÕES
         ========================================================= --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {

            // Quando o usuário clicar em uma célula para editar
            $('#tabela-gastos .editable').on('click', function () {

                var currentText = $(this).text().trim();

                if (currentText == '---') {
                    currentText = '';
                }

                var inputField = $('<input>', {
                    value: currentText,
                    class: 'donation-edit-input',
                    type: 'text',
                    oninput: 'maskMoedaDonation(event)',
                });

                $(this).html(inputField);

                inputField.focus();


                // Quando o usuário sair da célula
                inputField.on('blur', function () {

                    var newValue = $(this).val();

                    var field = $(this)
                        .closest('td')
                        .data('field');

                    var rowId = $(this)
                        .closest('tr')
                        .data('id');


                    // Atualiza visualmente a célula
                    $(this)
                        .closest('td')
                        .html(newValue);


                    if (newValue === '0,01') {
                        newValue = '---';
                    }


                    // Envia a atualização para o servidor
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

            });

        });
    </script>

</x-app-layout>