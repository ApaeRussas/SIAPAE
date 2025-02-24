{{--
$title: string que define o título da tabela.

$labelsVariablesTypes: Um array de arrays que contém respectivamente o label, nome na tabela e o tipo do input de um
determinado item
ex: [['Nome do Aluno', 'name', 'text', 'Ex: João'], ['..','..','....', '...'], ..]
$itens[0] -> Label para o campo
$itens[1] -> Nome do campo na Database
$itens[2] -> Type do input
$itens[3] -> Nome no placeholder (opcional, caso o label para o campo seja estranho)

$actionRoute: Contém a URL ou rota para onde o botão "Adicionar" deve redirecionar. ex:
route('dashboard')
--}}

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-lg shadow-md dark:bg-dark-eval-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-xl sm:text-2xl font-bold leading-tight pt-2">Adicionar novo(a) {{ $title }}</h1>

                    <x-button href="{{ route($actionRoute . '.index') }}" title="Voltar para a tabela de {{ $title }}" variant="primary" size="sm">
                        <div class="text-white flex sm:hidden">
                            <x-icons.back />
                        </div>

                        <p class="text-base text-white hidden sm:flex px-1.5 py-0.5">
                            Voltar
                        </p>
                    </x-button>
                </div>
                <hr class="border-gray-300 dark:border-gray-500" />

                @if (session()->has('error'))
                    <div class="text-red-600 dark:text-red-400">
                        {{session('error')}}
                    </div>
                @endif

                <form id="dateForm" action="{{ route($actionRoute . '.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    @if ($title === "Registro de Atendimento")
                        <input type="hidden" id="year" name="year" value="">
                        <input type="hidden" id="faixaSemana" name="faixaSemana" value="">
                    @endif

                    @if(isset($onlyHead) == 0)

                        @php $arrayIndex = 0; /* Para quando o $selects tiver mais de um array dentro */ @endphp

                        @foreach ($labelsVariablesTypes as $itens)
                            <div class="mb-3">
                                <label for="{{ $itens[1] }}"
                                    class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                                    {{ $itens[0] }}: <span class="text-red-700 dark:text-red-500">*</span>
                                </label>

                                @if($itens[2] == "text")

                                    <x-form.input id="{{ $itens[1] }}" type="text" name="{{ $itens[1] }}"
                                        value="{{ old($itens[1], (isset($itens[4]) ? $itens[4] : '')) }}" class="w-full dark:text-gray-400"
                                        placeholder="{{ isset($itens[3]) ? $itens[3] : $itens[0] }}" required />

                                @elseif($itens[2] == "date")

                                    <x-form.input id="{{ $itens[1] }}" type="text" name="{{ $itens[1] }}"
                                        value="{{ old($itens[1], (isset($itens[4]) ? $itens[4] : '')) }}" class="w-full dark:text-gray-400 date dateInput" autocomplete="off"
                                        x-init="initFlatpickr" placeholder="{{ isset($itens[3]) ? $itens[3] : $itens[0] }}" required />

                                    <span id="errorMessage" style="color: red; display: none;">Data inválida. Insira uma data entre 1960 e 2200.</span>
                                    
                                @elseif($itens[2] == "textarea")

                                    <x-form.textarea id="{{ $itens[1] }}" name="{{ $itens[1] }}"
                                        value="{{ old($itens[1], (isset($itens[4]) ? $itens[4] : '')) }}" class="w-full dark:text-gray-400" sizeFont="base"
                                        placeholder="{{ isset($itens[3]) ? $itens[3] : $itens[0] }}" required height="{{$itens[1]}}">
                                        {{old($itens[1])}}
                                    </x-form.textarea>

                                @elseif($itens[2] == "select")
                                
                                    <x-form.select idSelect="{{ $itens[1] }}" valueName="{{ $itens[1] }}">
                                        <option value=""> Selecione um(a) {{ $itens[0] }} </option>

                                        @php 
                                        // Se for um array de arrays, alterna entre os elementos de cada array de 0->1->2, caso contrário, usa o array simples
                                        if (is_array($selects ?? null)) {
                                            $selectsSelected = $selects[$arrayIndex];
                                            $arrayIndex++;
                                        } else {
                                            $selectsSelected = $selects;
                                        }
                                        @endphp

                                        @foreach ($selectsSelected as $select)
                                            <option value="{{ $select->id }}" {{ old($itens[1], $itens[1] == "signature" ? Auth::user()->id : (isset($itens[4]) ? $itens[4] : '' )) == $select->id ? 'selected' : '' }}>
                                                {{ $select->name }}
                                            </option>
                                        @endforeach

                                    </x-form.select>

                                @elseif($itens[2] == "file")
                                    <div class="flex items-center">
                                        <x-form.button-image />

                                        <input id="file-upload" type="file" name="{{ $itens[1] }}" value="{{ old($itens[1]) }}"
                                            class="hidden" onchange="updateImageLabel(event)">

                                        <p id="label-image" class="ml-2 text-gray-700 dark:text-gray-500">
                                            Nenhuma {{$itens[1] == "image" ? 'Imagem' : $title}} Selecionada {{$itens[1] == "image" ? '(*opcional)' : ''}}
                                        </p>
                                    </div>
                                
                                @elseif($itens[2] == "number")
                                    <x-form.input id="{{ $itens[1] }}" type="number" name="{{ $itens[1] }}" min="1"
                                        value="{{ old($itens[1], (isset($itens[4]) ? $itens[4] : '')) }}" class="w-64 dark:text-gray-400"
                                        placeholder="{{ isset($itens[3]) ? $itens[3] : $itens[0] }}" required />
                                @else
                                    <p>O campo escolhido não existe no componente</p>
                                @endif

                                @error($itens[1])
                                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                                @enderror
                            </div>
                        @endforeach

                    @else
                        {{$slot}}
                    @endif

                    @if (isset($notButtonAdd))
                    @else
                    <div>
                        <x-button id="submitButton" variant="blue" class="w-full mt-2" onclick="handleClick()">
                            <p class="text-center w-full">Adicionar</p>
                            <i id="loadingSpinner" class="fa fa-spinner fa-spin hidden ml-2"></i> 
                        </x-button>
                    </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>

{{-- ATENÇÃO:
A máscara que eu coloquei para um input do tipo data só funciona se o type do input for text
então no controller vc vai precisar converter esse dado no controller, imagine
public function store (......) {
$data = $request->validated()
// logo, vc irá precisar converter o campo data dessa forma:
$data['date_in_database'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_in_database'])->format('Y-m-d');
}
O formato 'd/m/Y' é o que está no input e o formato' Y-m-d' é o que o banco de dados aceita
--}}