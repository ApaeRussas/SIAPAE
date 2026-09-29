<x-app-layout :context="$context">

    <div class="frequency-page">

        <x-slot name="header">
            <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">

                <div class="flex items-center gap-x-1">

                    <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                        {{ __('Lista de Frequência') }}
                    </h2>

                    <x-button
                        button
                        variant="question"
                        class="mt-1 sm:mt-2 frequency-info-button"
                        size="sm"
                        onclick="guestText('info', 'Esse setor possui a ferramenta de busca com o turno do aluno em questão, mês/ano e o professor responsável pelo atendimento a qual se refere a lista de frequência, em que o único campo obrigatório de pesquisa é o mês/ano. <br> <br> Legenda: <br> dos botões (o que cada símbolo significa): <br> <span class=&quot;text-[#8091A5]&quot;> - : Neutro ou Indiferente </span> <br> <span class=&quot;text-[#B42318]&quot;> x : Falta Confirmada</span> <br> <span class=&quot;text-[#3B7D5A]&quot;> ✓ : Presença Confirmada</span> <br> dos campos sem botões: <br> <div class=&quot;flex items-center&quot;> <hr class=&quot;w-[18px] border-[#B8C7BE] mr-2 mb-4&quot;>: Dia de semana em que o aluno não tem atendimento ou fériado </div> x : Fim de semana (mascara/não mostra um feriado) <br> <br> Essa tabela contabiliza as faltas e seu dia em questão, além disso pode-se justificar a falta do aluno no campo apropriado além de registrar a assinatura do professor responsável.')"
                    >
                        <x-icons.question />
                    </x-button>

                </div>

            </div>
        </x-slot>


        {{-- =====================================================
             ERROS
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
             VARIÁVEIS DE PESQUISA
             ===================================================== --}}

        @php

            $variablesSearchFrequency =
                $turn_apae . '-' . $monthYear . '-' . $professor_id;

        @endphp


        {{-- =====================================================
             TABELA
             ===================================================== --}}

        <x-table
            title="Frequência"
            :headers="array_merge(['Nome'], $days, ['Faltas'])"
            headersSmall
            :rows="$frequencies"
            :professors="$professors"
            onlyHead
            headFrequency
            withSearchFrequency
            :variablesSearchFrequency="$variablesSearchFrequency"
            iteration="true"
        >

            @forelse ($frequencies as $frequency)

                <tr
                    data-id="{{ $frequency->id }}"
                    class="frequency-row"
                >

                    {{-- =================================================
                         NÚMERO
                         ================================================= --}}

                    <td class="frequency-cell frequency-index">

                        {{ $loop->iteration }}

                    </td>


                    {{-- =================================================
                         NOME
                         ================================================= --}}

                    <td
                        class="frequency-cell frequency-student"
                        onclick="show('{{ route('student.show', $frequency->student->id) }}')"
                    >

                        {{ \Illuminate\Support\Str::limit($frequency->student->name, 14, '...') }}

                    </td>


                    {{-- =================================================
                         DIAS
                         ================================================= --}}

                    @for ($day = 1; $day <= $numberDaysInMonth; $day++)

                        @php

                            list($month, $year) = explode('/', $monthYear);

                            $date = sprintf(
                                "%04d-%02d-%02d",
                                $year,
                                $month,
                                $day
                            );

                            $isNonClickable =
                                in_array(
                                    $date,
                                    $frequency->nonClickableDays
                                );

                            $isWeekend =
                                in_array(
                                    $date,
                                    $frequency->weekends
                                );

                        @endphp


                        <td class="frequency-day-cell">

                            @if (!$isNonClickable)

                                <x-button
                                    class="btn-toggle frequency-toggle
                                        {{
                                            $frequency->$day === true
                                                ? 'success frequency-present'
                                                : (
                                                    $frequency->$day === false
                                                        ? 'danger frequency-absent'
                                                        : 'indifferent frequency-neutral'
                                                )
                                        }}
                                    "
                                    variant="{{
                                        $frequency->$day === true
                                            ? 'success'
                                            : (
                                                $frequency->$day === false
                                                    ? 'danger'
                                                    : 'indifferent'
                                            )
                                    }}"
                                    size="hyper-sm"
                                    data-frequency="{{ $frequency->id }}"
                                    data-day="{{ $day }}"
                                >

                                    <i
                                        class="fas
                                        {{
                                            $frequency->$day === true
                                                ? 'fa-check frequency-icon-check'
                                                : (
                                                    $frequency->$day === false
                                                        ? 'fa-times frequency-icon-times'
                                                        : 'fa-minus frequency-icon-minus'
                                                )
                                        }}"
                                    ></i>

                                </x-button>

                            @elseif ($isWeekend)

                                <span class="frequency-weekend">
                                    X
                                </span>

                            @else

                                <hr class="frequency-unavailable">

                            @endif

                        </td>

                    @endfor


                    {{-- =================================================
                         FALTAS
                         ================================================= --}}

                    <td class="frequency-cell frequency-absences">

                        <h3>
                            {{ $frequency->countAbsences }}
                        </h3>

                    </td>

                </tr>


            @empty

                <tr class="text-center">

                    <td
                        class="frequency-empty"
                        colspan="{{ (int) $numberDaysInMonth + 3 }}"
                    >
                        Nenhum registro encontrado.
                    </td>

                </tr>

            @endforelse

        </x-table>


        {{-- =====================================================
             OBSERVAÇÕES E ASSINATURA
             ===================================================== --}}

        @if (isset($monthYear) && count($frequencies) != 0)

            <div class="py-4">

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="frequency-observation-card">

                        <form
                            action="{{ route('frequency_details.update') }}"
                            class="p-6"
                            method="POST"
                        >

                            @csrf


                            <input
                                type="hidden"
                                name="frequencies"
                                value="{{ json_encode($frequencies) }}"
                            >


                            {{-- OBSERVAÇÕES --}}
                            <div class="mb-5">

                                <label
                                    for="observation"
                                    class="frequency-form-label"
                                >
                                    Observações:
                                    <span class="frequency-optional">
                                        (*opcional)
                                    </span>
                                </label>

                                <x-form.textarea
                                    name="observation"
                                    id="observation"
                                    class="h-32 mt-2 frequency-field"
                                    sizeFont="base"
                                    placeholder="Ex: O Aluno *** faltou dia ** pois estava doente ....."
                                    data-observation=""
                                >
                                    {{ old('observation', $observation) }}
                                </x-form.textarea>

                            </div>


                            {{-- ASSINATURA / ATUALIZAR --}}
                            <div class="grid sm:grid-cols-2 gap-y-4 gap-x-5">

                                <div>

                                    <label
                                        for="signature_id"
                                        class="frequency-form-label"
                                    >
                                        Assinatura do Professor:
                                    </label>

                                    <x-form.select
                                        valueName="signature_id"
                                        idSelect="signature_id"
                                        class="frequency-select"
                                    >

                                        <option value="">
                                            Selecione o Nome:
                                        </option>

                                        @foreach ($professors as $professor)

                                            <option
                                                value="{{ $professor->id }}"
                                                {{ old('signature_id', $signature_id) == $professor->id ? 'selected' : '' }}
                                            >
                                                {{ $professor->name }}
                                            </option>

                                        @endforeach

                                    </x-form.select>

                                </div>


                                <div class="sm:flex sm:justify-end sm:items-end">

                                    <x-button class="frequency-update-button">

                                        Atualizar

                                    </x-button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endif

    </div>


    <style>
        /* =========================================================
           LISTA DE FREQUÊNCIA
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .frequency-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .frequency-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .frequency-page .border-gray-200,
        .frequency-page .border-gray-300,
        .frequency-page .border-gray-600 {
            border-color: #E1E7EC !important;
        }

        .frequency-page .shadow,
        .frequency-page .shadow-sm,
        .frequency-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TABELA
           ========================================================= */

        .frequency-page table thead {
            background-color: #F4F6F8 !important;
        }

        .frequency-page table thead th {
            background-color: #F4F6F8 !important;
            color: #102A43 !important;
            border-color: #E1E7EC !important;
            font-weight: 600;
        }


        /* =========================================================
           LINHAS
           ========================================================= */

        .frequency-page .frequency-row {
            background-color: #FFFFFF !important;
            transition: background-color 0.18s ease;
        }

        .frequency-page .frequency-row:hover {
            background-color: #F8FAF9 !important;
        }


        /* =========================================================
           CÉLULAS
           ========================================================= */

        .frequency-page .frequency-cell {
            padding: 0.7rem 0.45rem;
            text-align: center;
            color: #334E68 !important;
            border: 1px solid #E8EDF1 !important;
        }

        .frequency-page .frequency-index {
            color: #66788A !important;
            font-weight: 500;
        }


        /* =========================================================
           ALUNO
           ========================================================= */

        .frequency-page .frequency-student {
            padding-left: 0.65rem;
            padding-right: 0.65rem;
            color: #102A43 !important;
            font-weight: 500;
            cursor: pointer;
        }

        .frequency-page .frequency-student:hover {
            color: #3B7D5A !important;
            background-color: #EDF5F0 !important;
        }


        /* =========================================================
           CÉLULAS DOS DIAS
           ========================================================= */

        .frequency-page .frequency-day-cell {
            min-width: 38px;
            padding: 0.3rem 0.2rem;
            text-align: center;
            border: 1px solid #E8EDF1 !important;
            background-color: #FFFFFF !important;
        }


        /* =========================================================
           PRESENÇA
           ========================================================= */

        .frequency-page .frequency-present {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }

        .frequency-page .frequency-present:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
        }


        /* =========================================================
           FALTA
           ========================================================= */

        .frequency-page .frequency-absent {
            background-color: #C98B45 !important;
            border-color: #C98B45 !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }

        .frequency-page .frequency-absent:hover {
            background-color: #A96F31 !important;
            border-color: #A96F31 !important;
        }


        /* =========================================================
           NEUTRO
           ========================================================= */

        .frequency-page .frequency-neutral {
            background-color: #B8C7BE !important;
            border-color: #B8C7BE !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }

        .frequency-page .frequency-neutral:hover {
            background-color: #9EADA4 !important;
            border-color: #9EADA4 !important;
        }


        /* =========================================================
           ÍCONES
           ========================================================= */

        .frequency-page .frequency-icon-check,
        .frequency-page .frequency-icon-times,
        .frequency-page .frequency-icon-minus {
            color: #FFFFFF !important;
        }


        /* =========================================================
           FIM DE SEMANA
           ========================================================= */

        .frequency-page .frequency-weekend {
            color: #8091A5 !important;
            font-size: 0.82rem;
            font-weight: 600;
        }


        /* =========================================================
           DIA SEM ATENDIMENTO / FERIADO
           ========================================================= */

        .frequency-page .frequency-unavailable {
            margin-left: 0.25rem;
            margin-right: 0.25rem;
            border-color: #B8C7BE !important;
        }


        /* =========================================================
           CONTADOR DE FALTAS
           ========================================================= */

        .frequency-page .frequency-absences {
            color: #102A43 !important;
            font-weight: 600;
            background-color: #F8FAF9 !important;
        }

        .frequency-page .frequency-absences h3 {
            color: #102A43 !important;
            font-weight: 600;
        }


        /* =========================================================
           REGISTRO VAZIO
           ========================================================= */

        .frequency-page .frequency-empty {
            padding: 1rem;
            color: #66788A !important;
            background-color: #FFFFFF !important;
            border: 1px solid #E1E7EC !important;
        }


        /* =========================================================
           CARD DE OBSERVAÇÕES
           ========================================================= */

        .frequency-page .frequency-observation-card {
            background-color: #FFFFFF !important;
            overflow: hidden;
            border-radius: 16px;
            border: 1px solid #E1E7EC !important;
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           LABELS DO FORMULÁRIO
           ========================================================= */

        .frequency-page .frequency-form-label {
            display: block;
            color: #334E68 !important;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .frequency-page .frequency-optional {
            color: #8091A5 !important;
            font-size: 0.82rem;
            font-weight: 400;
        }


        /* =========================================================
           TEXTAREA / SELECT
           ========================================================= */

        .frequency-page .frequency-field,
        .frequency-page textarea,
        .frequency-page select {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
            transition:
                border-color 0.18s ease,
                box-shadow 0.18s ease;
        }

        .frequency-page textarea::placeholder,
        .frequency-page input::placeholder {
            color: #8091A5 !important;
            opacity: 1;
        }

        .frequency-page textarea:focus,
        .frequency-page select:focus,
        .frequency-page input:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           BOTÃO ATUALIZAR
           ========================================================= */

        .frequency-page .frequency-update-button {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }

        .frequency-page .frequency-update-button:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
        }


        /* =========================================================
           BOTÕES DO x-table / FILTROS
           ========================================================= */

        .frequency-page .bg-blue-500,
        .frequency-page .bg-blue-600,
        .frequency-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .frequency-page .bg-blue-500:hover,
        .frequency-page .bg-blue-600:hover,
        .frequency-page .bg-blue-700:hover,
        .frequency-page .hover\:bg-blue-600:hover,
        .frequency-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
        }


        /* =========================================================
           CAMPO DE BUSCA
           ========================================================= */

        .frequency-page #search-container {
            background-color: #FFFFFF !important;
            border: 1px solid #D7DEE5 !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .frequency-page #search-container input {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        .frequency-page #search-container input::placeholder {
            color: #8091A5 !important;
        }

        .frequency-page #search-container:focus-within {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }


        /* =========================================================
           PAGINAÇÃO
           ========================================================= */

        .frequency-page nav .bg-blue-500,
        .frequency-page nav .bg-blue-600 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .frequency-page nav .bg-blue-500:hover,
        .frequency-page nav .bg-blue-600:hover {
            background-color: #2F684A !important;
        }


        /* =========================================================
           BOTÃO DE INFORMAÇÕES
           ========================================================= */

        .frequency-page .frequency-info-button {
            color: #3B7D5A !important;
        }


        /* =========================================================
           TRANSIÇÕES
           ========================================================= */

        .frequency-page button,
        .frequency-page a {
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

            .frequency-page {
                padding-bottom: 1rem;
            }

            .frequency-page table {
                font-size: 0.82rem;
            }

            .frequency-page .frequency-cell {
                padding: 0.55rem 0.3rem;
            }

            .frequency-page .frequency-day-cell {
                min-width: 34px;
                padding: 0.25rem 0.15rem;
            }

            .frequency-page .frequency-student {
                min-width: 110px;
            }
        }

        @media (max-width: 640px) {

            .frequency-page table {
                min-width: 900px;
            }

            .frequency-page .frequency-observation-card {
                border-radius: 12px;
            }
        }
    </style>


    {{-- =========================================================
         AJAX - ALTERAÇÃO DA FREQUÊNCIA
         ========================================================= --}}

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <script>

        $(document).ready(function () {

            $('.btn-toggle').click(function () {

                let frequencyId =
                    $(this).data('frequency');

                let day =
                    $(this).data('day');

                let statusAtual =
                    $(this).hasClass('success')
                        ? 1
                        : (
                            $(this).hasClass('danger')
                                ? 0
                                : null
                        );


                // Alterna o status

                let novoStatus =
                    statusAtual === 0
                        ? 1
                        : (
                            statusAtual === 1
                                ? null
                                : 0
                        );


                // Requisição AJAX

                $.ajax({

                    url:
                        '/frequency/' + frequencyId,

                    method:
                        'PUT',

                    data: {

                        frequencyId:
                            frequencyId,

                        day:
                            day,

                        status:
                            novoStatus,

                        _token:
                            '{{ csrf_token() }}',

                    },


                    success:
                        function (response) {

                            if (response.success) {

                                let $button =
                                    $(
                                        `[data-frequency="${frequencyId}"][data-day="${day}"]`
                                    );


                                // Remove os estados anteriores

                                $button
                                    .removeClass(
                                        'success danger indifferent frequency-present frequency-absent frequency-neutral bg-green-500 hover:bg-green-600 focus:ring-green-500 bg-red-600 hover:bg-red-700 dark:bg-red-700 focus:ring-red-700 bg-gray-400 hover:bg-gray-500 dark:bg-gray-500 focus:ring-gray-500'
                                    )
                                    .find('i')
                                    .removeClass(
                                        'fa-check fa-times fa-minus frequency-icon-check frequency-icon-times frequency-icon-minus'
                                    );


                                // PRESENÇA

                                if (novoStatus === 1) {

                                    $button
                                        .addClass(
                                            'success frequency-present'
                                        )
                                        .find('i')
                                        .addClass(
                                            'fa-check frequency-icon-check'
                                        );

                                }


                                // FALTA

                                else if (novoStatus === 0) {

                                    $button
                                        .addClass(
                                            'danger frequency-absent'
                                        )
                                        .find('i')
                                        .addClass(
                                            'fa-times frequency-icon-times'
                                        );

                                }


                                // NÃO INFORMADO

                                else if (novoStatus === null) {

                                    $button
                                        .addClass(
                                            'indifferent frequency-neutral'
                                        )
                                        .find('i')
                                        .addClass(
                                            'fa-minus frequency-icon-minus'
                                        );

                                }

                            }

                            else {

                                alert(
                                    'Erro ao atualizar a frequência.'
                                );

                            }

                        }

                });

            });

        });

    </script>

</x-app-layout>