<x-guest-layout>

    {{-- Página de Erro 403 especifíco ao Middleware de Restrição de IP --}}

    <main class="flex flex-col items-center justify-center flex-1 px-4 pt-6 sm:justify-center">
        <div class="text-center bg-white p-8 rounded-lg shadow-xl max-w-lg w-full sm:max-w-md dark:bg-dark-eval-1">
            <h1 class="text-6xl font-extrabold text-red-600 dark:text-red-500">403</h1>
            <p class="mt-4 text-xl font-semibold text-gray-800 dark:text-gray-300">Acesso Proibido !</p>
            <p class="mt-4 text-gray-600 dark:text-gray-400">Você não possui acesso ao sistema interno da APAE Russas, se diriga ao site principal:</p>
            <x-button href="#" class="mt-4" variant="primary">
                <p class="text-gray-100 dark:text-gray-300">
                    Site Principal
                </p>
            </x-button>
        </div>
    </main>

</x-guest-layout>