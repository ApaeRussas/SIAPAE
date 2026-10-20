<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-7">
            <p class="text-sm font-semibold uppercase tracking-wide text-green-800 dark:text-green-300">Atendimento · CAEE</p>
            <h1 class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">Editar Registro de Processo de Desenvolvimento Individual CAEE</h1>
        </div>
        <form action="{{ route('development-processes.update', $process) }}" method="POST">
            @csrf
            @method('PUT')
            @include('development_processes._form', ['submitLabel' => 'Salvar alterações'])
        </form>
    </div>
</x-app-layout>
