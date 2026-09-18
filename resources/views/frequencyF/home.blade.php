<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <div class="flex items-center gap-x-1">
                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#243129]">
                    {{ __('Lista de Frequência') }}
                </h2>

                <x-button
                    button
                    variant="question"
                    class="mt-1 sm:mt-2"
                    size="sm"
                    onclick="guestText('info', 'Esse setor possui a ferramenta de busca com o turno do aluno em questão, mês/ano e o professor responsável pelo atendimento a qual se refere a lista de frequência, em que o único campo obrigatório de pesquisa é o mês/ano. <br> <br> Legenda: <br> dos botões (o que cada símbolo significa): <br> <span class=&quot;text-gray-400 dark:text-gray-400&quot;> - : Neutro ou Indiferente </span> <br> <span class=&quot;text-red-600&quot;> x : Falta Confirmada</span> <br> <span class=&quot;text-green-600&quot;> ✓ : Presença Confirmada</span> <br> dos campos sem botões: <br> <div class=&quot;flex items-center&quot;> <hr class=&quot;w-[18px] border-gray-500 dark:border-white mr-2 mb-4&quot;>: Dia de semana em que o aluno não tem atendimento ou fériado </div> x : Fim de semana (mascara/não mostra um feriado) <br> <br> Essa tabela contabiliza as faltas e seu dia em questão, além disso pode-se justificar a falta do aluno no campo apropriado além de registrar a assinatura do professor responsável.')"
                >
                    <x-icons.question />
                </x-button>

            </div>
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


    @php

        $variablesSearchFrequency =
            $turn_apae . '-' . $monthYear . '-' . $professor_id;

    @endphp


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

            <tr data-id="{{$frequency->id}}">


                {{-- NÚMERO --}}

                <td
                    class="border border-[#E4E8E2] dark:border-[#E4E8E2] py-3 text-center text-[#243129] dark:text-[#243129]"
                >

                    {{ $loop->iteration }}

                </td>


                {{-- NOME --}}

                <td
                    class="border border-[#E4E8E2] dark:border-[#E4E8E2] px-2 py-3 text-center text-[#243129] dark:text-[#243129] cursor-pointer"
                    onclick="show('{{route('student.show', $frequency->student->id)}}')"
                >

                    {{\Illuminate\Support\Str::limit($frequency->student->name, 14, '...')}}

                </td>


                {{-- DIAS --}}

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


                    <td
                        class="border border-[#E4E8E2] dark:border-[#E4E8E2] text-center"
                    >

                        @if (!$isNonClickable)

                            <x-button

                                class="btn-toggle flex items-center justify-center
                                    {{
                                        $frequency->$day === true

                                            ? 'success bg-[#2F6B4F] hover:bg-[#23543E] focus:ring-[#2F6B4F]'

                                            : (
                                                $frequency->$day === false

                                                    ? 'danger bg-[#D5A85A] hover:bg-[#B8893F] dark:bg-[#D5A85A] focus:ring-[#D5A85A]'

                                                    : 'indifferent bg-[#B8CCBD] hover:bg-[#9FB5A5] dark:bg-[#B8CCBD] focus:ring-[#B8CCBD]'
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
                                            ? 'fa-check -mx-0.5'
                                            : (
                                                $frequency->$day === false
                                                    ? 'fa-times'
                                                    : 'fa-minus m-minus'
                                            )
                                    }}"
                                ></i>

                            </x-button>


                        @elseif ($isWeekend)

                            <span class="text-[#6E7A72] dark:text-[#6E7A72] text-sm">

                                X

                            </span>


                        @else

                            <hr
                                class="mx-1 border-[#B8CCBD] dark:border-[#B8CCBD]"
                            >

                        @endif

                    </td>

                @endfor


                {{-- FALTAS --}}

                <td
                    class="border border-[#E4E8E2] dark:border-[#E4E8E2] px-2 py-3 text-center text-[#243129] dark:text-[#243129]"
                >

                    <h3>

                        {{ $frequency->countAbsences }}

                    </h3>

                </td>


            </tr>


        @empty


            <tr class="text-center">

                <td
                    class="border border-[#E4E8E2] dark:border-[#E4E8E2] p-3 font-normal text-[#243129] dark:text-[#243129]"
                    colspan="{{ (int) $numberDaysInMonth + 3 }}"
                >

                    Nenhum registro encontrado.

                </td>

            </tr>


        @endforelse


    </x-table>


    @if (isset($monthYear) && count($frequencies) != 0)

        <div class="py-3">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="bg-[#FFFDF9] overflow-hidden rounded-lg shadow-md border border-[#E4E8E2]">

                    <form
                        action="{{route('frequency_details.update')}}"
                        class="p-6"
                        method="POST"
                    >

                        @csrf


                        <input
                            type="hidden"
                            name="frequencies"
                            value="{{ json_encode($frequencies) }}"
                        >


                        <div>

                            <label
                                for="observation"
                                class="text-[#243129]"
                            >

                                Observações:
                                <span class="text-[#6E7A72]">
                                    (*opcional)
                                </span>

                            </label>


                            <x-form.textarea
                                name="observation"
                                id="observation"
                                class="h-32 mt-2"
                                sizeFont="base"
                                placeholder="Ex: O Aluno *** faltou dia ** pois estava doente ....."
                                data-observation=""
                            >

                                {{old('observation', $observation)}}

                            </x-form.textarea>

                        </div>


                        <div class="flex grid sm:grid-cols-2 gap-y-3">

                            <div class="space-y-1">

                                <label
                                    for="signature_id"
                                    class="text-[#243129]"
                                >

                                    Assinatura do Professor:

                                </label>


                                <x-form.select
                                    valueName="signature_id"
                                    idSelect="signature_id"
                                    class="-pr-10"
                                >

                                    <option value="">
                                        Selecione o Nome:
                                    </option>


                                    @foreach ($professors as $professor)

                                        <option
                                            value="{{$professor->id}}"
                                            {{old('signature_id', $signature_id) == $professor->id ? 'selected' : ''}}
                                        >

                                            {{$professor->name}}

                                        </option>

                                    @endforeach


                                </x-form.select>

                            </div>


                            <div class="sm:ml-auto sm:self-end">

                                <x-button>

                                    Atualizar

                                </x-button>

                            </div>


                        </div>

                    </form>

                </div>

            </div>

        </div>

    @endif


</x-app-layout>


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


            // Realiza a requisição AJAX

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


                            // Remove todas as classes de status

                            $button.removeClass(
                                'success bg-green-500 hover:bg-green-600 focus:ring-green-500 danger bg-red-600 hover:bg-red-700 dark:bg-red-700 focus:ring-red-700 indifferent bg-gray-400 hover:bg-gray-500 dark:bg-gray-500 focus:ring-gray-500'
                            )
                            .find('i')
                            .removeClass(
                                'fa-check -mx-0.5 fa-times fa-minus m-minus'
                            );


                            // Presença

                            if (novoStatus === 1) {

                                $button
                                    .addClass(
                                        'success bg-[#2F6B4F] hover:bg-[#23543E] focus:ring-[#2F6B4F]'
                                    )
                                    .find('i')
                                    .addClass(
                                        'fa-check -mx-0.5'
                                    );

                            }


                            // Falta

                            else if (novoStatus === 0) {

                                $button
                                    .addClass(
                                        'danger bg-[#D5A85A] hover:bg-[#B8893F] dark:bg-[#D5A85A] focus:ring-[#D5A85A]'
                                    )
                                    .find('i')
                                    .addClass(
                                        'fa-times'
                                    );

                            }


                            // Não informado

                            else if (novoStatus === null) {

                                $button
                                    .addClass(
                                        'indifferent bg-[#B8CCBD] hover:bg-[#9FB5A5] dark:bg-[#B8CCBD] focus:ring-[#B8CCBD]'
                                    )
                                    .find('i')
                                    .addClass(
                                        'fa-minus m-minus'
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