{{-- 
$title: string que define o título da tabela.

$headers: Um array que contém os cabeçalhos das colunas da tabela.

$rows: Um array que recebe os dados do Banco de dados.

$variablesDB: Um array com os nomes das colunas que existem no banco de dados.

$actionRoute (opcional): Contém a rota para onde os botões devem redirecionar.
--}}


@php

    /*
    |--------------------------------------------------------------------------
    | Identifica a página de Anamnese
    |--------------------------------------------------------------------------
    */

    $isAnamnese = $title === 'Anamnese';


    /*
    |--------------------------------------------------------------------------
    | Estilos específicos da Anamnese
    |--------------------------------------------------------------------------
    */

    $cardClass = $isAnamnese

        ? 'bg-white dark:bg-dark-eval-1 overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm'

        : 'bg-white dark:bg-dark-eval-1 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700';


    $tableClass = $isAnamnese

        ? 'min-w-full border-separate border-spacing-0'

        : 'min-w-full mt-5 border-separate border-spacing-0 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700';


    $tableHeaderClass = $isAnamnese

        ? 'bg-gray-100 dark:bg-gray-800'

        : 'bg-blue-50 dark:bg-gray-800';


    $titleColor = $isAnamnese

        ? 'text-[#10243E] dark:text-gray-100'

        : 'text-gray-800 dark:text-gray-100';


    $bodyTextColor = $isAnamnese

        ? 'text-[#10243E] dark:text-gray-200'

        : 'text-gray-800 dark:text-gray-200';


    $borderColor = $isAnamnese

        ? 'border-gray-100 dark:border-gray-700'

        : 'border-gray-100 dark:border-gray-700';

@endphp



<div class="py-6">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- ==========================================================
            CARD PRINCIPAL
        =========================================================== --}}

        <div class="{{ $cardClass }}">

            <div class="{{ isset($inTableShow) ? 'sm:px-6 px-0 py-4' : 'p-6 sm:p-8' }}">


                {{-- ==================================================
                    ÁREA SUPERIOR
                =================================================== --}}

                <div
                    class="
                        flex
                        flex-col
                        lg:flex-row
                        lg:items-end
                        lg:justify-between
                        gap-6
                        mb-7
                    "
                >


                    {{-- ==================================================
                        TÍTULO DA ANAMNESE
                    =================================================== --}}

                    @if ($isAnamnese)

                        <div class="flex-1">

                            <div class="mb-2">

                                <span
                                    class="
                                        text-sm
                                        font-semibold
                                        tracking-wide
                                        uppercase
                                        text-[#287653]
                                    "
                                >
                                    SIAPAE
                                </span>

                            </div>


                            <h1
                                class="
                                    text-2xl
                                    md:text-3xl
                                    font-bold
                                    {{ $titleColor }}
                                "
                            >
                                Fichas de anamnese
                            </h1>


                            <p
                                class="
                                    text-base
                                    text-gray-500
                                    dark:text-gray-400
                                    mt-2
                                "
                            >
                                Consulte e gerencie as fichas de anamnese dos alunos.
                            </p>

                        </div>

                    @endif



                    {{-- ==================================================
                        ÁREA DE PESQUISA
                    =================================================== --}}

                    <div
                        class="
                            flex
                            flex-col
                            sm:flex-row
                            items-stretch
                            sm:items-center
                            gap-3
                            w-full
                            lg:w-auto
                        "
                    >


                        {{-- ==================================================
                            PESQUISA POR TEXTO
                        =================================================== --}}

                        @php

                            if (isset($search)) {

                                $searchPlaceholder = 'Resultados para: "' . $search . '"';

                            } else {

                                $searchPlaceholder = $title == 'Anamnese'

                                    ? 'Nome do Aluno p/ Anamnese'

                                    : 'Nome do ' . $title;

                            }

                        @endphp


                        @if (isset($withSearchInput))

                            <div
                                id="search-container"
                                class="
                                    flex
                                    items-center
                                    overflow-hidden
                                    w-full
                                    sm:w-80
                                    h-12
                                    rounded-xl
                                    border
                                    border-gray-300
                                    dark:border-gray-600
                                    bg-white
                                    dark:bg-dark-eval-1
                                    transition
                                    duration-200
                                    focus-within:border-[#287653]
                                    focus-within:ring-2
                                    focus-within:ring-[#287653]/10
                                "
                            >

                                @php

                                    $route = $actionRoute . '.index';

                                    if (isset($searchRoute)) {
                                        $route = $searchRoute;
                                    }

                                @endphp


                                <form
                                    action="{{ route($route) }}"
                                    method="GET"
                                    class="flex items-center w-full h-full"
                                >

                                    <input
                                        type="text"
                                        id="search"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="
                                            w-full
                                            h-full
                                            px-4
                                            border-0
                                            outline-none
                                            ring-0
                                            focus:border-0
                                            focus:outline-none
                                            focus:ring-0
                                            bg-transparent
                                            text-gray-700
                                            dark:text-gray-200
                                            placeholder-gray-400
                                            dark:placeholder-gray-500
                                        "
                                        placeholder="{{ $searchPlaceholder }}"
                                    />


                                    <button
                                        id="icone-search"
                                        type="submit"
                                        class="
                                            w-14
                                            h-full
                                            flex
                                            items-center
                                            justify-center
                                            border-l
                                            border-gray-200
                                            dark:border-gray-700
                                            text-gray-400
                                            hover:text-[#287653]
                                            dark:hover:text-green-400
                                            transition
                                            duration-200
                                        "
                                    >

                                        <x-icons.search />

                                    </button>

                                </form>

                            </div>

                        @endif



                        {{-- ==================================================
                            PESQUISA POR ANO
                        =================================================== --}}

                        @if (isset($withSearchSelect))

                            <form
                                method="GET"
                                action="{{ isset($searchRoute) ? route($searchRoute, $element->id ?? null) : route($actionRoute . '.index') }}"
                                class="w-full sm:w-48"
                            >

                                <div class="form-group">

                                    <x-form.select
                                        valueName="year"
                                        function="this.form.submit()"
                                    >

                                        <option value="">
                                            Selecione o ano:
                                        </option>


                                        @foreach ($years as $yearItem)

                                            <option
                                                value="{{ $yearItem }}"
                                                {{ $year == $yearItem ? 'selected' : '' }}
                                            >
                                                {{ $yearItem }}
                                            </option>

                                        @endforeach

                                    </x-form.select>

                                </div>

                            </form>

                        @endif



                        {{-- ==================================================
                            PESQUISA DE FREQUÊNCIA
                        =================================================== --}}

                        @if (isset($withSearchFrequency))

                            @if (!isset($searchFrequencyStudent))

                                @php

                                    list(
                                        $turn_apae,
                                        $monthYear,
                                        $professor_id
                                    ) = explode('-', $variablesSearchFrequency);

                                @endphp


                                <form
                                    method="GET"
                                    action="{{ route('frequency.index') }}"
                                    class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto"
                                >

                                    <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">

                                        <x-form.select
                                            valueName="turn_apae"
                                            notRequired
                                        >

                                            <option value="">
                                                Turno do aluno
                                            </option>

                                            <option
                                                value="Manhã"
                                                {{ old('turn_apae', $turn_apae ?? '') == 'Manhã' ? 'selected' : '' }}
                                            >
                                                Manhã
                                            </option>

                                            <option
                                                value="Tarde"
                                                {{ old('turn_apae', $turn_apae ?? '') == 'Tarde' ? 'selected' : '' }}
                                            >
                                                Tarde
                                            </option>

                                        </x-form.select>


                                        <div class="flex gap-x-2">

                                            <x-form.input
                                                name="monthYear"
                                                placeholder="Mês/Ano"
                                                value="{{ old('monthYear', $monthYear) }}"
                                                class="period-input form-control w-40 sm:w-32 monthYear"
                                            />

                                            <x-button class="w-full sm:w-auto flex sm:hidden">

                                                <div class="text-gray-100 dark:text-gray-100 w-full text-center">
                                                    Filtrar
                                                </div>

                                            </x-button>

                                        </div>


                                        <x-form.select
                                            valueName="professor_select"
                                            notRequired
                                        >

                                            <option value="">
                                                Professor do aluno
                                            </option>

                                            @foreach ($professors as $professor)

                                                <option
                                                    value="{{ $professor->id }}"
                                                    {{ old('professor_select', $professor_id ?? '') == $professor->id ? 'selected' : '' }}
                                                >
                                                    {{ $professor->name }}
                                                </option>

                                            @endforeach

                                        </x-form.select>

                                    </div>


                                    <div class="hidden sm:flex">

                                        <x-button class="w-full sm:w-auto">

                                            <div class="text-gray-100 dark:text-gray-100 w-full text-center">
                                                Filtrar
                                            </div>

                                        </x-button>

                                    </div>

                                </form>

                            @else

                                <form
                                    action="{{ isset($searchRoute) ? route($searchRoute, $element->id) : route($actionRoute . '.index') }}"
                                    method="GET"
                                    class="flex gap-2 w-full sm:w-auto"
                                >

                                    <div class="w-auto">

                                        <x-form.input
                                            name="monthYear"
                                            placeholder="Mês/Ano"
                                            value="{{ old('monthYear', $monthYear) }}"
                                            class="period-input form-control w-32 monthYear"
                                        />

                                    </div>


                                    <div>

                                        <button
                                            class="
                                                icone-search
                                                flex
                                                sm:hidden
                                                px-2.5
                                                rounded-md
                                                bg-gray-500
                                                hover:bg-gray-600
                                                dark:bg-gray-700
                                                dark:hover:bg-gray-800
                                                focus:outline-none
                                                transition
                                                duration-200
                                            "
                                        >

                                            <x-icons.search />

                                        </button>


                                        <x-button class="w-auto hidden sm:flex">

                                            <div class="text-gray-100 dark:text-gray-100 w-full text-center">
                                                Filtrar
                                            </div>

                                        </x-button>

                                    </div>

                                </form>

                            @endif

                        @endif



                        {{-- ==================================================
                            FILTRO POR INTERVALO DE DATAS
                        =================================================== --}}

                        @if (isset($withSearchDateRange))

                            @php

                                $route = $actionRoute . '.index';

                                if (isset($searchRoute)) {

                                    $route = $searchRoute;

                                    $elementId = $element->id ?? null;

                                }

                            @endphp


                            <div
                                id="search-container"
                                class="
                                    flex
                                    items-center
                                    rounded-xl
                                    overflow-hidden
                                    w-full
                                    sm:w-auto
                                    border
                                    border-gray-300
                                    dark:border-gray-600
                                    bg-white
                                    dark:bg-dark-eval-1
                                "
                            >

                                <form
                                    method="GET"
                                    action="{{ route($route, $elementId ?? null) }}"
                                    class="flex w-full sm:w-auto"
                                >

                                    @php

                                        if ($range) {
                                            $placeholderValue = 'Intervalo: ' . $range;
                                        } else {
                                            $placeholderValue = 'Filtro: Intervalo de Datas';
                                        }

                                    @endphp


                                    <x-form.input
                                        class="
                                            date-range
                                            w-full
                                            sm:w-80
                                            form-control
                                            text-gray-700
                                            dark:text-gray-300
                                            border-0
                                            focus:border-0
                                            focus:ring-0
                                        "
                                        x-init="initFlatpickr"
                                        name="date_range"
                                        placeholder="{{ $placeholderValue }}"
                                        autocomplete="off"
                                    />


                                    <button
                                        class="
                                            icone-search
                                            px-2
                                            text-gray-500
                                            hover:text-[#287653]
                                            dark:text-gray-400
                                            dark:hover:text-green-400
                                            focus:outline-none
                                            focus:ring-0
                                            transition
                                            duration-200
                                        "
                                    >

                                        <x-icons.search />

                                    </button>

                                </form>

                            </div>

                        @endif



                        {{-- ==================================================
                            BOTÕES
                        =================================================== --}}

                        <div
                            class="
                                flex
                                flex-col
                                sm:flex-row
                                items-center
                                gap-2
                                w-full
                                sm:w-auto
                            "
                        >


                            {{-- EXPORTAR EXCEL --}}

                            @if (isset($withExportExcel))

                                <form
                                    action="{{ route('export.' . $actionRoute . 's') }}"
                                    method="POST"
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="{{ $actionRoute . 's' }}"
                                        value="{{ json_encode($elementsExcelOrPdf) }}"
                                    >


                                    <x-button
                                        variant="excel"
                                        title="Exportar em Excel"
                                        size="sm"
                                    >

                                        <x-icons.excel-icon />

                                    </x-button>

                                </form>

                            @endif



                            {{-- EXPORTAR PDF --}}

                            @if (isset($withExportPdf))

                                <form
                                    action="{{ route($actionRoute . '.export') }}"
                                    method="POST"
                                    target="_blank"
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="{{ $actionRoute . 's' }}"
                                        value="{{ json_encode($elementsExcelOrPdf) }}"
                                    >


                                    <x-button
                                        variant="pdf-trash"
                                        title="Exportar em PDF"
                                        size="sm"
                                        class="py-2.5"
                                    >

                                        <x-icons.pdf />

                                    </x-button>

                                </form>

                            @endif



                            {{-- VALOR TOTAL --}}

                            @if (isset($valueTotal))

                                <div
                                    class="
                                        flex
                                        max-w-full
                                        justify-center
                                        items-center
                                        sm:mr-2
                                        px-3
                                        py-2
                                        border
                                        border-gray-300
                                        dark:border-gray-600
                                        rounded-lg
                                        w-full
                                        sm:w-auto
                                    "
                                >

                                    <p class="flex dark:text-gray-300 gap-x-1">

                                        <span class="hidden sm:flex">
                                            Valor Total:
                                        </span>

                                        <span class="flex sm:hidden">
                                            V.T:
                                        </span>

                                        <span>
                                            {{ $valueTotal }} R$
                                        </span>

                                    </p>

                                </div>

                            @endif



                            {{-- ==================================================
                                BOTÃO ADICIONAR
                            =================================================== --}}

                            @if (
                                isset($actionRoute)
                                && !isset($notButtonAdd)
                                && !isset($actionsDeposit)
                                && !isset($isNotAdmin)
                            )

                                <x-button
                                    href="{{ route($actionRoute . '.create') }}"
                                    variant="blue"
                                    class="
                                        w-full
                                        sm:w-auto
                                        h-12
                                        px-5
                                        rounded-xl
                                        flex
                                        items-center
                                        justify-center
                                    "
                                >

                                    <div class="text-white text-center w-full">

                                        @if ($isAnamnese)

                                            Adicionar ficha

                                        @else

                                            Adicionar {{ $title }}

                                        @endif

                                    </div>

                                </x-button>

                            @endif

                        </div>

                    </div>

                </div>



                {{-- ==========================================================
                    SEPARADOR
                =========================================================== --}}

                <hr class="border-gray-200 dark:border-gray-700 w-full">



                {{-- ==========================================================
                    TABELA
                =========================================================== --}}

                <div class="overflow-x-auto scrollbar-custom">

                    <table class="{{ $tableClass }} mt-6">


                        {{-- ==================================================
                            CABEÇALHO
                        =================================================== --}}

                        <thead class="{{ $tableHeaderClass }}">

                            <tr>


                                {{-- ITERAÇÃO --}}

                                @if ($iteration == "true")

                                    <th
                                        class="
                                            border-b
                                            border-gray-200
                                            dark:border-gray-700
                                            {{ isset($headersSmall) ? 'w-8 py-1' : 'px-5 py-4' }}
                                            text-center
                                            text-sm
                                            font-semibold
                                            {{ $titleColor }}
                                        "
                                    >
                                        #
                                    </th>

                                @endif



                                {{-- COLUNAS --}}

                                @if (!isset($headFrequency))

                                    @foreach ($headers as $header)

                                        <th
                                            class="
                                                border-b
                                                border-gray-200
                                                dark:border-gray-700
                                                {{ isset($headersSmall) ? 'px-1 py-1' : 'px-5 py-4' }}
                                                text-center
                                                text-sm
                                                font-semibold
                                                {{ $titleColor }}
                                            "
                                        >

                                            {{ __($header) }}

                                        </th>

                                    @endforeach

                                @else

                                    @foreach ($headers as $header)

                                        @if ($header == 'Nome')

                                            <th
                                                class="
                                                    border-b
                                                    border-gray-200
                                                    dark:border-gray-700
                                                    w-48
                                                    py-3
                                                    text-center
                                                    text-sm
                                                    font-semibold
                                                    {{ $titleColor }}
                                                "
                                            >

                                                {{ __($header) }}

                                            </th>

                                        @else

                                            <th
                                                class="
                                                    border-b
                                                    border-gray-200
                                                    dark:border-gray-700
                                                    w-frequency
                                                    py-3
                                                    text-center
                                                    text-sm
                                                    font-semibold
                                                    {{ $titleColor }}
                                                "
                                            >

                                                {{ __($header) }}

                                            </th>

                                        @endif

                                    @endforeach

                                @endif



                                {{-- AÇÕES --}}

                                @if (isset($actionRoute) && !isset($notActions))

                                    <th
                                        class="
                                            border-b
                                            border-gray-200
                                            dark:border-gray-700
                                            {{ isset($headersSmall) ? 'px-1 py-1' : 'px-5 py-4' }}
                                            text-center
                                            text-sm
                                            font-semibold
                                            {{ $titleColor }}
                                        "
                                    >

                                        Ações

                                    </th>

                                @endif

                            </tr>

                        </thead>



                        {{-- ==================================================
                            CORPO
                        =================================================== --}}

                        <tbody class="bg-white dark:bg-dark-eval-1">

                            @if (!isset($onlyHead))

                                @forelse ($rows as $row)

                                    @php

                                        if (isset($notRegularSidebarForEditShowDelete)) {
                                            $parameter = '?notRegularSidebar=1';
                                        } else {
                                            $parameter = null;
                                        }

                                    @endphp


                                    <tr
                                        x-data
                                        @click="window.location.href = '{{ route($actionRoute . '.show', $row->id) . $parameter }}'"
                                        class="
                                            group
                                            cursor-pointer
                                            transition
                                            duration-200
                                            hover:bg-gray-50
                                            dark:hover:bg-gray-800/50
                                        "
                                    >


                                        {{-- NÚMERO --}}

                                        @if ($iteration == "true")

                                            <td
                                                class="
                                                    border-b
                                                    {{ $borderColor }}
                                                    px-5
                                                    py-4
                                                    text-center
                                                    text-gray-700
                                                    dark:text-gray-300
                                                "
                                            >

                                                {{ ($rows->currentPage() - 1) * $rows->perPage() + $loop->iteration }}

                                            </td>

                                        @endif



                                        {{-- DADOS --}}

                                        @foreach ($variablesDB as $variable)

                                            <td
                                                class="
                                                    border-b
                                                    {{ $borderColor }}
                                                    px-5
                                                    py-4
                                                    text-center
                                                    {{ $bodyTextColor }}
                                                "
                                            >


                                                {{-- ==================================================
                                                    DATAS
                                                =================================================== --}}

                                                @if (
                                                    $variable == "date_of_birth" ||
                                                    $variable == "date_of_emission" ||
                                                    $variable == "date" ||
                                                    $variable == "date_of_anamnesis" ||
                                                    $variable == "date_pedagogical" ||
                                                    $variable == "date_scfv"
                                                )

                                                    @if (data_get($row, $variable))

                                                        {{ \Carbon\Carbon::parse(data_get($row, $variable))->format('d/m/Y') }}

                                                    @else

                                                        ------

                                                    @endif



                                                {{-- ==================================================
                                                    IMAGEM
                                                =================================================== --}}

                                                @elseif ($variable == "image")

                                                    <div class="flex justify-center items-center">

                                                        <img
                                                            class="rounded-full w-10 h-10 object-cover"
                                                            src="{{ asset('img/' . $actionRoute . '/' . $row->image) }}"
                                                            alt="Image not loaded"
                                                        >

                                                    </div>



                                                {{-- ==================================================
                                                    PREÇO
                                                =================================================== --}}

                                                @elseif ($variable == "price")

                                                    <div class="flex justify-center items-center">

                                                        {{ 'R$ ' . number_format($row->{$variable}, 2, ',', '.') }}

                                                    </div>



                                                {{-- ==================================================
                                                    ARQUIVO
                                                =================================================== --}}

                                                @elseif ($variable == "file")

                                                    <div onclick="event.stopPropagation();">

                                                        @if ($actionRoute == 'record')

                                                            <a
                                                                href="{{ route('record.export', $row->id) }}"
                                                                target="_blank"
                                                                class="
                                                                    {{ $isAnamnese
                                                                        ? 'text-[#287653] hover:text-[#1f6043]'
                                                                        : 'text-blue-600 hover:text-blue-700'
                                                                    }}
                                                                    underline
                                                                "
                                                            >

                                                                {{ \Illuminate\Support\Str::limit($row->title_header, $strLimit ?? 35) }}

                                                            </a>

                                                        @else

                                                            {{ \Illuminate\Support\Str::limit(data_get($row, $file) ?? '------', $strLimit ?? 20) }}

                                                        @endif

                                                    </div>



                                                {{-- ==================================================
                                                    NÚMERO
                                                =================================================== --}}

                                                @elseif ($variable == "number")

                                                    @php

                                                        $number = 0;

                                                        if ($row->fiscal_number == null) {
                                                            $number = $row->cupom_number;
                                                        } else {
                                                            $number = $row->fiscal_number;
                                                        }

                                                    @endphp


                                                    <div class="flex justify-center items-center">

                                                        {{ \Illuminate\Support\Str::limit($number ?? '------', $strLimit ?? 15) }}

                                                    </div>



                                                {{-- ==================================================
                                                    TEXTO NORMAL
                                                =================================================== --}}

                                                @else

                                                    {{ \Illuminate\Support\Str::limit(data_get($row, $variable) ?? '------', $strLimit ?? 15) }}

                                                @endif

                                            </td>

                                        @endforeach



                                        {{-- ==================================================
                                            AÇÕES
                                        =================================================== --}}

                                        @if (isset($actionRoute) && !isset($notActions))

                                            <td
                                                class="
                                                    border-b
                                                    {{ $borderColor }}
                                                    py-2
                                                "
                                                @click.stop
                                            >

                                                <div class="flex items-center justify-center gap-x-2">


                                                    {{-- ==================================================
                                                        AÇÕES DO ARMAZÉM
                                                    =================================================== --}}

                                                    @if (isset($actionsDeposit))

                                                        @if (isset($depositWithEdit))

                                                            <x-button
                                                                href="{{ route($actionRoute . '.edit', $row->id) . $parameter }}"
                                                                title="Editar {{ $title }}"
                                                                variant="edit"
                                                                size="sm"
                                                            >

                                                                <x-icons.edit />

                                                            </x-button>

                                                        @endif


                                                        <form
                                                            action="{{ route($actionRoute . '.restore', $row->id) }}"
                                                            method="POST"
                                                            onclick="warningConfirm(
                                                                event,
                                                                'Quer restaurar esse Registro?',
                                                                'question',
                                                                'Restaurar'
                                                            )"
                                                        >

                                                            @csrf

                                                            <x-button
                                                                title="Restaurar esse {{ $title }}"
                                                                variant="restore"
                                                                size="sm"
                                                            >

                                                                <x-icons.restore />

                                                            </x-button>

                                                        </form>


                                                        @if (isset($actionsDepositWithDelete) && !isset($isNotAdmin))

                                                            <form
                                                                method="POST"
                                                                action="{{ route($actionRoute . '.destroy', $row->id) }}"
                                                                accept-charset="UTF-8"
                                                                style="display:inline"
                                                            >

                                                                {{ method_field('DELETE') }}

                                                                {{ csrf_field() }}


                                                                <x-button
                                                                    variant="pdf-trash"
                                                                    title="Deletar {{ $title }}"
                                                                    size="sm"
                                                                    onclick="deleteConfirm(
                                                                        event,
                                                                        'Excluir o item selecionado?',
                                                                        'Por favor, insira a senha para confirmar a exclusão.',
                                                                        'Excluir'
                                                                    )"
                                                                >

                                                                    <x-icons.trash />

                                                                </x-button>

                                                            </form>

                                                        @endif



                                                    {{-- ==================================================
                                                        AÇÕES NORMAIS
                                                    =================================================== --}}

                                                    @else


                                                        {{-- EDITAR --}}

                                                        @if (!isset($isNotAdmin))

                                                            <x-button
                                                                href="{{ route($actionRoute . '.edit', $row->id) . $parameter }}"
                                                                title="Editar {{ $title }}"
                                                                variant="edit"
                                                                size="sm"
                                                            >

                                                                <x-icons.edit />

                                                            </x-button>

                                                        @endif



                                                        {{-- DELETAR --}}

                                                        @if (!isset($archiveInsteadDestroy) && !isset($notButtonDelete))

                                                            <form
                                                                method="POST"
                                                                action="{{ route($actionRoute . '.destroy', $row->id) . $parameter }}"
                                                                accept-charset="UTF-8"
                                                                style="display:inline"
                                                            >

                                                                {{ method_field('DELETE') }}

                                                                {{ csrf_field() }}


                                                                <x-button
                                                                    variant="pdf-trash"
                                                                    title="Deletar {{ $title }}"
                                                                    size="sm"
                                                                    onclick="warningConfirm(
                                                                        event,
                                                                        'Essa ação é irreversível!',
                                                                        'warning',
                                                                        'Deletar'
                                                                    )"
                                                                >

                                                                    <x-icons.trash />

                                                                </x-button>

                                                            </form>


                                                        @elseif (isset($notButtonDelete))

                                                            {{-- Nada --}}



                                                        {{-- ARQUIVAR --}}

                                                        @else

                                                            <form
                                                                method="POST"
                                                                action="{{ route($actionRoute . '.archive', $row->id) }}"
                                                                accept-charset="UTF-8"
                                                                style="display:inline"
                                                            >

                                                                {{ csrf_field() }}


                                                                @php

                                                                    if (isset($notArchiveAdmin)) {

                                                                        $hidden = null;

                                                                        if ($row['access_level'] == 'admin') {
                                                                            $hidden = "hidden";
                                                                        }

                                                                    }

                                                                @endphp


                                                                <x-button
                                                                    variant="edit"
                                                                    title="Arquivar {{ $title }}"
                                                                    size="sm"
                                                                    class="{{ isset($notArchiveAdmin) ? $hidden : '' }}"
                                                                    onclick="warningConfirm(
                                                                        event,
                                                                        'Essa ação irá arquivar o item selecionado!',
                                                                        'warning',
                                                                        'Arquivar',
                                                                        '{{ $actionRoute }}'
                                                                    )"
                                                                >

                                                                    <x-icons.archive />

                                                                </x-button>

                                                            </form>

                                                        @endif

                                                    @endif

                                                </div>

                                            </td>

                                        @endif

                                    </tr>


                                @empty

                                    {{-- ==================================================
                                        NENHUM REGISTRO
                                    =================================================== --}}

                                    <tr>

                                        <td
                                            class="
                                                px-5
                                                py-12
                                                text-center
                                                font-medium
                                                text-gray-500
                                                dark:text-gray-400
                                                border-b
                                                border-gray-100
                                                dark:border-gray-700
                                            "
                                            colspan="{{ count($headers) + (isset($actionRoute) ? 2 : 0) }}"
                                        >

                                            <div class="flex flex-col items-center justify-center">

                                                <p class="text-base">
                                                    Nenhum registro encontrado.
                                                </p>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse


                            @else

                                {{ $slot }}

                            @endif

                        </tbody>

                    </table>

                </div>



                {{-- ==========================================================
                    PAGINAÇÃO
                =========================================================== --}}

                @if (!isset($notPaginate))

                    @if ($rows->count() >= (isset($numberPages) ? $numberPages : 15))

                        <hr class="border-gray-200 dark:border-gray-700 mt-5" />

                    @endif


                    <div class="pagination mt-5">

                        {{ $rows->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>