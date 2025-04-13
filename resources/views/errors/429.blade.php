@section('title', __('Too Many Requests'))
<x-app-layout>
    
    <x-slot name="header">
        <div class="flex items-center gap-x-1">
            <h2 class="text-xl font-semibold leading-tight m-bottom">
                ERROR 429
            </h2>
            <x-button button variant="question" size="sm"
                onclick="guestText('info', '<div class=&quot;text-center&quot;> O Erro 429 designa: Muitas Solicitações <br> <br> Isso ocorre quando muitas requisições foram enviadas ao servidor em um curto período, causando uma sobrecarga. <br> <br> Aguarde um momento antes de tentar novamente. Caso a situação continue, entre em contato com o administrador do site para mais informações. </div>')">
                <x-icons.question />
            </x-button>
        </div>
    </x-slot>

    <div class="h-error center">
        <div class="text-center p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 px-8 sm:px-14 py-3 sm:py-4">
            <div class="style-error text-3xl sm:text-6xl">
                {{ __('Too Many Requests!') }}
            </div>
        </div>
    </div>

</x-app-layout>
