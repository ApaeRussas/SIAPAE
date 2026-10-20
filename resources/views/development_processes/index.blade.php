<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-green-800 dark:text-green-300">Atendimento · CAEE</p>
                <h1 class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">Registro de Processo de Desenvolvimento Individual CAEE</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Consulte, cadastre e acompanhe os registros individuais.</p>
            </div>
            <a href="{{ route('development-processes.create') }}" class="dp-add">+ Novo registro</a>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-900 dark:bg-green-950/40 dark:text-green-200">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('development-processes.index') }}" class="mb-5 flex flex-col gap-3 sm:flex-row">
            <input type="search" name="search" value="{{ $search }}" placeholder="Buscar pelo nome do estudante..." class="dp-search">
            <button type="submit" class="dp-search-button">Buscar</button>
            @if ($search !== '')
                <a href="{{ route('development-processes.index') }}" class="dp-clear">Limpar</a>
            @endif
        </form>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-[#294236] dark:bg-[#14271e]">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-[#294236]">
                    <thead class="bg-[#f1f4ef] dark:bg-[#1a3025]">
                        <tr>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#42564a] dark:text-[#d1dbd3]">Estudante</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#42564a] dark:text-[#d1dbd3]">Data da avaliação</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#42564a] dark:text-[#d1dbd3]">Responsável pelo registro</th>
                            <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-[#42564a] dark:text-[#d1dbd3]">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white dark:divide-[#294236] dark:bg-[#14271e]">
                        @forelse ($processes as $item)
                            <tr class="hover:bg-[#f7f9f6] dark:hover:bg-[#1a3025]">
                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-gray-900 dark:text-gray-100">{{ $item->student?->name ?? 'Estudante não encontrado' }}</td>
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $item->evaluation_date?->format('d/m/Y') ?? 'Não informada' }}</td>
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $item->user?->name ?? '—' }}</td>
                                <td class="whitespace-nowrap px-5 py-4 text-right text-sm">
                                    <div class="flex justify-end gap-3">
                                        <a class="dp-action" href="{{ route('development-processes.show', $item) }}">Visualizar</a>
                                        <a class="dp-action" href="{{ route('development-processes.edit', $item) }}">Editar</a>
                                        <form action="{{ route('development-processes.destroy', $item) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este registro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dp-delete" type="submit">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-12 text-center text-sm text-gray-500 dark:text-gray-400">Nenhum registro encontrado. Clique em “Novo registro” para começar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-100 px-5 py-4 dark:border-[#294236]">{{ $processes->links() }}</div>
        </div>
    </div>
    <style>
        .dp-add{display:inline-flex;justify-content:center;align-items:center;background:#2f6b4f;color:#fff;border-radius:10px;padding:11px 16px;font-weight:700}.dp-add:hover{background:#1f513a}
        .dp-search{flex:1;min-width:220px;border:1px solid #d7e1d8;border-radius:10px;padding:10px 13px;background:#fff;color:#24372c}.dp-search-button{border-radius:10px;padding:10px 17px;background:#2f6b4f;color:#fff;font-weight:650}.dp-clear{padding:10px;color:#42564a}.dp-action{color:#2f6b4f;font-weight:650}.dp-delete{color:#b42318;font-weight:650}
        .dark .dp-search{background:#0f2018;border-color:#294236;color:#f5f1e8}.dark .dp-action{color:#8cc9a3}.dark .dp-clear{color:#d1dbd3}
    </style>
</x-app-layout>
