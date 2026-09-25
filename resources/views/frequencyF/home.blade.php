
Frequency.blade · PHP
<x-app-layout :context="$context">
 
    <div class="frequency-page">
 
        <x-slot name="header">
            <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
 
                <div class="flex items-center gap-x-2">
 
                    <h2 class="text-2xl md:text-3xl font-bold leading-tight text-gray-800 dark:text-gray-200">
                        {{ __('Lista de Frequência') }}
                    </h2>
 
                    <x-button
                        button
                        variant="question"
                        class="frequency-info-button"
                        size="sm"
                        onclick="guestText('info', 'Esse setor possui a ferramenta de busca com o turno do aluno em questão, mês/ano e o professor responsável pelo atendimento a qual se refere a lista de frequência, em que o único campo obrigatório de pesquisa é o mês/ano. <br> <br> Legenda: <br> dos botões (o que cada símbolo significa): <br> <span class=&quot;text-[#8091A5]&quot;> - : Neutro ou Indiferente </span> <br> <span class=&quot;text-[#B42318]&quot;> x : Falta Confirmada</span> <br> <span class=&quot;text-[#3B7D5A]&quot;> ✓ : Presença Confirmada</span> <br> dos campos sem botões: <br> <div class=&quot;flex items-center&quot;> <hr class=&quot;w-[18px] border-[#B8C7BE] mr-2 mb-4&quot;>: Dia de semana em que o aluno não tem atendimento ou fériado </div> x : Fim de semana (mascara/não mostra um feriado) <br> <br> Essa tabela contabiliza as faltas e seu dia em questão, além disso pode-se justificar a falta do aluno no campo apropriado além de registrar a assinatura do professor responsável.')"
                    >
                        <x-icons.question />
                    </x-button>
 
                </div>
 
            </div>
        </x-slot>
 
        @if ($errors->any())
            <script>
                alert(@json(implode("\n", $errors->all())));
            </script>
        @endif
 
        @php
            $variablesSearchFrequency = $turn_apae . '-' . $monthYear . '-' . $professor_id;
        @endphp
 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
 
            <div class="frequency-table-wrapper rounded-2xl overflow-hidden mb-6">
 
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
                        <tr data-id="{{ $frequency->id }}" class="frequency-row">
 
                            <td class="frequency-cell frequency-index">
                                {{ $loop->iteration }}
                            </td>
 
                            <td class="frequency-cell frequency-student" onclick="show('{{ route('student.show', $frequency->student->id) }}')">
                                {{ \Illuminate\Support\Str::limit($frequency->student->name, 14, '...') }}
                            </td>
 
                            @for ($day = 1; $day <= $numberDaysInMonth; $day++)
                                @php
                                    list($month, $year) = explode('/', $monthYear);
                                    $date = sprintf("%04d-%02d-%02d", $year, $month, $day);
                                    $isNonClickable = in_array($date, $frequency->nonClickableDays);
                                    $isWeekend = in_array($date, $frequency->weekends);
                                @endphp
                                <td class="frequency-day-cell">
                                    @if (!$isNonClickable)
                                        <x-button
                                            class="btn-toggle frequency-toggle {{ $frequency->$day === true ? 'success frequency-present' : ($frequency->$day === false ? 'danger frequency-absent' : 'indifferent frequency-neutral') }}"
                                            variant="{{ $frequency->$day === true ? 'success' : ($frequency->$day === false ? 'danger' : 'indifferent') }}"
                                            size="hyper-sm"
                                            data-frequency="{{ $frequency->id }}"
                                            data-day="{{ $day }}"
                                        >
                                            <i class="fas {{ $frequency->$day === true ? 'fa-check frequency-icon-check' : ($frequency->$day === false ? 'fa-times frequency-icon-times' : 'fa-minus frequency-icon-minus') }}"></i>
                                        </x-button>
                                    @elseif ($isWeekend)
                                        <span class="frequency-weekend">X</span>
                                    @else
                                        <hr class="frequency-unavailable">
                                    @endif
                                </td>
                            @endfor
 
                            <td class="frequency-cell frequency-absences">
                                <h3>{{ $frequency->countAbsences }}</h3>
                            </td>
 
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td class="frequency-empty" colspan="{{ (int) $numberDaysInMonth + 3 }}">
                                Nenhum registro encontrado.
                            </td>
                        </tr>
                    @endforelse
                </x-table>
 
            </div>
 
            @if (isset($monthYear) && count($frequencies) != 0)
 
                <div class="frequency-observation-card rounded-2xl overflow-hidden">
 
                    <form action="{{ route('frequency_details.update') }}" class="p-6" method="POST">
                        @csrf
 
                        <input type="hidden" name="frequencies" value="{{ json_encode($frequencies) }}">
 
                        <div class="mb-5">
                            <label for="observation" class="frequency-form-label">
                                Observações:
                                <span class="frequency-optional">(*opcional)</span>
                            </label>
 
                            <x-form.textarea
                                name="observation"
                                id="observation"
                                class="h-32 mt-2 frequency-field"
                                sizeFont="base"
                                placeholder="Ex: O Aluno *** faltou dia ** pois estava doente ....."
                                data-observation=""
                            >{{ old('observation', $observation) }}</x-form.textarea>
                        </div>
 
                        <div class="grid sm:grid-cols-2 gap-y-4 gap-x-5">
                            <div>
                                <label for="signature_id" class="frequency-form-label">
                                    Assinatura do Professor:
                                </label>
 
                                <x-form.select valueName="signature_id" idSelect="signature_id" class="frequency-select frequency-field">
                                    <option value="">Selecione o Nome:</option>
                                    @foreach ($professors as $professor)
                                        <option value="{{ $professor->id }}" {{ old('signature_id', $signature_id) == $professor->id ? 'selected' : '' }}>
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
 
            @endif
 
        </div>
 
    </div>
 
    <style>
        .frequency-page {
            --bg: transparent;
            --surface: #F7F5EF;
            --surface-soft: #E3EFE7;
            --surface-hover: #F0EEE6;
            --input-bg: #FFFFFF;
            --title: #183C2C;
            --text: #42564A;
            --muted: #78857D;
            --border: #E2E8E2;
            --green: #2F6B4F;
            --green-dark: #1F513A;
            --green-light: #E3EFE7;
            --gold: #C99B4A;
            --gold-light: #F7EFDD;
            --danger: #C98B45;
            --danger-dark: #A96F31;
            --neutral: #B8C7BE;
            --neutral-dark: #9EADA4;
            --shadow: 0 10px 30px rgba(31, 81, 58, 0.06);
            display: block;
            min-height: calc(100vh - 64px);
            background-color: var(--bg);
            color: var(--text);
            padding-bottom: 2rem;
            transition: background-color 250ms ease, color 250ms ease;
        }
 
        .dark .frequency-page {
            --bg: #0D1B15;
            --surface: #14271E;
            --surface-soft: #1A3025;
            --surface-hover: #20392C;
            --title: #F5F1E8;
            --text: #D1DBD3;
            --muted: #91A197;
            --border: #294236;
            --green: #76B58F;
            --green-dark: #5D9D78;
            --green-light: rgba(118, 181, 143, 0.14);
            --gold: #D8B56A;
            --gold-light: rgba(216, 181, 106, 0.13);
            --danger: #D8935B;
            --danger-dark: #C77A3E;
            --neutral: #40584B;
            --neutral-dark: #4F6A5A;
            --shadow: 0 14px 35px rgba(0, 0, 0, 0.20);
        }
 
        /* Título padronizado (segue o mesmo padrão da tela Lista de Estudantes) */
        .frequency-info-button {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            color: var(--muted) !important;
            padding: 0 !important;
        }
        .frequency-info-button:hover {
            background: transparent !important;
            color: var(--green) !important;
        }
 
        /* Caixa da tabela de frequência (off-white; cabeçalho da tabela em verde claro) */
        .frequency-table-wrapper {
            background: #F7F5EF !important;
            border: 1px solid var(--border) !important;
            box-shadow: var(--shadow) !important;
        }
        .frequency-table-wrapper .bg-white,
        .frequency-table-wrapper .dark\:bg-gray-800,
        .frequency-table-wrapper .dark\:bg-gray-900 { background-color: transparent !important; }
        .frequency-table-wrapper .shadow,
        .frequency-table-wrapper .shadow-sm,
        .frequency-table-wrapper .shadow-md { box-shadow: none !important; }
        .frequency-table-wrapper .border-gray-200,
        .frequency-table-wrapper .border-gray-300,
        .frequency-table-wrapper .border-gray-600,
        .frequency-table-wrapper .dark\:border-gray-700 { border-color: transparent !important; }
 
        .frequency-page table { background-color: var(--surface) !important; }
        .frequency-page table thead { background-color: var(--surface-soft) !important; }
        .frequency-page table thead th {
            background-color: var(--surface-soft) !important;
            color: var(--muted) !important;
            border-color: var(--border) !important;
            font-weight: 600;
        }
 
        .frequency-page .frequency-row {
            background-color: var(--surface) !important;
            transition: background-color 0.18s ease;
        }
        .frequency-page .frequency-row:hover { background-color: var(--surface-hover) !important; }
 
        .frequency-page .frequency-cell {
            padding: 0.7rem 0.45rem;
            text-align: center;
            color: var(--text) !important;
            border: 1px solid var(--border) !important;
        }
        .frequency-page .frequency-index { color: var(--muted) !important; font-weight: 500; }
 
        .frequency-page .frequency-student {
            padding-left: 0.65rem;
            padding-right: 0.65rem;
            color: var(--title) !important;
            font-weight: 500;
            cursor: pointer;
        }
        .frequency-page .frequency-student:hover {
            color: var(--green) !important;
            background-color: var(--green-light) !important;
        }
 
        .frequency-page .frequency-day-cell {
            min-width: 38px;
            padding: 0.3rem 0.2rem;
            text-align: center;
            border: 1px solid var(--border) !important;
            background-color: var(--surface) !important;
        }
 
        .frequency-page .frequency-present {
            background-color: var(--green) !important;
            border-color: var(--green) !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }
        .frequency-page .frequency-present:hover {
            background-color: var(--green-dark) !important;
            border-color: var(--green-dark) !important;
        }
 
        .frequency-page .frequency-absent {
            background-color: var(--danger) !important;
            border-color: var(--danger) !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }
        .frequency-page .frequency-absent:hover {
            background-color: var(--danger-dark) !important;
            border-color: var(--danger-dark) !important;
        }
 
        .frequency-page .frequency-neutral {
            background-color: var(--neutral) !important;
            border-color: var(--neutral) !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }
        .frequency-page .frequency-neutral:hover {
            background-color: var(--neutral-dark) !important;
            border-color: var(--neutral-dark) !important;
        }
 
        .frequency-page .frequency-icon-check,
        .frequency-page .frequency-icon-times,
        .frequency-page .frequency-icon-minus { color: #FFFFFF !important; }
 
        .frequency-page .frequency-weekend {
            color: var(--muted) !important;
            font-size: 0.82rem;
            font-weight: 600;
        }
 
        .frequency-page .frequency-unavailable {
            margin-left: 0.25rem;
            margin-right: 0.25rem;
            border-color: var(--neutral) !important;
        }
 
        .frequency-page .frequency-absences {
            color: var(--title) !important;
            font-weight: 600;
            background-color: var(--surface-soft) !important;
        }
        .frequency-page .frequency-absences h3 { color: var(--title) !important; font-weight: 600; }
 
        .frequency-page .frequency-empty {
            padding: 1rem;
            color: var(--muted) !important;
            background-color: var(--surface) !important;
            border: 1px solid var(--border) !important;
        }
 
        .frequency-page .frequency-observation-card {
            background-color: var(--surface) !important;
            border: 1px solid var(--border) !important;
            box-shadow: var(--shadow) !important;
        }
 
        .frequency-page .frequency-form-label {
            display: block;
            color: var(--text) !important;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }
        .frequency-page .frequency-optional {
            color: var(--muted) !important;
            font-size: 0.82rem;
            font-weight: 400;
        }
 
        .frequency-page .frequency-field,
        .frequency-page textarea,
        .frequency-page select {
            color: var(--title) !important;
            background-color: var(--input-bg) !important;
            border: 1px solid var(--border) !important;
            border-radius: 9px !important;
            box-shadow: none !important;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }
        .frequency-page textarea::placeholder,
        .frequency-page input::placeholder { color: var(--muted) !important; opacity: 1; }
        .frequency-page textarea:focus,
        .frequency-page select:focus,
        .frequency-page input:focus {
            border-color: var(--green) !important;
            box-shadow: 0 0 0 3px var(--green-light) !important;
            outline: none !important;
        }
 
        .frequency-page .frequency-update-button {
            background-color: var(--green) !important;
            border-color: var(--green) !important;
            color: #FFFFFF !important;
            box-shadow: none !important;
        }
        .frequency-page .frequency-update-button:hover {
            background-color: var(--green-dark) !important;
            border-color: var(--green-dark) !important;
        }
 
        .frequency-page .bg-blue-500,
        .frequency-page .bg-blue-600,
        .frequency-page .bg-blue-700 {
            background-color: var(--green) !important;
            border-color: var(--green) !important;
            color: #FFFFFF !important;
        }
        .frequency-page .bg-blue-500:hover,
        .frequency-page .bg-blue-600:hover,
        .frequency-page .bg-blue-700:hover,
        .frequency-page .hover\:bg-blue-600:hover,
        .frequency-page .hover\:bg-blue-700:hover {
            background-color: var(--green-dark) !important;
            border-color: var(--green-dark) !important;
        }
 
        .frequency-page #search-container {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }
        .frequency-page #search-container input,
        .frequency-page #search-container select {
            color: var(--title) !important;
            background-color: var(--input-bg) !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }
        .frequency-page #search-container input::placeholder { color: var(--muted) !important; }
        .frequency-page #search-container:focus-within {
            border-color: var(--green) !important;
            box-shadow: 0 0 0 3px var(--green-light) !important;
        }
 
        .frequency-page nav { color: var(--muted) !important; }
        .frequency-page nav .bg-blue-500,
        .frequency-page nav .bg-blue-600 {
            background-color: var(--green) !important;
            border-color: var(--green) !important;
            color: #FFFFFF !important;
        }
        .frequency-page nav .bg-blue-500:hover,
        .frequency-page nav .bg-blue-600:hover { background-color: var(--green-dark) !important; }
        .frequency-page nav a,
        .frequency-page nav span { color: var(--text) !important; }
 
        .frequency-page button,
        .frequency-page a {
            transition: background-color 0.18s ease, border-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease;
        }
 
        @media (max-width: 768px) {
            .frequency-page table { font-size: 0.82rem; }
            .frequency-page .frequency-cell { padding: 0.55rem 0.3rem; }
            .frequency-page .frequency-day-cell { min-width: 34px; padding: 0.25rem 0.15rem; }
            .frequency-page .frequency-student { min-width: 110px; }
        }
 
        @media (max-width: 640px) {
            .frequency-page table { min-width: 900px; }
            .frequency-page .frequency-observation-card { border-radius: 12px; }
        }
    </style>
 
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
 
    <script>
        $(document).ready(function () {
            $('.btn-toggle').click(function () {
                let frequencyId = $(this).data('frequency');
                let day = $(this).data('day');
                let statusAtual = $(this).hasClass('success') ? 1 : ($(this).hasClass('danger') ? 0 : null);
                let novoStatus = statusAtual === 0 ? 1 : (statusAtual === 1 ? null : 0);
 
                $.ajax({
                    url: '/frequency/' + frequencyId,
                    method: 'PUT',
                    data: {
                        frequencyId: frequencyId,
                        day: day,
                        status: novoStatus,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        if (response.success) {
                            let $button = $(`[data-frequency="${frequencyId}"][data-day="${day}"]`);
 
                            $button
                                .removeClass('success danger indifferent frequency-present frequency-absent frequency-neutral bg-green-500 hover:bg-green-600 focus:ring-green-500 bg-red-600 hover:bg-red-700 dark:bg-red-700 focus:ring-red-700 bg-gray-400 hover:bg-gray-500 dark:bg-gray-500 focus:ring-gray-500')
                                .find('i')
                                .removeClass('fa-check fa-times fa-minus frequency-icon-check frequency-icon-times frequency-icon-minus');
 
                            if (novoStatus === 1) {
                                $button.addClass('success frequency-present').find('i').addClass('fa-check frequency-icon-check');
                            } else if (novoStatus === 0) {
                                $button.addClass('danger frequency-absent').find('i').addClass('fa-times frequency-icon-times');
                            } else if (novoStatus === null) {
                                $button.addClass('indifferent frequency-neutral').find('i').addClass('fa-minus frequency-icon-minus');
                            }
                        } else {
                            alert('Erro ao atualizar a frequência.');
                        }
                    }
                });
            });
        });
    </script>
 
</x-app-layout>