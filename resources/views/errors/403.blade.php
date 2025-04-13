@section('title', __('Forbidden')) 
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-x-1">
            <h2 class="text-xl font-semibold leading-tight m-bottom">
                ERROR 403
            </h2>
            <x-button button variant="question" size="sm"
                onclick="guestText('info', '<div class=&quot;text-center&quot;> O Erro 403 designa: Acesso Proibido <br> <br> Isso ocorre quando você tenta acessar uma página ou recurso sem as permissões necessárias. <br> <br> Certifique-se de que está logado com uma conta autorizada ou procure ajuda com o administrador para obter acesso. </div>')">
                <x-icons.question />
            </x-button>
        </div>
    </x-slot>

    <div class="h-error center">
        <div class="text-center p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 px-6 sm:px-14 py-3 sm:py-4">
            <div class="style-error text-3xl sm:text-6xl">
                {{ __('Forbidden!') }}
            </div>
        </div>
    </div>
</x-app-layout>