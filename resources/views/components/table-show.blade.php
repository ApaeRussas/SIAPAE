{{--
$title: string que define o título da tabela.

$headers: Um array que contém os cabeçalhos das colunas da tabela. Exemplo: ['ID', 'Nome', 'Descrição', 'Data de
Criação'].

$rows: Um array que recebe os dados do Banco de dados, onde cada sub-array representa uma linha da tabela.

$variablesDB: Um array com o nomes da colunas que existem no banco de dados

$actionRoute (opcional): Contém a URL ou rota para onde o botão "Adicionar" deve redirecionar. ex:
route('dashboard')
--}}
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-lg shadow-md dark:bg-dark-eval-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-xl font-bold leading-tight">{{ $title }}</h1>

                    <div class="flex gap gap-x-2">
                        @if (isset($exportPdf))
                            <x-button href="{{route($actionRoute . '.export', $elementShow->id)}}" variant="pdf-trash" title="Exportar em PDF" size="sm" class="py-2.5 flex sm:hidden" target="_blank">
                                <x-icons.pdf />
                            </x-button>

                            <x-button href="{{route($actionRoute . '.export', $elementShow->id)}}" class="hidden sm:flex" title="Exportar em PDF" variant="danger" target="_blank">    
                                <div class="flex gap-x-1">
                                    <div class="pt-0.5 mr-0.5">
                                        <x-icons.pdf class="flex-shrink-0 w-5 h-5" aria-hidden="true" />
                                    </div>
                                    <p class="text-gray-100">
                                        Exportar - PDF
                                    </p>
                                </div>     
                            </x-button>
                        @endif
                        @if(isset($actionRoute) && !isset($isArchived))
                            @if (!isset($notButtonBack))
                                @php
                                    $backUrlProvisory = session('previous_url_secondary', route($actionRoute . '.index'));
                                    $backUrl = session('previous_url', $backUrlProvisory);
                                @endphp
                                <x-button href="{{ $backUrl }}" title="Voltar para a tabela de {{ $title }}" variant="primary" size="sm">
                                    <div class="text-white flex sm:hidden">
                                        <x-icons.back />
                                    </div>

                                    <p class="text-base text-white hidden sm:flex px-1.5 py-0.5">
                                        Voltar
                                    </p>
                                </x-button>
                            @endif
                            @else
                            <x-button href="{{ route($actionRoute . '.deposit') }}" title="Voltar para a tabela de {{ $title }}" variant="primary" size="sm">
                                <div class="text-white flex sm:hidden">
                                    <x-icons.back />
                                </div>

                                <p class="text-base text-white hidden sm:flex px-1.5 py-0.5">
                                    Voltar
                                </p>
                            </x-button>
                        @endif
                    </div>
                </div>
                <hr class="border-gray-300 dark:border-gray-500" />

                <div class="min-w-full mt-3">
                    <div id="body">
                        @if (isset($onlyHead) == 0)

                            @if (isset($divisionLateral))
                                @php        
                                    $chunkedItems = array_chunk($labelsVariables, $quantLateral); // Divide a coleção em pedaços de 3 itens cada 
                                @endphp

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 relative">
                                    <!-- Div esquerda -->
                                    <div >
                                        @foreach ($chunkedItems[0] as $item)
                                            <x-anamnesis.label isShow>
                                                {{ $item[0] }}:
                                            </x-anamnesis.label>

                                            <x-form.p_show>
                                                @if ($item[1] == "price")
                                                    {{ 'R$ ' . number_format($elementShow->{$item[1]}, 2, ',', '.') }}
                                                @elseif ($item[2] == "date")
                                                    {{ \Carbon\Carbon::parse($elementShow->{$item[1]})->format('d/m/Y') }}
                                                @elseif ($item[2] == "array")
                                                    @php
                                                        $numberItens = count(data_get($elementShow, $item[1]));
                                                    @endphp
                                                    @foreach (data_get($elementShow, $item[1]) as $index => $itemArray)
                                                        @if ($index < $numberItens - 2)
                                                            {{ $itemArray->name . ', ' }}
                                                        @elseif ($index === $numberItens - 2)
                                                            {{ $itemArray->name . ' e ' }}
                                                        @else
                                                            {{ $itemArray->name }}
                                                        @endif
                                                    @endforeach 
                                                @elseif ($item[2] == "array_pivot")
                                                    @php
                                                        $elementsPivot = $elementShow->professors;
                                                        $numberItens = count($elementsPivot);
                                                    @endphp
                                                    @forelse ($elementsPivot as $index => $itemArray)
                                                        @if ($index < $numberItens - 2)
                                                            {{ $itemArray->name . ', ' }}
                                                        @elseif ($index === $numberItens - 2)
                                                            {{ $itemArray->name . ' e ' }}
                                                        @else
                                                            {{ $itemArray->name ?? '-----'}}
                                                        @endif
                                                    @empty
                                                    -----
                                                    @endforelse
                                                @else
                                                    {{ data_get($elementShow, $item[1]) ?? '-----' }}
                                                @endif
                                            </x-form.p_show>
                                        @endforeach
                                    </div>

                                    <!-- Div direita -->
                                    <div>
                                        @foreach ($chunkedItems[1] as $item)
                                            <x-anamnesis.label isShow>
                                                {{ $item[0] }}:
                                            </x-anamnesis.label>

                                            <x-form.p_show >
                                                @if ($item[1] == "price")
                                                    {{ 'R$ ' . number_format($elementShow->{$item[1]}, 2, ',', '.') }}
                                                @elseif ($item[2] == "date")
                                                    {{ \Carbon\Carbon::parse($elementShow->{$item[1]})->format('d/m/Y') }}
                                                @elseif ($item[2] == "array")
                                                    @php
                                                        $numberItens = count(data_get($elementShow, $item[1]));
                                                    @endphp
                                                    @foreach (data_get($elementShow, $item[1]) as $index => $itemArray)
                                                        @if ($index < $numberItens - 2)
                                                            {{ $itemArray->name . ', ' }}
                                                        @elseif ($index === $numberItens - 2)
                                                            {{ $itemArray->name . ' e ' }}
                                                        @else
                                                            {{ $itemArray->name }}
                                                        @endif
                                                    @endforeach  
                                                @elseif ($item[2] == "array_pivot")
                                                    @php
                                                        $elementsPivot = $elementShow->professors;
                                                        $numberItens = count($elementsPivot);
                                                    @endphp
                                                    @forelse ($elementsPivot as $index => $itemArray)
                                                        @if ($index < $numberItens - 2)
                                                            {{ $itemArray->name . ', ' }}
                                                        @elseif ($index === $numberItens - 2)
                                                            {{ $itemArray->name . ' e ' }}
                                                        @else
                                                            {{ $itemArray->name ?? '-----'}}
                                                        @endif
                                                    @empty
                                                    -----
                                                    @endforelse
                                                @else
                                                    {{ data_get($elementShow, $item[1]) ?? '-----' }}
                                                @endif
                                            </x-form.p_show>
                                        @endforeach
                                    </div>

                                    <!-- Linha divisória -->
                                    <div class="hidden sm:block absolute top-0 bottom-0 left-1/2 transform -translate-x-1/2 border-l border-gray-300 dark:border-gray-600"></div>
                                </div>
                            @else

                                @foreach ($labelsVariables as $item)
                                    <p class="py-2 dark:text-gray-400 text-gray-700">
                                        {{ $item[0] }}:
                                    </p>

                                    @if ($item[2] != 'textarea')
                                    <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                                        font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                                        {{ data_get($elementShow, $item[1]) ?? '-----' }}
                                    </p>
                                    @else
                                    <x-form.textarea disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="{{$item[1]}}">
                                        {{ data_get($elementShow, $item[1]) ?? '-----'}}
                                    </x-form.textarea>
                                    @endif
                                @endforeach

                            @endif

                        @else
                            {{$slot}}
                        @endif

                        @if(isset($additional))
                            {{$slot}}
                        @endif

                    </div>

                    <div>
                        @if(isset($actionRoute) && !isset($isArchived) && !isset($notEditDelete))

                            @php
                                if(isset($notRegularSidebar)) {
                                    $parameter = '?notRegularSidebar=1';
                                } else {
                                    $parameter = null;
                                }
                            @endphp

                            <div class="py-2 flex items-center justify-between mt-4">
                                <x-button href="{{route('student.edit', $elementShow->id) . $parameter}}" class="flex sm:hidden" title="Editar {{ $title }}" variant="edit" size="sm">
                                    <x-icons.edit />
                                </x-button>

                                <x-button
                                    href="{{route($actionRoute . '.edit', $elementShow->id) . $parameter}}"
                                    variant="warning" title="Editar {{$title}}" class="hidden sm:flex">
                                    <p class="text-gray-900 px-2">
                                        {{ __('Editar') }}
                                    </p>
                                </x-button>

                                @if (!isset($notButtonDelete))
                                <form method="POST"
                                    action="{{ route($actionRoute . '.destroy', $elementShow->id) . $parameter}}"
                                    accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}

                                    <x-button variant="pdf-trash" title="Deletar {{$title}}" size="sm" class="flex sm:hidden"
                                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                                        <x-icons.trash />
                                    </x-button>

                                    <x-button type="submit" variant="danger" title="Deletar {{$title}}" class="hidden sm:flex"
                                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                                        <div class="text-gray-100 dark:text-gray-200 px-2">
                                            {{ __('Deletar') }}
                                        </div>
                                    </x-button>
                                </form>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
