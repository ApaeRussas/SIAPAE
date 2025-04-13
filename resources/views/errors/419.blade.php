@section('title', __('Page Expired'))
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-x-1">
            <h2 class="text-xl font-semibold leading-tight m-bottom">
                ERROR 419
            </h2>
            <x-button button variant="question" size="sm"
                onclick="guestText('info', '<div class=&quot;text-center&quot;> O Erro 419 designa: Sessão Expirada <br> <br> Isso ocorre quando o tempo de atividade da sua sessão no site expirou, geralmente por questões de segurança. <br> <br> Tente atualizar a página ou faça login novamente para continuar sua navegação. Caso o problema persista, contate o suporte do site.  </div>')">
                <x-icons.question />
            </x-button>
        </div>
    </x-slot>

    <div class="h-error center">
        <div class="text-center p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 px-8 sm:px-14 py-3 sm:py-4">
            <div class="style-error text-3xl sm:text-6xl">
                {{ __('Page Expired!') }}
            </div>
        </div>
    </div>

</x-app-layout>