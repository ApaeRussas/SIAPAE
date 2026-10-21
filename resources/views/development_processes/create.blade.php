<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-green-800 dark:text-green-300">Atendimento · CAEE</p>
                <h1 class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">Novo Registro de Processo de Desenvolvimento Individual CAEE</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Preencha as informações do estudante e os itens observados.</p>
            </div>
            <a href="{{ route('development-processes.index') }}" class="dp-back">Voltar para lista</a>
        </div>
        <form action="{{ route('development-processes.store') }}" method="POST">
            @csrf
            @include('development_processes._form', ['submitLabel' => 'Salvar registro'])
        </form>
    </div>
    <style>.dp-back{display:inline-flex;align-items:center;justify-content:center;padding:10px 15px;border:1px solid #d7e1d8;border-radius:10px;color:#42564a;background:#fff;font-weight:600}.dark .dp-back{background:#1a3025;border-color:#294236;color:#d1dbd3}</style>
</x-app-layout>
