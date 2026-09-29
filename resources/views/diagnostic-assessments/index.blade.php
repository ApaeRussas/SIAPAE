
<x-app-layout :context="$context">

    {{-- =========================================================
         CABEÇALHO
         ========================================================= --}}

    <x-slot name="header">

        <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div>

                <p class="text-sm font-semibold tracking-wide text-[#3B7D5A] mb-1">
                    SIAPAE
                </p>

                <h2 class="text-2xl md:text-3xl font-bold leading-tight text-[#102A43]">
                    Sondagem Diagnóstica
                </h2>

            </div>


            {{-- BOTÃO ADICIONAR --}}

            <x-button
                href="{{ route('diagnostic-assessments.create') }}"
                class="!bg-[#3B7D5A] hover:!bg-[#2F684A] !text-white !border-0 shadow-sm"
            >

                <span class="px-1">
                    Adicionar Sondagem
                </span>

            </x-button>

        </div>

    </x-slot>


    {{-- =========================================================
         CONTEÚDO
         ========================================================= --}}

    <div class="py-6 bg-[#F4F6F8] min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- CARD PRINCIPAL --}}

            <div class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">


                {{-- CABEÇALHO DO CARD --}}

                <div class="px-6 md:px-8 pt-7 pb-5">

                    <h1 class="text-xl md:text-2xl font-bold text-[#102A43]">
                        Sondagens registradas
                    </h1>

                    <p class="mt-1 text-sm md:text-base text-[#66788A]">
                        Consulte as sondagens diagnósticas realizadas para os alunos.
                    </p>

                </div>


                {{-- =================================================
                     TABELA
                     ================================================= --}}

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-t border-b border-[#E1E7EC] bg-[#F8FAFB]">

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#66788A]">
                                    Data
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#66788A]">
                                    Aluno
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#66788A]">
                                    Série
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#66788A]">
                                    Escola
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-[#66788A]">
                                    Ações
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#E1E7EC]">

                            @forelse ($assessments as $assessment)

                                <tr class="hover:bg-[#F8FAFB] transition">


                                    {{-- DATA --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span class="text-sm font-medium text-[#334E68]">
                                            {{ optional($assessment->date)->format('d/m/Y') }}
                                        </span>

                                    </td>


                                    {{-- ALUNO --}}

                                    <td class="px-6 py-4">

                                        <div class="flex flex-col">

                                            <span class="text-sm font-semibold text-[#102A43]">
                                                {{ $assessment->student->name ?? 'Aluno não encontrado' }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- SÉRIE --}}

                                    <td class="px-6 py-4">

                                        <span class="text-sm text-[#66788A]">
                                            {{ $assessment->series ?: '—' }}
                                        </span>

                                    </td>


                                    {{-- ESCOLA --}}

                                    <td class="px-6 py-4">

                                        <span class="text-sm text-[#66788A]">
                                            {{ $assessment->school ?: '—' }}
                                        </span>

                                    </td>


                                    {{-- AÇÕES --}}

                                    <td class="px-6 py-4">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- VISUALIZAR --}}

                                            <a
                                                href="{{ route('diagnostic-assessments.show', $assessment->id) }}"
                                                class="inline-flex items-center justify-center rounded-lg border border-[#D7DEE5] bg-white px-3 py-2 text-sm font-semibold text-[#334E68] hover:bg-[#EDF5F0] hover:border-[#3B7D5A] hover:text-[#2F684A] transition"
                                            >
                                                Visualizar
                                            </a>


                                            {{-- EDITAR --}}

                                            <a
                                                href="{{ route('diagnostic-assessments.edit', $assessment->id) }}"
                                                class="inline-flex items-center justify-center rounded-lg bg-[#3B7D5A] px-3 py-2 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                                            >
                                                Editar
                                            </a>


                                            {{-- EXCLUIR --}}

                                            <form
                                                method="POST"
                                                action="{{ route('diagnostic-assessments.destroy', $assessment->id) }}"
                                                onsubmit="return confirm('Tem certeza que deseja excluir esta sondagem diagnóstica?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50 transition"
                                                >
                                                    Excluir
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="px-6 py-16 text-center"
                                    >

                                        <div class="flex flex-col items-center justify-center">

                                            <div class="w-14 h-14 rounded-full bg-[#EDF5F0] flex items-center justify-center mb-4">

                                                <svg
                                                    class="w-7 h-7 text-[#3B7D5A]"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                                    />
                                                </svg>

                                            </div>

                                            <h3 class="text-base font-semibold text-[#102A43]">
                                                Nenhuma sondagem cadastrada
                                            </h3>

                                            <p class="mt-1 text-sm text-[#66788A]">
                                                Ainda não existem sondagens diagnósticas registradas.
                                            </p>

                                            <a
                                                href="{{ route('diagnostic-assessments.create') }}"
                                                class="mt-5 inline-flex items-center rounded-lg bg-[#3B7D5A] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                                            >
                                                Adicionar primeira sondagem
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     PAGINAÇÃO
                     ================================================= --}}

                @if ($assessments->hasPages())

                    <div class="px-6 md:px-8 py-5 border-t border-[#E1E7EC]">

                        {{ $assessments->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
