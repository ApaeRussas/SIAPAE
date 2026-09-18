<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">
                {{ __('Painel Geral - SIAPAE') }}
            </h2>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Acompanhe os principais dados e atendimentos da APAE Russas.
            </p>
        </div>

    </x-slot>


    <style>

        /* ========================================= */
        /* TEMA CLARO                                */
        /* ========================================= */

        .siapae-dashboard {

            --bg: #f6f8fa;
            --card: #ffffff;
            --card-hover: #f8fafc;

            --title: #1e293b;
            --text: #64748b;
            --muted: #94a3b8;

            --border: #e2e8f0;

            --blue-bg: #eff6ff;
            --blue: #3b82f6;

            --green-bg: #ecfdf5;
            --green: #10b981;

            --yellow-bg: #fffbeb;
            --yellow: #d99a00;
        }


        /* ========================================= */
        /* TEMA ESCURO                               */
        /* ========================================= */

        .dark .siapae-dashboard {

            --bg: #111827;
            --card: #1f2937;
            --card-hover: #263244;

            --title: #f8fafc;
            --text: #cbd5e1;
            --muted: #94a3b8;

            --border: #374151;

            --blue-bg: #1e3a5f;
            --blue: #60a5fa;

            --green-bg: #123b31;
            --green: #34d399;

            --yellow-bg: #423817;
            --yellow: #fbbf24;
        }

    </style>


    <div
        class="siapae-dashboard min-h-screen py-8 transition-colors duration-200"
        style="background-color: var(--bg);"
    >

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ========================================= --}}
            {{-- INTRODUÇÃO                                 --}}
            {{-- ========================================= --}}

            <div class="mb-8">

                <p
                    class="text-sm font-medium"
                    style="color: var(--blue);"
                >
                    SIAPAE
                </p>


                <h1
                    class="mt-1 text-2xl font-semibold"
                    style="color: var(--title);"
                >
                    Visão geral
                </h1>


                <p
                    class="mt-2 text-sm"
                    style="color: var(--text);"
                >
                    Consulte rapidamente as informações mais importantes do sistema.
                </p>

            </div>



            {{-- ========================================= --}}
            {{-- CARDS                                      --}}
            {{-- ========================================= --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">


                {{-- ========================================= --}}
                {{-- ESTUDANTES                                 --}}
                {{-- ========================================= --}}

                <div
                    class="rounded-xl p-6 border transition-colors duration-200"
                    style="
                        background-color: var(--card);
                        border-color: var(--border);
                        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                    "
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="text-sm font-medium"
                                style="color: var(--text);"
                            >
                                Estudantes
                            </p>


                            <p
                                class="mt-2 text-3xl font-semibold"
                                style="color: var(--title);"
                            >
                                {{ $totalStudents }}
                            </p>


                            <p
                                class="mt-1 text-xs"
                                style="color: var(--muted);"
                            >
                                estudantes cadastrados
                            </p>

                        </div>


                        <div
                            class="w-11 h-11 flex items-center justify-center rounded-lg"
                            style="
                                background-color: var(--blue-bg);
                                color: var(--blue);
                            "
                        >

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 21a8 8 0 0116 0"
                                />

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- ========================================= --}}
                {{-- ATENDIMENTOS                               --}}
                {{-- ========================================= --}}

                <div
                    class="rounded-xl p-6 border transition-colors duration-200"
                    style="
                        background-color: var(--card);
                        border-color: var(--border);
                        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                    "
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="text-sm font-medium"
                                style="color: var(--text);"
                            >
                                Atendimentos
                            </p>


                            <p
                                class="mt-2 text-3xl font-semibold"
                                style="color: var(--title);"
                            >
                                {{ $totalAttendances }}
                            </p>


                            <p
                                class="mt-1 text-xs"
                                style="color: var(--muted);"
                            >
                                atendimentos registrados
                            </p>

                        </div>


                        <div
                            class="w-11 h-11 flex items-center justify-center rounded-lg"
                            style="
                                background-color: var(--green-bg);
                                color: var(--green);
                            "
                        >

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12
                                       a2 2 0 002 2h10
                                       a2 2 0 002-2V7
                                       a2 2 0 00-2-2h-2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5a3 3 0 006 0"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 13h6M9 17h4"
                                />

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- ========================================= --}}
                {{-- FICHAS / HISTÓRICO                          --}}
                {{-- ========================================= --}}

                <div
                    class="rounded-xl p-6 border transition-colors duration-200"
                    style="
                        background-color: var(--card);
                        border-color: var(--border);
                        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                    "
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="text-sm font-medium"
                                style="color: var(--text);"
                            >
                                Fichas de anamnese
                            </p>


                            <p
                                class="mt-2 text-3xl font-semibold"
                                style="color: var(--title);"
                            >
                                {{ $totalAnamneses }}
                            </p>


                            <p
                                class="mt-1 text-xs"
                                style="color: var(--muted);"
                            >
                                fichas cadastradas
                            </p>

                        </div>


                        <div
                            class="w-11 h-11 flex items-center justify-center rounded-lg"
                            style="
                                background-color: var(--yellow-bg);
                                color: var(--yellow);
                            "
                        >

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 12h6M9 16h6M9 8h2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M15 3H7a2 2 0 00-2 2v14
                                       a2 2 0 002 2h10
                                       a2 2 0 002-2V7z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M15 3v4h4"
                                />

                            </svg>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ========================================= --}}
            {{-- ÚLTIMOS ATENDIMENTOS                       --}}
            {{-- ========================================= --}}

            <div
                class="rounded-xl border overflow-hidden transition-colors duration-200"
                style="
                    background-color: var(--card);
                    border-color: var(--border);
                    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                "
            >


                {{-- CABEÇALHO --}}

                <div
                    class="px-6 py-5 border-b"
                    style="border-color: var(--border);"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <h3
                                class="text-base font-semibold"
                                style="color: var(--title);"
                            >
                                Últimos atendimentos
                            </h3>


                            <p
                                class="mt-1 text-sm"
                                style="color: var(--text);"
                            >
                                Atendimentos registrados recentemente.
                            </p>

                        </div>


                        <div class="hidden sm:flex items-center gap-2">

                            <span
                                class="w-2 h-2 rounded-full"
                                style="background-color: var(--green);"
                            ></span>


                            <span
                                class="text-xs"
                                style="color: var(--text);"
                            >
                                Atualizado
                            </span>

                        </div>

                    </div>

                </div>



                {{-- TABELA --}}

                <div class="overflow-x-auto">

                    <table class="w-full">


                        <thead>

                            <tr
                                class="border-b"
                                style="
                                    background-color: var(--card-hover);
                                    border-color: var(--border);
                                "
                            >

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider"
                                    style="color: var(--muted);"
                                >
                                    Estudante
                                </th>


                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider"
                                    style="color: var(--muted);"
                                >
                                    Data do atendimento
                                </th>


                                <th
                                    class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider"
                                    style="color: var(--muted);"
                                >
                                    Ação
                                </th>

                            </tr>

                        </thead>



                        <tbody>

                            @forelse($recentAttendances as $attendance)

                                <tr
                                    class="border-b transition-colors duration-150"
                                    style="border-color: var(--border);"
                                >


                                    {{-- ESTUDANTE --}}

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">


                                            <div
                                                class="w-9 h-9 flex items-center justify-center rounded-full"
                                                style="
                                                    background-color: var(--blue-bg);
                                                    color: var(--blue);
                                                "
                                            >

                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M16 7a4 4 0 11-8 0
                                                           4 4 0 018 0z"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M4 21a8 8 0 0116 0"
                                                    />

                                                </svg>

                                            </div>


                                            <div>

                                                <p
                                                    class="text-sm font-medium"
                                                    style="color: var(--title);"
                                                >
                                                    {{ $attendance->student->name ?? 'Estudante #' . $attendance->student_id }}
                                                </p>


                                                <p
                                                    class="text-xs"
                                                    style="color: var(--muted);"
                                                >
                                                    Atendimento registrado
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- DATA DO ATENDIMENTO --}}

                                    <td class="px-6 py-4">

                                        <div
                                            class="flex items-center gap-2 text-sm"
                                            style="color: var(--text);"
                                        >

                                            <svg
                                                class="w-4 h-4"
                                                style="color: var(--muted);"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M8 7V3m8 4V3M4 11h16"
                                                />

                                                <rect
                                                    x="4"
                                                    y="5"
                                                    width="16"
                                                    height="16"
                                                    rx="2"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                />

                                            </svg>


                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}

                                        </div>

                                    </td>



                                    {{-- AÇÃO --}}

                                    <td class="px-6 py-4 text-right">

                                        <a
                                            href="{{ route('attendance.show', $attendance->id) }}"
                                            class="text-sm font-medium"
                                            style="color: var(--blue);"
                                        >
                                            Ver detalhes →
                                        </a>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="px-6 py-16 text-center"
                                    >

                                        <div class="flex flex-col items-center">


                                            <div
                                                class="w-12 h-12 flex items-center justify-center rounded-full mb-4"
                                                style="
                                                    background-color: var(--card-hover);
                                                    color: var(--muted);
                                                "
                                            >

                                                <svg
                                                    class="w-6 h-6"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.6"
                                                        d="M9 5H7a2 2 0 00-2 2v12
                                                           a2 2 0 002 2h10
                                                           a2 2 0 002-2V7
                                                           a2 2 0 00-2-2h-2"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.6"
                                                        d="M9 5a3 3 0 006 0"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.6"
                                                        d="M9 13h6M9 17h4"
                                                    />

                                                </svg>

                                            </div>


                                            <p
                                                class="text-sm font-medium"
                                                style="color: var(--title);"
                                            >
                                                Nenhum atendimento registrado
                                            </p>


                                            <p
                                                class="mt-1 text-xs"
                                                style="color: var(--muted);"
                                            >
                                                Os atendimentos recentes aparecerão aqui.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>



            {{-- ========================================= --}}
            {{-- RODAPÉ                                    --}}
            {{-- ========================================= --}}

            <div
                class="mt-6 flex items-center justify-between text-xs"
                style="color: var(--muted);"
            >

                <span>
                    SIAPAE • APAE Russas
                </span>

                <span>
                    Inclusão que transforma vidas.
                </span>

            </div>

        </div>

    </div>

</x-app-layout>