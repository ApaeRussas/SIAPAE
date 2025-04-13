{{--
$title: string que define o título da tabela.

$headers: Um array que contém os cabeçalhos das colunas da tabela. Exemplo: ['ID', 'Nome', 'Descrição', 'Data de
Criação'].

$rows: Um array que recebe os dados do Banco de dados, onde cada sub-array representa uma linha da tabela.

$variablesDB: Um array com o nomes da colunas que existem no banco de dados

$actionRoute (opcional): Contém a URL ou rota para onde o botão "Adicionar" deve redirecionar. ex:
route('dashboard')

Tutorial de como resetar as senhas dos usuários:
passo 1: execute o comando "php artisan db:seed --class=TruncateUsersTableSeeder",
passo 2: execute o comando "php artisan db:seed",
passo 3: faça login em sua conta ,
passo 4: vá no perfil e no campo de redefinir senha, troque para uma senha pessoal.
--}}

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-lg {{ isset($inTableShow) ? 'sm:shadow-md' : ' shadow-md ' }} dark:bg-dark-eval-1">
            <div class="{{ isset($inTableShow) ? 'sm:px-6 px-0 py-4' : 'p-6'}}">
                <div class="flex flex-col sm:flex-row gap-y-2 items-center justify-between mb-4">
                    @php
                        if (isset($search)) {
                            $search = 'Resultados para: ' . '"' . $search . '"';
                        } else {
                            $search = $title == 'Anamnese' ? 'Nome do Aluno p/ Anamnese' : 'Nome do ' . $title;
                        }
                    @endphp

                    @if (isset($withSearchInput))
                        <div id="search-container" class="flex items-center border border-gray-400 rounded-lg focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:focus:ring-offset-dark-eval-1 overflow-hidden w-full sm:w-auto">
                            @php
                                $route = $actionRoute . '.index';
                                if(isset($searchArchive)) {
                                    $route = $actionRoute . '.deposit';
                                }
                                if(isset($adminSearch)) {
                                    $route = 'coordinator.index';
                                }
                            @endphp
                            <form action="{{ route($route) }}" method="GET" class="flex items-center w-full">
                                <input type="text" id="search" name="search" class="focus:border-gray-500 focus:ring focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 form-control w-64 p-2 dark:text-gray-300 rounded-l-md w-full sm:w-64" placeholder="{{$search}}" />

                                <button id="icone-search" class="w-9 p-2 bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none rounded-r-md transition duration-300">
                                    <x-icons.search />
                                </button>
                            </form>
                        </div>
                    @endif

                    @if (isset($withSearchSelect))
                        <form method="GET" action="{{ isset($searchRoute) ? route($searchRoute, $element->id) : route($actionRoute . '.index') }}"  class="w-full sm:w-48">
                            <div class="form-group">
                                <x-form.select valueName="year" function="this.form.submit()">
                                    <option value="">Selecione o ano:</option>
                                    @foreach ($years as $yearItem)
                                        <option value="{{ $yearItem }}" {{ $year == $yearItem ? 'selected' : '' }}>{{ $yearItem }}
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

                        <form method="GET" action="{{route('frequency.index')}}" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                            <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-2 -mb-2 sm:mb-0">
                                <x-form.select valueName="turn_apae" notRequired>
                                    <option value="">Turno do aluno</option>

                                    <option value="Manhã" {{old('turn_apae', $turn_apae ?? '') == 'Manhã' ? 'selected' : ''}}>Manhã</option>
                                    <option value="Tarde" {{old('turn_apae', $turn_apae ?? '') == 'Tarde' ? 'selected' : ''}}>Tarde</option>
                                </x-form.select> 

                                <div class="flex gap-x-2">
                                    <x-form.input name="monthYear" placeholder="Mês/Ano" value="{{old('monthYear', $monthYear)}}"
                                        class="period-input form-control w-40 sm:w-32 monthYear" /> 
                                    
                                    <x-button class="w-full sm:w-auto flex sm:hidden">
                                        <div class="text-gray-100 dark:text-gray-100 w-full text-center"> Filtrar </div>
                                    </x-button> 
                                </div>

                                <x-form.select valueName="professor_select" notRequired>
                                    <option value="">Professor do aluno</option>
                                    
                                    @foreach ($professors as $professor)
                                        <option value="{{ $professor->id }}"
                                            {{ old('professor_select', $professor_id ?? '' ) == $professor->id ? 'selected' : '' }}>
                                            {{ $professor->name }}
                                        </option>
                                    @endforeach
                                </x-form.select> 
                            </div>
                            <div class="hidden sm:flex"> 
                                <x-button class="w-full sm:w-auto">
                                    <div class="text-gray-100 dark:text-gray-100 w-full text-center"> Filtrar </div>
                                </x-button> 
                            </div>
                        </form>         
                        @else
                        <form action="{{isset($searchRoute) ? route($searchRoute, $element->id) : route($actionRoute . '.index')}}" method="GET" class="flex gap-2 w-full sm:w-auto">
                            <div class="w-auto">
                                <x-form.input name="monthYear" placeholder="Mês/Ano" value="{{old('monthYear', $monthYear)}}"
                                    class="period-input form-control w-32 monthYear" /> 
                            </div>
                            <div> 
                                <button class="icone-search flex sm:hidden px-2.5 rounded-md bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-800 focus:outline-none transition duration-300">
                                    <x-icons.search />
                                </button>

                                <x-button class="w-auto hidden sm:flex">
                                    <div class="text-gray-100 dark:text-gray-100 w-full text-center"> Filtrar </div>
                                </x-button> 
                            </div>
                        </form>
                        @endif
                    @endif

                    @if (isset($withSearchDateRange))
                        <div id="search-container" class="flex items-center border border-gray-400 rounded-lg focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1
                                dark:focus:ring-offset-dark-eval-1 overflow-hidden w-full sm:w-auto">
                            <form method="GET" action="{{ route($actionRoute . '.index') }}" class="flex w-full sm:w-auto">
                            @php
                                if ($range) {
                                    $placeholderValue = 'Intervalo: ' . $range;
                                } else {
                                    $placeholderValue = 'Filtro: Intervalo de Datas';
                                }
                            @endphp

                            <x-form.input class="date-range w-full sm:w-80 form-control text-gra-800 dark:text-gray-300" x-init="initFlatpickr" name="date_range" placeholder="{{$placeholderValue}}" autocomplete="off"/>     
                            
                            <button class="icone-search px-2 bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none -ml-3 transition duration-300">
                                <x-icons.search />
                            </button>
                            </form>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row items-center gap-2 w-full sm:w-auto">
                        <div class="flex items-center gap-2 w-full sm:w-auto {{!isset($withExportExcel) ? 'hidden' : ''}}">
                            @if (isset($withExportExcel))
                                <form action="{{route('export.'.$actionRoute . 's')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="{{$actionRoute.'s'}}" value="{{json_encode($elementsExcelOrPdf)}}">
                                    
                                    <x-button variant="excel" title="Exportar em Excel" size="sm">
                                        <x-icons.excel-icon />
                                    </x-button>
                                </form>
                            @endif
    
                            @if (isset($withExportPdf))
                                <form action="{{route($actionRoute . '.export')}}" method="POST" target="_blank">
                                    @csrf
                                    <input type="hidden" name="{{$actionRoute.'s'}}" value="{{json_encode($elementsExcelOrPdf)}}">
                                    
                                    <x-button variant="pdf-trash" title="Exportar em PDF" size="sm" class="py-2.5">
                                        <x-icons.pdf />
                                    </x-button>
                                </form>
                            @endif
    
                            @if (isset($valueTotal))
                                <div class="flex max-w-full justify-center items-center sm:mr-2 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded w-full sm:w-auto">
                                    <p class="flex dark:text-gray-300 gap-x-1">
                                        <span class="hidden sm:flex">Valor Total:</span> 
                                        <span class="flex sm:hidden">V.T:</span> 
                                        <span class="">{{$valueTotal}} R$</span>
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if(isset($actionRoute) && !isset($notButtonAdd) && !isset($actionsDeposit) && !isset($isNotAdmin))
                            <x-button href="{{route($actionRoute . '.create')}}" variant="blue" class="w-full sm:w-auto">
                                <div class="dark:text-gray-100 text-center w-full">
                                    Adicionar {{$title}}
                                </div>
                            </x-button>
                        @endif
                    </div>
                </div>

                <hr class="border-gray-300 dark:border-gray-500 w-full sm:w-auto" />

                {{-- Tabela --}}
                <div class="overflow-x-auto scrollbar-custom ">

                <table class="min-w-full mt-4 border-collapse border border-gray-300 dark:border-gray-800">
                    <thead class="bg-blue-100 dark:bg-gray-700 dark:text-gray-200">
                        <tr>
                            @if($iteration == "true")
                                <th
                                    class="border border-gray-300 dark:border-gray-600 {{isset($headersSmall) ? 'w-8 py-1' : 'px-4 py-2'}} text-center font-semibold">
                                    # 
                                </th>
                            @endif

                            @if (!isset($headFrequency))
                            @foreach($headers as $header)
                                <th
                                    class="border border-gray-300 dark:border-gray-600 {{isset($headersSmall) ? 'px-1 py-1' : 'px-4 py-2'}} text-center font-semibold">
                                    {{ __($header) }}
                                </th>
                            @endforeach
                            @else
                            @foreach($headers as $header)
                                @if ($header == 'Nome')
                                <th
                                    class="border border-gray-300 dark:border-gray-600 w-48 py-1 text-center font-semibold">
                                    {{ __($header) }}
                                </th>
                                @else
                                <th
                                    class="border border-gray-300 dark:border-gray-600 w-frequency py-1 text-center font-semibold">
                                    {{ __($header) }}
                                </th>
                                @endif
                            @endforeach
                            @endif

                            @if(isset($actionRoute) && !isset($notActions))
                                <th
                                    class="border border-gray-300 dark:border-gray-600 {{isset($headersSmall) ? 'px-1 py-1' : 'px-8 py-2'}} text-center font-semibold">
                                    Ações 
                                </th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @if (!isset($onlyHead))
                            @forelse ($rows as $row)
                                <tr x-data @click="window.location.href = '{{ route($actionRoute . '.show', $row->id) }}'"
                                    class="hover:bg-gray-100 dark:hover:bg-gray-900 {{ isset($withShow) ? 'cursor-pointer' : ''}} transition duration-300"
                                    @if(!isset($withShow)) x-on:click.prevent @endif>

                                    @if($iteration == "true")
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                            {{ ($rows->currentPage() - 1) * $rows->perPage() + $loop->iteration }}
                                        </td>
                                    @endif

                                    @foreach ($variablesDB as $variable)
                                        <td
                                            class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-gray-800 dark:text-gray-300">
                                            @if ($variable == "date_of_birth" || $variable == "date_of_emission" || $variable == "date" || $variable == "date_of_anamnesis" || $variable == "date_pedagogical" || $variable == "date_scfv")
                                                {{ \Carbon\Carbon::parse($row->{$variable})->format('d/m/Y') }}

                                            @elseif ($variable == "image")
                                                <div class="flex justify-center items-center">
                                                    <img class="rounded-full w-10 h-10"
                                                        src="{{ asset('img/' . $actionRoute . '/' . $row->image) }}"
                                                        alt="Image not loaded">

                                                </div>

                                            @elseif ($variable == "price")
                                                <div class="flex justify-center items-center">
                                                    {{ 'R$ ' . number_format($row->{$variable}, 2, ',', '.') }}
                                                </div>

                                            @elseif ($variable == "file")
                                                <div onclick="event.stopPropagation();">
                                                    @if ($actionRoute == 'record')
                                                    <a href="{{ route('record.export', $row->id) }}" target="_blank"
                                                        class="text-blue-500 underline">
                                                        {{ \Illuminate\Support\Str::limit($row->title_header, $strLimit ?? 35) }}
                                                    </a>
                                                    
                                                    @else
                                                        {{ \Illuminate\Support\Str::limit(data_get($row, $file) ?? '------', $strLimit ?? 20) }}
                                                    @endif
                                                </div>
                                            @elseif ($variable == "number")
                                                @php $number = 0; if($row->fiscal_number == null) { $number = $row->cupom_number; } else { $number = $row->fiscal_number; }  @endphp
                                                <div class="flex justify-center items-center">
                                                    {{ \Illuminate\Support\Str::limit($number ?? '------', $strLimit ?? 15) }}
                                                </div>
                                            @else
                                                {{ \Illuminate\Support\Str::limit(data_get($row, $variable) ?? '------', $strLimit ?? 15) }}
                                                <!-- Exibe o valor com limitação de tamanho e caso não exista coloque '-----' -->
                                            @endif
                                        </td>

                                    @endforeach

                                    @if(isset($actionRoute))
                                        <td class="border border-gray-300 dark:border-gray-600 py-2"
                                            @click.stop>

                                            <div class="flex align-center justify-center gap-x-1">
                                                
                                                @if (isset($actionsDeposit))
                                                <form action="{{route($actionRoute . '.restore', $row->id)}}" method="POST"
                                                    onclick="warningConfirm(event, 'Quer restaurar esse Registro?', 'question', 'Restaurar')">
                                                    {{ csrf_field() }}
                                                    <x-button title="Restaurar esse {{$title}}" variant="restore" size="sm">
                                                        <x-icons.restore />
                                                    </x-button>
                                                </form>
                                                    @if (isset($actionsDepositWithDelete) && !isset($isNotAdmin))
                                                    <form method="POST" action="{{ route($actionRoute . '.destroy', $row->id) }}"
                                                        accept-charet="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
        
                                                        <x-button variant="pdf-trash" title="Deletar {{$title}}" size="sm"
                                                            onclick="deleteConfirm(event, 'Excluir o item selecionado?', 'Por favor, insira a senha para confirmar a exclusão.', 'Excluir')">
                                                            <x-icons.trash />
                                                        </x-button>
                                                    </form>
                                                    @endif
    
                                                @else
                                                @if (!isset($isNotAdmin))
                                                <x-button href="{{route($actionRoute . '.edit', $row->id)}}" title="Editar {{$title}}" variant="edit" size="sm">
                                                    <x-icons.edit />
                                                </x-button>
                                                @endif
    
                                                @if (!isset($archiveInsteadDestroy))
                                                <form method="POST" action="{{ route($actionRoute . '.destroy', $row->id) }}"
                                                    accept-charet="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
    
                                                    <x-button variant="pdf-trash" title="Deletar {{$title}}" size="sm" 
                                                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                                                        <x-icons.trash />
                                                    </x-button>
                                                </form>
                                                @else
                                                <form method="POST" action="{{ route($actionRoute . '.archive', $row->id) }}"
                                                    accept-charset="UTF-8" style="display:inline" >
                                                    {{ csrf_field() }}
                                                    @php
                                                        if(isset($notArchiveAdmin)) {
                                                            $hidden = null;
                                                            if($row['access_level'] == 'admin') {
                                                                $hidden = "hidden";
                                                            } 
                                                        }
                                                    @endphp
    
                                                    <x-button variant="edit" title="Arquivar {{$title}}" size="sm" class="{{isset($notArchiveAdmin) ? $hidden : ''}}"
                                                        onclick="warningConfirm(event, 'Essa ação irá arquivar o item selecionado!', 'warning', 'Arquivar')">
                                                        <x-icons.archive />
                                                    </x-button>
                                                </form>
                                                @endif
                                                @endif
                                            </td>
                                        @endif
                                </tr>
                            @empty
                                <tr class="text-center ">
                                    <td class="p-3 font-normal dark:text-gray-300 border border-gray-300 dark:border-gray-600"
                                        colspan="{{ count($headers) + (isset($actionRoute) ? 2 : 0) }}">
                                        Nenhum registro encontrado.
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
                    <hr class="border-gray-300 dark:border-gray-500 mt-4" />
                @endif
                <div class="pagination mt-4">
                    {{ $rows->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>