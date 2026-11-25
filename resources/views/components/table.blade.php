
@php
    $isAnamnese = $title === 'Anamnese';
    $isFrequency = isset($headFrequency);

    $cardClass = $isAnamnese
        ? 'bg-white  rounded-2xl border border-gray-200  shadow-sm'
        : 'bg-white  rounded-xl shadow-sm border border-gray-200 ';

    $tableClass = $isAnamnese
        ? 'min-w-full border-separate border-spacing-0'
        : 'min-w-full mt-5 border-separate border-spacing-0 overflow-hidden rounded-lg border border-gray-200 ';

    $tableHeaderClass = $isAnamnese
        ? 'bg-gray-100 '
        : 'bg-blue-50 ';

    $titleColor = $isAnamnese
        ? 'text-[#10243E] '
        : 'text-gray-800 ';

    $bodyTextColor = $isAnamnese
        ? 'text-[#10243E] '
        : 'text-gray-800 ';

    $borderColor = 'border-gray-100 ';
@endphp

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="{{ $cardClass }}">

            <div class="{{ isset($inTableShow) ? 'sm:px-6 px-0 py-4' : 'p-6 sm:p-8' }}">

                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-7">

                    @if ($isAnamnese)
                        <div class="flex-1">
                            <div class="mb-2">
                                <span class="text-sm font-semibold tracking-wide uppercase text-[#287653]">
                                    SIAPAE
                                </span>
                            </div>

                            <h1 class="text-2xl md:text-3xl font-bold {{ $titleColor }}">
                                Fichas de anamnese
                            </h1>

                            <p class="text-base text-gray-500  mt-2">
                                Consulte e gerencie as fichas de anamnese dos alunos.
                            </p>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">

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
                                class="flex items-center overflow-hidden w-full sm:w-80 h-12 rounded-xl border border-gray-300  bg-white  transition duration-200 focus-within:border-[#287653] focus-within:ring-2 focus-within:ring-[#287653]/10"
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
                                        class="w-full h-full px-4 border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 bg-transparent text-gray-700  placeholder-gray-400 "
                                        placeholder="{{ $searchPlaceholder }}"
                                    />

                                    <button
                                        id="icone-search"
                                        type="submit"
                                        class="w-14 h-full flex items-center justify-center border-l border-gray-200  text-gray-400 hover:text-[#287653]  transition duration-200"
                                    >
                                        <x-icons.search />
                                    </button>
                                </form>
                            </div>
                        @endif

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
                                        <option value="">Selecione o ano:</option>

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

                        @if (isset($withSearchFrequency))
                            @if (!isset($searchFrequencyStudent))
                                @php
                                    list($turn_apae, $monthYear, $professor_id) = explode('-', $variablesSearchFrequency);
                                @endphp

                                <form
                                    method="GET"
                                    action="{{ route('frequency.index') }}"
                                    class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto"
                                >
                                    <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">

                                        <x-form.select valueName="turn_apae" notRequired>
                                            <option value="">Turno do aluno</option>
                                            <option value="Manhã" {{ old('turn_apae', $turn_apae ?? '') == 'Manhã' ? 'selected' : '' }}>Manhã</option>
                                            <option value="Tarde" {{ old('turn_apae', $turn_apae ?? '') == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                        </x-form.select>

                                        <div class="flex gap-x-2">
                                            <x-form.input
                                                name="monthYear"
                                                placeholder="Mês/Ano"
                                                value="{{ old('monthYear', $monthYear) }}"
                                                class="period-input form-control w-40 sm:w-32 monthYear"
                                            />

                                            <x-button class="w-full sm:w-auto flex sm:hidden">
                                                <div class="text-gray-100  w-full text-center">
                                                    Filtrar
                                                </div>
                                            </x-button>
                                        </div>

                                        <x-form.select valueName="professor_select" notRequired>
                                            <option value="">Professor do aluno</option>

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
                                            <div class="text-gray-100  w-full text-center">
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
                                        <button class="icone-search flex sm:hidden px-2.5 rounded-md bg-gray-500 hover:bg-gray-600   focus:outline-none transition duration-200">
                                            <x-icons.search />
                                        </button>

                                        <x-button class="w-auto hidden sm:flex">
                                            <div class="text-gray-100  w-full text-center">
                                                Filtrar
                                            </div>
                                        </x-button>
                                    </div>
                                </form>
                            @endif
                        @endif

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
                                class="flex items-center rounded-xl overflow-hidden w-full sm:w-auto border border-gray-300  bg-white "
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
                                        class="date-range w-full sm:w-80 form-control text-gray-700  border-0 focus:border-0 focus:ring-0"
                                        x-init="initFlatpickr"
                                        name="date_range"
                                        placeholder="{{ $placeholderValue }}"
                                        autocomplete="off"
                                    />

                                    <button class="icone-search px-2 text-gray-500 hover:text-[#287653]   focus:outline-none focus:ring-0 transition duration-200">
                                        <x-icons.search />
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div class="flex flex-col sm:flex-row items-center gap-2 w-full sm:w-auto">

                            @if (isset($withExportExcel))
                                <form action="{{ route('export.' . $actionRoute . 's') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="{{ $actionRoute . 's' }}" value="{{ json_encode($elementsExcelOrPdf) }}">
                                    <x-button variant="excel" title="Exportar em Excel" size="sm">
                                        <x-icons.excel-icon />
                                    </x-button>
                                </form>
                            @endif

                            @if (isset($withExportPdf))
                                <form action="{{ route($actionRoute . '.export') }}" method="POST" target="_blank">
                                    @csrf
                                    <input type="hidden" name="{{ $actionRoute . 's' }}" value="{{ json_encode($elementsExcelOrPdf) }}">
                                    <x-button variant="pdf-trash" title="Exportar em PDF" size="sm" class="py-2.5">
                                        <x-icons.pdf />
                                    </x-button>
                                </form>
                            @endif

                            @if (isset($valueTotal))
                                <div class="flex max-w-full justify-center items-center sm:mr-2 px-3 py-2 border border-gray-300  rounded-lg w-full sm:w-auto">
                                    <p class="flex  gap-x-1">
                                        <span class="hidden sm:flex">Valor Total:</span>
                                        <span class="flex sm:hidden">V.T:</span>
                                        <span>{{ $valueTotal }} R$</span>
                                    </p>
                                </div>
                            @endif

                            @if (
                                isset($actionRoute)
                                && !isset($notButtonAdd)
                                && !isset($actionsDeposit)
                                && !isset($isNotAdmin)
                            )
                                <x-button
                                    href="{{ route($actionRoute . '.create') }}"
                                    variant="blue"
                                    class="w-full sm:w-auto h-12 px-5 rounded-xl flex items-center justify-center"
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

                <hr class="border-gray-200  w-full">

                <div class="{{ $isFrequency ? 'frequency-table-scroll' : 'overflow-x-auto scrollbar-custom' }}">

                    <table class="{{ $tableClass }} mt-6 {{ $isFrequency ? 'frequency-table' : '' }}">

                        <thead class="{{ $tableHeaderClass }}">
                            <tr>

                                @if ($iteration == "true")
                                    <th class="{{ $isFrequency ? 'frequency-index-header' : '' }} border-b border-gray-200  {{ isset($headersSmall) ? 'w-8 py-1' : 'px-5 py-4' }} text-center text-sm font-semibold {{ $titleColor }}">
                                        #
                                    </th>
                                @endif

                                @if (!isset($headFrequency))
                                    @foreach ($headers as $header)
                                        <th class="border-b border-gray-200  {{ isset($headersSmall) ? 'px-1 py-1' : 'px-5 py-4' }} text-center text-sm font-semibold {{ $titleColor }}">
                                            {{ __($header) }}
                                        </th>
                                    @endforeach
                                @else
                                    @foreach ($headers as $header)
                                        @if ($header == 'Nome')
                                            <th class="frequency-name-header border-b border-gray-200  py-3 text-center text-sm font-semibold {{ $titleColor }}">
                                                {{ __($header) }}
                                            </th>
                                        @else
                                            <th class="frequency-day-header border-b border-gray-200  py-3 text-center text-sm font-semibold {{ $titleColor }}">
                                                {{ __($header) }}
                                            </th>
                                        @endif
                                    @endforeach
                                @endif

                                @if (isset($actionRoute) && !isset($notActions))
                                    <th class="border-b border-gray-200  {{ isset($headersSmall) ? 'px-1 py-1' : 'px-5 py-4' }} text-center text-sm font-semibold {{ $titleColor }}">
                                        Ações
                                    </th>
                                @endif

                            </tr>
                        </thead>

                        <tbody class="bg-white ">

                            @if (!isset($onlyHead))
                                @forelse ($rows as $row)
                                    @php
                                        $parameter = isset($notRegularSidebarForEditShowDelete) ? '?notRegularSidebar=1' : null;
                                    @endphp

                                    <tr
                                        x-data
                                        @click="window.location.href = '{{ route($actionRoute . '.show', $row->id) . $parameter }}'"
                                        class="group cursor-pointer transition duration-200 hover:bg-gray-50 "
                                    >

                                        @if ($iteration == "true")
                                            <td class="{{ $isFrequency ? 'frequency-index' : '' }} border-b {{ $borderColor }} px-5 py-4 text-center text-gray-700 ">
                                                {{ ($rows->currentPage() - 1) * $rows->perPage() + $loop->iteration }}
                                            </td>
                                        @endif

                                        @foreach ($variablesDB as $variable)
                                            <td class="border-b {{ $borderColor }} px-5 py-4 text-center {{ $bodyTextColor }}">
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
                                                @elseif ($variable == "image")
                                                    <div class="flex justify-center items-center">
                                                        <img class="rounded-full w-10 h-10 object-cover" src="{{ asset('img/' . $actionRoute . '/' . $row->image) }}" alt="Image not loaded">
                                                    </div>
                                                @elseif ($variable == "price")
                                                    <div class="flex justify-center items-center">
                                                        {{ 'R$ ' . number_format($row->{$variable}, 2, ',', '.') }}
                                                    </div>
                                                @elseif ($variable == "file")
                                                    <div onclick="event.stopPropagation();">
                                                        @if ($actionRoute == 'record')
                                                            <a
                                                                href="{{ route('record.export', $row->id) }}"
                                                                target="_blank"
                                                                class="{{ $isAnamnese ? 'text-[#287653] hover:text-[#1f6043]' : 'text-blue-600 hover:text-blue-700' }} underline"
                                                            >
                                                                {{ \Illuminate\Support\Str::limit($row->title_header, $strLimit ?? 35) }}
                                                            </a>
                                                        @else
                                                            {{ \Illuminate\Support\Str::limit(data_get($row, $file) ?? '------', $strLimit ?? 20) }}
                                                        @endif
                                                    </div>
                                                @elseif ($variable == "number")
                                                    @php
                                                        $number = $row->fiscal_number == null ? $row->cupom_number : $row->fiscal_number;
                                                    @endphp
                                                    <div class="flex justify-center items-center">
                                                        {{ \Illuminate\Support\Str::limit($number ?? '------', $strLimit ?? 15) }}
                                                    </div>
                                                @else
                                                    {{ \Illuminate\Support\Str::limit(data_get($row, $variable) ?? '------', $strLimit ?? 15) }}
                                                @endif
                                            </td>
                                        @endforeach

                                        @if (isset($actionRoute) && !isset($notActions))
                                            <td class="border-b {{ $borderColor }} py-2" @click.stop>
                                                <div class="flex items-center justify-center gap-x-2">

                                                    @if ($actionRoute === 'student')
                                                        <a
                                                            href="{{ route('student.show', $row->id) }}"
                                                            title="Ver perfil do estudante"
                                                            class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg bg-[#EDF5F0] text-[#2F684A] hover:bg-[#DDECE3] transition duration-200 text-sm font-semibold whitespace-nowrap"
                                                            @click.stop
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542-7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>
                                                            <span>Ver perfil</span>
                                                        </a>
                                                    @endif

                                                    @if (isset($actionsDeposit))
                                                        @if (isset($depositWithEdit))
                                                            <x-button href="{{ route($actionRoute . '.edit', $row->id) . $parameter }}" title="Editar {{ $title }}" variant="edit" size="sm">
                                                                <x-icons.edit />
                                                            </x-button>
                                                        @endif

                                                        <form
                                                            action="{{ route($actionRoute . '.restore', $row->id) }}"
                                                            method="POST"
                                                            onclick="warningConfirm(event, 'Quer restaurar esse Registro?', 'question', 'Restaurar')"
                                                        >
                                                            @csrf
                                                            <x-button title="Restaurar esse {{ $title }}" variant="restore" size="sm">
                                                                <x-icons.restore />
                                                            </x-button>
                                                        </form>

                                                        @if (isset($actionsDepositWithDelete) && !isset($isNotAdmin))
                                                            <form method="POST" action="{{ route($actionRoute . '.destroy', $row->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <x-button
                                                                    variant="pdf-trash"
                                                                    title="Deletar {{ $title }}"
                                                                    size="sm"
                                                                    onclick="deleteConfirm(event, 'Excluir o item selecionado?', 'Por favor, insira a senha para confirmar a exclusão.', 'Excluir')"
                                                                >
                                                                    <x-icons.trash />
                                                                </x-button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        @if (!isset($isNotAdmin))
                                                            <x-button href="{{ route($actionRoute . '.edit', $row->id) . $parameter }}" title="Editar {{ $title }}" variant="edit" size="sm">
                                                                <x-icons.edit />
                                                            </x-button>
                                                        @endif

                                                        @if (!isset($archiveInsteadDestroy) && !isset($notButtonDelete))
                                                            <form method="POST" action="{{ route($actionRoute . '.destroy', $row->id) . $parameter }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <x-button
                                                                    variant="pdf-trash"
                                                                    title="Deletar {{ $title }}"
                                                                    size="sm"
                                                                    onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')"
                                                                >
                                                                    <x-icons.trash />
                                                                </x-button>
                                                            </form>
                                                        @elseif (isset($notButtonDelete))
                                                        @else
                                                            <form method="POST" action="{{ route($actionRoute . '.archive', $row->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ csrf_field() }}
                                                                @php
                                                                    if (isset($notArchiveAdmin)) {
                                                                        $hidden = $row['access_level'] == 'admin' ? 'hidden' : null;
                                                                    }
                                                                @endphp
                                                                <x-button
                                                                    variant="edit"
                                                                    title="Arquivar {{ $title }}"
                                                                    size="sm"
                                                                    class="{{ isset($notArchiveAdmin) ? $hidden : '' }}"
                                                                    onclick="warningConfirm(event, 'Essa ação irá arquivar o item selecionado!', 'warning', 'Arquivar', '{{ $actionRoute }}')"
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
                                    <tr>
                                        <td
                                            class="px-5 py-12 text-center font-medium text-gray-500  border-b border-gray-100 "
                                            colspan="{{ count($headers) + (isset($actionRoute) ? 2 : 0) }}"
                                        >
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-base">Nenhum registro encontrado.</p>
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

                @if (!isset($notPaginate))
                    @if ($rows->count() >= (isset($numberPages) ? $numberPages : 15))
                        <hr class="border-gray-200  mt-5" />
                    @endif

                    <div class="pagination mt-5">
                        {{ $rows->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@if ($isFrequency)
    <style>
        .frequency-table-scroll {
            display: block;
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            position: relative;
            isolation: isolate;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: #9BB9A5 #EAF1EC;
            overscroll-behavior-x: contain;
        }

        .frequency-table-scroll::-webkit-scrollbar {
            height: 9px;
        }

        .frequency-table-scroll::-webkit-scrollbar-track {
            background: #EAF1EC;
            border-radius: 10px;
        }

        .frequency-table-scroll::-webkit-scrollbar-thumb {
            background: #9BB9A5;
            border-radius: 10px;
        }

        .frequency-table {
            width: max-content !important;
            min-width: 1100px !important;
            table-layout: fixed !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            margin-top: 1.5rem;
            overflow: visible !important;
        }

        .frequency-table thead th {
            position: relative;
            height: 42px;
            padding: 8px 3px !important;
            color: #183C2C !important;
            background: #E3EFE7 !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            text-align: center !important;
            white-space: nowrap !important;
            border-bottom: 1px solid #DCE7E1 !important;
            z-index: 1;
        }

        .frequency-table thead th.frequency-index-header,
        .frequency-table tbody td.frequency-index {
            position: sticky !important;
            left: 0 !important;
            width: 42px !important;
            min-width: 42px !important;
            max-width: 42px !important;
            background: #FFFFFF !important;
            z-index: 5 !important;
        }

        .frequency-table thead th.frequency-index-header {
            background: #E3EFE7 !important;
            z-index: 12 !important;
        }

        .frequency-table thead th.frequency-name-header,
        .frequency-table tbody td.frequency-student {
            position: sticky !important;
            left: 42px !important;
            width: 190px !important;
            min-width: 190px !important;
            max-width: 190px !important;
            background: #FFFFFF !important;
            z-index: 5 !important;
            box-shadow: 4px 0 7px rgba(0, 0, 0, 0.09);
        }

        .frequency-table thead th.frequency-name-header {
            background: #E3EFE7 !important;
            z-index: 11 !important;
        }

        .frequency-table tbody td {
            height: 42px;
            padding: 5px 3px !important;
            text-align: center !important;
            vertical-align: middle !important;
            font-size: 13px !important;
            border-bottom: 1px solid #DCE7E1 !important;
            border-right: 1px solid #DCE7E1 !important;
        }

        .frequency-table tbody td.frequency-index {
            padding: 5px 2px !important;
            font-size: 13px !important;
            color: #78857D !important;
        }

        .frequency-table tbody td.frequency-student {
            padding: 6px 10px !important;
            color: #183C2C !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            text-align: left !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .frequency-table tbody td.frequency-day-cell {
            position: relative;
            width: 30px !important;
            min-width: 30px !important;
            max-width: 30px !important;
            padding: 3px 2px !important;
            background: #FFFFFF !important;
        }

        .frequency-table tbody td.frequency-day-cell button {
            width: 28px !important;
            min-width: 28px !important;
            height: 30px !important;
            padding: 2px !important;
            margin: 0 auto !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 12px !important;
        }

        .frequency-table tbody td.frequency-day-cell button i {
            font-size: 12px !important;
        }

        .frequency-table tbody td.frequency-absences {
            width: 55px !important;
            min-width: 55px !important;
            max-width: 55px !important;
            font-size: 13px !important;
            font-weight: 700 !important;
        }

        .frequency-table tbody tr:hover td.frequency-index,
        .frequency-table tbody tr:hover td.frequency-student {
            background: #F5F9F6 !important;
        }

        @media (max-width: 768px) {
            .frequency-table {
                min-width: 1100px !important;
            }

            .frequency-table thead th,
            .frequency-table tbody td {
                font-size: 13px !important;
            }
        }
    </style>
@endif