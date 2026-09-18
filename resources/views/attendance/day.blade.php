<x-app-layout> 
 
    <x-slot name="header"> 
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> 
 
            <div> 
                <h2 class="text-xl md:text-2xl font-bold leading-tight"> 
                    Atendimentos do dia {{ $date }} 
                </h2> 
 
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"> 
                    Selecione um atendimento para visualizar todos os detalhes. 
                </p> 
            </div> 
 
            <div class="flex gap-2"> 
 
                <x-button 
                    href="{{ route('attendance.index') }}" 
                    variant="gray" 
                > 
                    Voltar 
                </x-button> 
 
                <x-button 
                    href="{{ route('attendance.create') }}" 
                    variant="blue" 
                > 
                    Adicionar novo atendimento 
                </x-button> 
 
            </div> 
 
        </div> 
    </x-slot> 
 
 
    <div class="py-6"> 
 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> 
 
            @if($attendances->isEmpty()) 
 
                <div class="bg-white dark:bg-dark-eval-1 rounded-lg shadow p-6 text-center"> 
 
                    <p class="text-gray-500 dark:text-gray-400"> 
                        Nenhum atendimento foi registrado nesta data. 
                    </p> 
 
                    <div class="mt-4"> 
 
                        <x-button 
                            href="{{ route('attendance.create') }}" 
                            variant="blue" 
                        > 
                            Adicionar novo atendimento 
                        </x-button> 
 
                    </div> 
 
                </div> 
 
            @else 
 
                <div class="space-y-3"> 
 
                    @foreach($attendances as $attendance) 
 
                        <a 
                            href="{{ route('attendance.show', $attendance->id) }}" 
                            class="block bg-white dark:bg-dark-eval-1 rounded-lg shadow hover:shadow-md transition p-5 border border-transparent hover:border-blue-400" 
                        > 
 
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"> 
 
                                <div class="flex-1"> 
 
                                    <div class="flex items-center gap-2 mb-2"> 
 
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100"> 
                                            {{ $attendance->student->name }} 
                                        </h3> 
 
                                        <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200"> 
                                            Atendimento 
                                        </span> 
 
                                    </div> 
 
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm"> 
 
                                        <p class="text-gray-600 dark:text-gray-300"> 
                                            <strong>Professor:</strong> 
                                            {{ $attendance->professor->name ?? 'Não informado' }} 
                                        </p> 
 
                                        <p class="text-gray-600 dark:text-gray-300"> 
                                            <strong>Eixo educacional:</strong> 
                                            {{ $attendance->educational_axis ?? 'Não informado' }} 
                                        </p> 
 
                                    </div> 
 
                                    @if($attendance->advances) 
 
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3"> 
 
                                            <strong>Avanços:</strong> 
 
                                            {{ \Illuminate\Support\Str::limit($attendance->advances, 120) }} 
 
                                        </p> 
 
                                    @endif 
 
                                </div> 
 
                                <div class="flex items-center justify-end"> 
 
                                    <span class="text-blue-600 dark:text-blue-400 font-medium text-sm"> 
                                        Ver atendimento → 
                                    </span> 
 
                                </div> 
 
                            </div> 
 
                        </a> 
 
                    @endforeach 
 
                </div> 
 
            @endif 
 
        </div> 
 
    </div> 
 
</x-app-layout>