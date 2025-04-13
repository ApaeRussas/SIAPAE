@section('title', __('Not Found')) 
<x-app-layout :notRegularSidebar="isset($notRegularSidebar) ? true : null" :element="isset($student) ? $student : null">

    <x-slot name="header">
        <div class="flex items-center gap-x-1">
            <h2 class="text-xl font-semibold leading-tight m-bottom">
                ERROR 404
            </h2>
            <x-button button variant="question" size="sm"
                onclick="guestText('info', '<div class=&quot;text-center&quot;> O Erro 404 designa: Página Não Encontrada <br> <br> Isso ocorre quando a parte do site ou item/registro que você está procurando não existe no site, seja porque foi retirado ou simplesmente não foi implementado. <br> <br> Confira se a url digitada está correta ou se o registro ou a parte do site definitamente existe. Se o problema persistir, contate a administração. </div>')">
                <x-icons.question />
            </x-button>
        </div>
    </x-slot>

    <div class="h-error center">
        <div class="flex flex-col text-center p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 gap-4 px-8 sm:px-14 py-3 sm:py-4">
            <div class="style-error text-4xl sm:text-6xl">
                {{ __('Not Found!') }}

            </div>
            @if (isset($notRegularSidebar) && isset($student))
                <div class="flex flex-col  items-center">
                    <span class="text-base sm:text-xl">A Anamnese desse aluno não está criada, deseja criar ?</span>
                    
                    <x-button href="{{route('anamnesis.create', ['student_id' => $student->id])}}" variant="blue" class="w-full sm:w-32 mt-2">
                        <div class="dark:text-gray-100 text-center w-full">
                            Adicionar 
                        </div>
                    </x-button>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>