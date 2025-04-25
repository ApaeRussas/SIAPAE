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
        <div class="bg-white overflow-hidden rounded-lg shadow-md dark:bg-dark-eval-1 p-6" 
            x-data="{
                activeTab: localStorage.getItem('activeTab') || 'calendar',
                setActiveTab(tab) {
                    this.activeTab = tab;
                    localStorage.setItem('activeTab', tab);
                }
            }">

            {{-- Container das Abas --}}
            <div class="flex mb-4 -mt-2 border-b border-gray-200 dark:border-gray-600">

            <button @click="setActiveTab('calendar')" 
                :class="{
                    'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'calendar',
                    'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'calendar'
                }"
                class="px-4 py-2 text-sm font-medium focus:outline-none border-b-2 border-transparent transition-colors duration-300">
                Calendário
            </button>
        
            <button @click="setActiveTab('table')" 
                    :class="{
                        'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'table',
                        'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'table'
                    }"
                    class="px-4 py-2 text-sm font-medium focus:outline-none border-b-2 border-transparent transition-colors duration-300">
                Tabela
            </button>

            </div>

            {{-- Conteúdo Principal --}}

            <div x-cloak>

            <div x-show="activeTab === 'calendar'" 
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-0.5 sm:gap-2 mb-4 flex-wrap">
                    {{-- Botão anterior --}}
                    <button id="btnPrevious" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-lg">
                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
    
                    {{-- Seletor de semana --}}
                    <p id="faixaSemana" 
                        x-data="{ faixaSemana: localStorage.getItem('faixaSemana') || '{{ $faixaSemana }}' }"
                        x-init="if (!faixaSemana) { faixaSemana = '{{ $faixaSemana }}' }" 
                        x-text="faixaSemana" 
                        class="custom-p text-sm pl-2 pr-2.5 py-1 border border-gray-400 rounded-md bg-white dark:bg-gray-700 dark:border-gray-600 text-gray-900 dark:text-gray-300">
                    </p>
    
                    {{-- Botão próximo --}}
                    <button id="btnNext" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-lg">
                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4 px-3 py-1 bg-white dark:bg-gray-700 border rounded-md border-gray-400 dark:border-gray-600">
                    <p id="year"
                        x-data="{ year: localStorage.getItem('year') || '{{ $year }}' }"
                        x-init="if (!year) { year = '{{ $year }}' }" 
                        x-text="year"
                        class="text-sm text-gray-900 dark:text-gray-300">
                    </p>
                </div>
            </div>

            @if(isset($students))
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">

            {{-- SEGUNDA --}}
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-gray-100">Segunda</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400" id="segunda"> {{$diasDaSemana['segunda']}} </span>
                </div>
                <div class="p-3">
                <!-- Dropdown Manhã -->
                <details class="mb-3 group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Manhã
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="segundaManhaList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasMondayMorningStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->monday === true && $student->turn_apae === 'Manhã')
                            @php
                                $hasMondayMorningStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['segunda']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} transform transition-all duration-300 opacity-0 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['segunda'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['segunda'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasMondayMorningStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para segunda de manhã</li>
                        @endif
                    </ul>
                </details>

                <!-- Dropdown Tarde -->
                <details class="group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Tarde
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="segundaTardeList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasMondayAfternoonStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->monday === true && $student->turn_apae === 'Tarde')
                            @php
                                $hasMondayAfternoonStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['segunda']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['segunda'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['segunda'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasMondayAfternoonStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para segunda de tarde</li>
                        @endif
                    </ul>
                </details>
                </div>
            </div>

            {{-- TERÇA --}}
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-gray-100">Terça</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400" id="terca"> {{$diasDaSemana['terca']}} </span>
                </div>
                <div class="p-3">
                <!-- Dropdown Manhã -->
                <details class="mb-3 group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Manhã
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="tercaManhaList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasTuesdayMorningStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->tuesday === true && $student->turn_apae === 'Manhã')
                            @php
                                $hasTuesdayMorningStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['terca']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['terca'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['terca'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasTuesdayMorningStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para terça de manhã</li>
                        @endif
                    </ul>
                </details>

                <!-- Dropdown Tarde -->
                <details class="group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Tarde
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="tercaTardeList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasTuesdayAfternoonStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->tuesday === true && $student->turn_apae === 'Tarde')
                            @php
                                $hasTuesdayAfternoonStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['terca']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['terca'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['terca'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasTuesdayAfternoonStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para terça de tarde</li>
                        @endif
                    </ul>
                </details>
                </div>
            </div>

            {{-- QUARTA --}}
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-gray-100">Quarta</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400" id="quarta"> {{$diasDaSemana['quarta']}} </span>
                </div>
                <div class="p-3">
                <!-- Dropdown Manhã -->
                <details class="mb-3 group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Manhã
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="quartaManhaList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasMondayMorningStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->wednesday === true && $student->turn_apae === 'Manhã')
                            @php
                                $hasMondayMorningStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['quarta']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['quarta'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['quarta'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasMondayMorningStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para quarta de manhã</li>
                        @endif
                    </ul>
                </details>

                <!-- Dropdown Tarde -->
                <details class="group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Tarde
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="quartaTardeList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasWednesdayAfternoonStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->wednesday === true && $student->turn_apae === 'Tarde')
                            @php
                                $hasWednesdayAfternoonStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['quarta']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['quarta'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['quarta'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasWednesdayAfternoonStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para quarta tarde</li>
                        @endif
                    </ul>
                </details>
                </div>
            </div>

            {{-- QUINTA --}}
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-gray-100">Quinta</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400" id="quinta"> {{$diasDaSemana['quinta']}} </span>
                </div>
                <div class="p-3">
                <!-- Dropdown Manhã -->
                <details class="mb-3 group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Manhã
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="quintaManhaList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasThursdayMorningStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->thursday === true && $student->turn_apae === 'Manhã')
                            @php
                                $hasThursdayMorningStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['quinta']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['quinta'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['quinta'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasThursdayMorningStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para quinta de manhã</li>
                        @endif
                    </ul>
                </details>

                <!-- Dropdown Tarde -->
                <details class="group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Tarde
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="quintaTardeList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasThursdayAfternoonStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->thursday === true && $student->turn_apae === 'Tarde')
                            @php
                                $hasThursdayAfternoonStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['quinta']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['quinta'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['quinta'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasThursdayAfternoonStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para quinta de tarde</li>
                        @endif
                    </ul>
                </details>
                </div>
            </div>

            {{-- SEXTA --}}
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-gray-100">Sexta</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400" id="sexta"> {{$diasDaSemana['sexta']}} </span>
                </div>
                <div class="p-3">
                <!-- Dropdown Manhã -->
                <details class="mb-3 group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Manhã
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="sextaManhaList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasFridayMorningStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->friday === true && $student->turn_apae === 'Manhã')
                            @php
                                $hasFridayMorningStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['sexta']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['sexta'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['sexta'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasFridayMorningStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para sexta de manhã</li>
                        @endif
                    </ul>
                </details>

                <!-- Dropdown Tarde -->
                <details class="group" open> 
                    <summary class="cursor-pointer text-sm font-semibold text-gray-900 dark:text-gray-100 list-none flex items-center justify-between">
                        Tarde
                        <span class="text-xs inline-block transform transition-transform duration-200 group-open:rotate-180">&#9660;</span>
                    </summary>
                    <ul id="sextaTardeList" class="mt-2 space-y-1 transition-all duration-300 overflow-hidden max-h-0 opacity-0 group-open:max-h-[500px] group-open:opacity-100">
                        @php
                            $hasFridayAfternoonStudents = false;
                        @endphp
                        @foreach($students as $student)
                        @if($student->friday === true && $student->turn_apae === 'Tarde')
                            @php
                                $hasFridayAfternoonStudents = true;
                                list($day, $month) = explode('/', $diasDaSemana['sexta']);
                                $day = ltrim($day, '0');
                                $frequency = collect($frequencies)->where('student_id', $student->id)->where('month_year', $month . '/' . $year)->first();
                                $attendanceExists = App\Models\Attendance::where('student_id', $student->id)->where('date', $year . '-' . $month . '-' . $day)->exists();
                            @endphp
                            @if($frequency)
                                <li class="text-sm {{$frequency->{$day} === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : ($frequency->{$day} === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300') }} truncate transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                    <div class="flex items-center space-x-1.5">
                                        <a href="{{$frequency->{$day} === true ? route('attendance.show', ['student_id' => $student->id, 'date' => $diasDaSemana['sexta'], 'year' => $year, $student->id]) : ($frequency->{$day} === false ? '#' : route('attendance.create', ['student_id' => $student->id, 'date' => $diasDaSemana['sexta'], 'year' => $year]))}}" class="truncate">
                                            {{$student->name}}
                                        </a>
                                        @if($attendanceExists)
                                            <span class="flex-shrink-0">✓</span>
                                        @elseif($frequency->{$day} === true)
                                            <span class="flex-shrink-0">✗</span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endif
                        @endforeach
                        @if(!$hasFridayAfternoonStudents)
                            <li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para sexta de tarde</li>
                        @endif
                    </ul>
                </details>
                </div>
            </div>

        @else
        <div class="flex items-center justify-center">
            <p class="text-gray-900 dark:text-gray-200"> 
                Nenhum Aluno Cadastrado no Sistema
            </p>
        </div>
        @endif
        
        </div>
        </div> 


            <div x-show="activeTab === 'table'" 
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

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
                            dark:focus:ring-offset-dark-eval-1 overflow-hidden">
                            @php
                                $route = $actionRoute . '.index';
                            @endphp
                            <form action="{{ route($route) }}" method="GET">
                                <x-form.input type="text" id="search" name="search"
                                    class="form-control w-64 dark:text-gray-400" placeholder="{{$search}}" />

                                <button id="icone-search" class="px-2 bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none -ml-3 transition duration-300">
                                    <x-icons.search />
                                </button>
                            </form>
                        </div>
                    @endif

                    @if (isset($withSearchSelect))
                        <form method="GET" action="{{ route($actionRoute . '.index') }}">
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
                            list($turn_apae, $monthYear) = explode('-', $variablesSearchFrequency);
                        @endphp

                        <form method="GET" action="{{route('frequency.index')}}" class="flex gap-x-2">
                            <div>
                                <x-form.select valueName="turn_apae" notRequired>
                                    <option value="">Turno do aluno</option>

                                    <option value="Manhã" {{old('turn_apae', $turn_apae ?? '') == 'Manhã' ? 'selected' : ''}}>Manhã</option>
                                    <option value="Tarde" {{old('turn_apae', $turn_apae ?? '') == 'Tarde' ? 'selected' : ''}}>Tarde</option>
                                </x-form.select> 

                                <x-form.input name="monthYear" placeholder="Mês/Ano" value="{{old('monthYear', $monthYear)}}"
                                    class="period-input form-control w-32 monthYear" /> 
                            </div>
                            <div> 
                                <x-button>
                                    <div class="text-gray-100 dark:text-gray-100 text-md"> Filtrar </div>
                                </x-button> 
                            </div>
                        </form>         
                        @else
                        <form action="{{route('student.show', $student->id)}}" method="GET" class="flex gap-x-2">
                            <div>
                                <x-form.input name="monthYear" placeholder="Mês/Ano" value="{{old('monthYear', $monthYear)}}"
                                    class="period-input form-control w-32 monthYear" /> 
                            </div>
                            <div> 
                                <x-button>
                                    <div class="text-gray-100 dark:text-gray-100 text-md"> Filtrar </div>
                                </x-button> 
                            </div>
                        </form>
                        @endif
                    @endif

                    @if (isset($withSearchDateRange))
                        <div id="search-container" class="flex items-center border border-gray-400 rounded-lg focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:focus:ring-offset-dark-eval-1 overflow-hidden w-full sm:w-auto">
                        <form method="GET" action="{{isset($searchRoute) ? route($searchRoute, $element->id) : route($actionRoute . '.index')}}" class="flex w-full sm:w-auto">
                            @php
                                if ($range) {
                                    $placeholderValue = 'Intervalo: ' . $range;
                                } else {
                                    $placeholderValue = 'Filtro: Intervalo de Datas';
                                }
                            @endphp

                            <x-form.input class="date-range w-full sm:w-80 form-control text-gra-800 dark:text-gray-400" x-init="initFlatpickr" name="date_range" placeholder="{{$placeholderValue}}" autocomplete="off"/>     
                            
                            <button class="icone-search px-2 bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none -ml-3 transition duration-300">
                                <x-icons.search />
                            </button>
                        </form>
                        </div>
                    @endif

                    <div class="flex gap-2 w-full sm:w-auto">
                        @if (isset($withExportExcel))
                            {{--<x-button href="{{route($actionRoute . '.export')}}" variant="success" class="gap-x-2">
                                <x-icons.excel-icon />
                            
                                <div class="dark:text-gray-100">
                                    Exportar
                                </div>
                            </x-button>--}}
                            <form action="{{route('export.'.$actionRoute . 's')}}" method="POST">
                                @csrf
                                <input type="hidden" name="{{$actionRoute.'s'}}" value="{{json_encode($rows->items())}}">
                                
                                <x-button variant="excel" title="Exportar em Excel" size="sm">
                                    <x-icons.excel-icon />
                                </x-button>
                            </form>
                        @endif

                        @if (isset($withExportPdf))
                            <form action="{{route($actionRoute . '.export')}}" method="POST">
                                @csrf
                                <input type="hidden" name="{{$actionRoute.'s'}}" value="{{json_encode($rows->items())}}">
                                
                                <x-button variant="pdf-trash" title="Exportar em PDF" size="sm" class="py-2.5">
                                    <x-icons.pdf />
                                </x-button>
                            </form>
                        @endif

                        @if (isset($valueTotal))
                        <div class="flex justify-center items-center mr-2 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded">
                            <p class="dark:text-gray-400">
                                Valor Total: {{$valueTotal}} R$
                            </p>
                        </div>
                        @endif

                        @if(isset($actionRoute) && !isset($notButtonAdd) && !isset($actionsDeposit) && !isset($isNotAdmin))
                            <x-button href="{{route($actionRoute . '.create')}}" variant="blue" class="w-full sm:w-auto">
                                <div class="dark:text-gray-100 w-full text-center">
                                    Adicionar {{$title}}
                                </div>
                            </x-button>
                        @endif
                    </div>
                </div>

                <hr class="border-gray-300 dark:border-gray-500" />

                {{-- Tabela --}}
                <div class="overflow-x-auto scrollbar-custom">

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
                                <tr x-data @click="window.location.href = '{{ route($actionRoute . '.show', [$row->id]) }}'"
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
                                                        onclick="deleteConfirm(event)">
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
                                    <td class="p-3 font-normal dark:text-gray-400 border border-gray-300 dark:border-gray-600"
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
</div>

<script>
    document.getElementById('clearLocalStorageBtn').addEventListener('click', function() {
        localStorage.removeItem('faixaSemana');
        localStorage.removeItem('year');
        localStorage.removeItem('diasDaSemana');
        localStorage.removeItem('studentsData');
        location.reload();
    });

    $(document).ready(function () {
        var faixaSemana = localStorage.getItem('faixaSemana') ? localStorage.getItem('faixaSemana') : '{{ $faixaSemana }}'; 
        var year = localStorage.getItem('year') ? localStorage.getItem('year') : '{{ $year }}';
        
        var sessionFaixaSemana = "{{ session('faixaSemana') }}";
        var sessionYear = "{{ session('year') }}";

        if (sessionFaixaSemana && sessionYear) {
            faixaSemana = sessionFaixaSemana;
            year = sessionYear;

            // Remove os dados da sessão para evitar recarregamentos desnecessários
            sessionStorage.removeItem('faixaSemana');
            sessionStorage.removeItem('year');

            // Recarrega a lista de alunos
            mudarSemana(faixaSemana, 0, year);
            
            $.ajax({
                url: '{{ route('attendance.clearSession') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                    }
                },
                error: function () {
                    console.error("Erro ao limpar a sessão.");
                }
            });

            sessionFaixaSemana = null;
            sessionYear = null;
        }

        $('#btnPrevious').on('click', function () {
            mudarSemana(faixaSemana, -1, year);
        });
        $('#btnNext').on('click', function () {
            mudarSemana(faixaSemana, 1, year);
        });

        // Função para fazer a requisição AJAX e atualizar a faixa da semana
        function mudarSemana(faixa, direcao, year) {
            $.ajax({
                url: '{{ route('attendance.weekChange') }}',
                type: 'GET',
                data: {
                    faixaSemana: faixa,
                    direcao: direcao,
                    year: year,
                },
                success: function (data) {
                    // Atualiza a faixa da semana e ano na página e tbm att a faixaSemana e year
                    $('#faixaSemana').text(data.faixaSemana);
                    $('#year').text(data.year);
                                
                    faixaSemana = data.faixaSemana;
                    year = data.year;

                    // Armazena as variáveis no localStorage
                    localStorage.setItem('faixaSemana', data.faixaSemana);
                    localStorage.setItem('year', data.year);
                    localStorage.setItem('diasDaSemana', JSON.stringify(data.diasDaSemana));

                    // Atualiza os dias da semana (data de cada dia)
                    updateDiasDaSemana(data.diasDaSemana);

                    // Atualiza a lista de alunos e suas frequências
                    updateStudentsList(data.studentsWithFrequency, data.diasDaSemana, data.year);
                },
                error: function () {
                    alert('Erro ao carregar a faixa de semana');
                }
            });
        }
        function updateDiasDaSemana(diasDaSemana) {
        for (let day in diasDaSemana) {
            $('#' + day).text(diasDaSemana[day]); 
        }
        }
        // Função para atualizar a lista de alunos
        function updateStudentsList(studentsWithFrequency, diasDaSemana, year) {
            const studentsData = {};

            // Loop através dos dias da semana
            for (let day in diasDaSemana) {
                var dayName = day;
                var dayDate = diasDaSemana[day];
                
                var [dayNumber, month] = dayDate.split('/');
                dayNumber = dayNumber.startsWith('0') ? dayNumber.substring(1) : dayNumber;

                // Limpa as listas de alunos para aquele dia e turno
                $('#' + dayName + 'ManhaList').empty();
                $('#' + dayName + 'TardeList').empty();

                let hasMorningStudents = false;
                let hasAfternoonStudents = false;

                // Arrays para armazenar os alunos de cada turno
                const morningStudents = [];
                const afternoonStudents = [];

                studentsWithFrequency.forEach(function(item) {
                    var student = item.student;
                    var frequency = item.frequencies[dayName];
                    var attendanceExists = item.attendanceExists[dayName];
                    
                    // Verifica se o aluno tem uma tabela de frequência para o mês/ano
                    if (student.frequencyExists === true) {
                        var className = frequency === true ? 'text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-400' : (frequency === false ? 'text-red-600 dark:text-red-500' : 'text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-300');
                        var ahref = frequency === true ? '<a href="attendance/show?student_id=' + student.id + '&date=' + dayDate + '&year=' + year + '">' + student.name + '</a>' : (frequency === false ? '<a href="#">' + student.name + '</a>' : '<a href="/attendance/create?student_id=' + student.id + '&date=' + dayDate + '&year=' + year + '">' + student.name + '</a>');
                        var listItem = `
                            <li class="text-sm ${className} transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">
                                <div class="flex items-center space-x-1">
                                    <span class="truncate">${ahref}</span>
                                    ${attendanceExists === true ? '<span class="flex-shrink-0">✓</span>' : (frequency === true ? '<span class="flex-shrink-0">✗</span>' : '')}
                                </div>
                            </li>
                        `;

                        // Verifica se o aluno deve aparecer na lista para o dia atual
                        if ((dayName === 'segunda' && student.monday) ||
                            (dayName === 'terca' && student.tuesday) ||
                            (dayName === 'quarta' && student.wednesday) ||
                            (dayName === 'quinta' && student.thursday) ||
                            (dayName === 'sexta' && student.friday)) {
           
                            // Verifica o turno do aluno
                            if (student.turn_apae === 'Manhã') {
                                $('#' + dayName + 'ManhaList').append(listItem);
                                morningStudents.push(listItem);
                                hasMorningStudents = true;
                            } else if (student.turn_apae === 'Tarde') {
                                $('#' + dayName + 'TardeList').append(listItem); 
                                afternoonStudents.push(listItem);
                                hasAfternoonStudents = true;
                            }
                        }
                    }
                });

                const noStudentsMessage = '<li class="text-sm text-gray-700 dark:text-gray-400 transform transition-all duration-300 opacity-0 translate-y-2 group-open:opacity-100 group-open:translate-y-0">Nenhum aluno para ' + dayName + ' manhã</li>';

                // Adiciona uma mensagem se não houver alunos em cada turno
                if (!hasMorningStudents) {
                    $('#' + dayName + 'ManhaList').append(noStudentsMessage);
                    morningStudents.push(noStudentsMessage);
                }
                if (!hasAfternoonStudents) {
                    $('#' + dayName + 'TardeList').append(noStudentsMessage);
                    afternoonStudents.push(noStudentsMessage);
                }         
                
                // Armazena os alunos no objeto studentsData
                studentsData[dayName] = {
                    manha: morningStudents,
                    tarde: afternoonStudents
                };
            }
            // Salva os dados no localStorage
            localStorage.setItem('studentsData', JSON.stringify(studentsData));

            // Carrega os dados do localStorage após a atualização
            loadStudentsFromLocalStorage();
        }

        function loadStudentsFromLocalStorage() {
            const studentsData = JSON.parse(localStorage.getItem('studentsData'));

            if (studentsData) {
                for (let day in studentsData) {
                    const dayData = studentsData[day];

                    // Preenche a lista de alunos da manhã
                    if (dayData.manha) {
                        $('#' + day + 'ManhaList').html(dayData.manha.join(''));
                    }

                    // Preenche a lista de alunos da tarde
                    if (dayData.tarde) {
                        $('#' + day + 'TardeList').html(dayData.tarde.join(''));
                    }
                }
            } 
        }
        function loadDiasDaSemana() {
            const diasDaSemana = JSON.parse(localStorage.getItem('diasDaSemana'));

            if (diasDaSemana) {
                for (let day in diasDaSemana) {
                    $('#' + day).text(diasDaSemana[day]);
                }
            } 
        }

        // Carregar os dias da semana ao carregar a página
        loadDiasDaSemana();
        // Carrega os itens do localStorage ao carregar a página
        loadStudentsFromLocalStorage();
    });
</script>