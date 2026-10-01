<x-app-layout :context="$context">

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

    <div class="diagnostic-page min-h-screen py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="diagnostic-card overflow-hidden">

                <div class="px-6 md:px-8 pt-7 pb-5">

                    <h1 class="text-xl md:text-2xl font-bold text-[#102A43]">
                        Sondagens registradas
                    </h1>

                    <p class="mt-1 text-sm md:text-base text-[#66788A]">
                        Consulte as sondagens diagnósticas realizadas para os alunos.
                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    Data
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    Aluno
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    Série
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    Escola
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">
                                    Ações
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($assessments as $assessment)

                                <tr>

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span class="text-sm font-medium text-[#334E68]">
                                            {{ optional($assessment->date)->format('d/m/Y') }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-4">

                                        <span class="text-sm font-semibold text-[#102A43]">
                                            {{ $assessment->student->name ?? 'Aluno não encontrado' }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-4">

                                        <span class="text-sm text-[#66788A]">
                                            {{ $assessment->series ?: '—' }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-4">

                                        <span class="text-sm text-[#66788A]">
                                            {{ $assessment->school ?: '—' }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex items-center justify-end gap-2">

                                            <a
                                                href="{{ route('diagnostic-assessments.show', $assessment->id) }}"
                                                class="inline-flex items-center justify-center rounded-lg border border-[#D7DEE5] bg-white px-3 py-2 text-sm font-semibold text-[#334E68] hover:bg-[#EDF5F0] hover:border-[#3B7D5A] hover:text-[#2F684A] transition"
                                            >
                                                Visualizar
                                            </a>

                                            <a
                                                href="{{ route('diagnostic-assessments.edit', $assessment->id) }}"
                                                class="inline-flex items-center justify-center rounded-lg bg-[#3B7D5A] px-3 py-2 text-sm font-semibold text-white hover:bg-[#2F684A] transition"
                                            >
                                                Editar
                                            </a>

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

                @if ($assessments->hasPages())

                    <div class="px-6 md:px-8 py-5 border-t border-[#E1E7EC]">

                        {{ $assessments->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

    <style>

        .diagnostic-page {
            background-color: #EAF3ED !important;
        }

        .diagnostic-card {
            background-color: #FFFFFF !important;
            border: 1px solid #DCE7E1 !important;
            border-radius: 16px !important;
            box-shadow: 0 2px 8px rgba(39, 67, 54, 0.04) !important;
        }

        .diagnostic-card table {
            width: 100% !important;
            background-color: #FFFFFF !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        .diagnostic-card thead {
            background-color: #EAF3ED !important;
        }

        .diagnostic-card thead tr {
            background-color: #EAF3ED !important;
            border-top: 1px solid #DCE7E1 !important;
            border-bottom: 1px solid #DCE7E1 !important;
        }

        .diagnostic-card thead th {
            background-color: #EAF3ED !important;
            color: #286048 !important;
            border-color: #DCE7E1 !important;
        }

        .diagnostic-card tbody {
            background-color: #FFFFFF !important;
        }

        .diagnostic-card tbody tr {
            background-color: #FFFFFF !important;
            transition: background-color 0.18s ease !important;
        }

        .diagnostic-card tbody tr:hover {
            background-color: #F1F7F3 !important;
        }

        .diagnostic-card tbody td {
            background-color: transparent !important;
            border-color: #E2ECE6 !important;
        }

        .diagnostic-card tbody tr:hover td {
            background-color: #F1F7F3 !important;
        }

        .diagnostic-card a,
        .diagnostic-card button {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }

        @media (max-width: 768px) {

            .diagnostic-page {
                padding-top: 1rem;
            }

            .diagnostic-card {
                border-radius: 12px !important;
            }

            .diagnostic-card table {
                min-width: 850px;
            }
        }

    </style>

</x-app-layout>