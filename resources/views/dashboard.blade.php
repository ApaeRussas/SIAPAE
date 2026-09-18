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
        /* TEMA CLARO - CLEAN & MODERNO              */
        /* ========================================= */
        .siapae-dashboard {
            --bg: #F9FAFB;
            --card: #FFFFFF;
            --card-hover: #F3F4F6;

            --title: #111827;
            --text: #374151;
            --muted: #6B7280;
            --border: #E5E7EB;

            /* Identidade APAE (Usada pontualmente em destaques/ícones) */
            --brand-primary: #2F6B4F;
            --brand-primary-bg: #E7F0E9;
            --brand-accent: #D5A85A;
            --brand-accent-bg: #FAF3E6;
        }

        /* ========================================= */
        /* TEMA ESCURO - SLATE EGANTE                */
        /* ========================================= */
        .dark .siapae-dashboard {
            --bg: #0F172A;
            --card: #1E293B;
            --card-hover: #334155;

            --title: #F8FAFC;
            --text: #CBD5E1;
            --muted: #94A3B8;
            --border: #334155;

            --brand-primary: #88C49A;
            --brand-primary-bg: rgba(47, 107, 79, 0.25);
            --brand-accent: #D5A85A;
            --brand-accent-bg: rgba(213, 168, 90, 0.2);
        }
    </style>

    <div
        class="siapae-dashboard min-h-screen py-8 transition-colors duration-200"
        style="background-color: var(--bg);"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- INTRODUÇÃO --}}
            <div class="mb-8">
                <p class="text-xs font-bold tracking-wider uppercase" style="color: var(--brand-primary);">
                    SIAPAE
                </p>
                <h1 class="mt-1 text-2xl font-bold" style="color: var(--title);">
                    Visão geral
                </h1>
                <p class="mt-1 text-sm" style="color: var(--muted);">
                    Consulte rapidamente as informações mais importantes do sistema.
                </p>
            </div>

            {{-- CARDS DE MÉTRICAS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                {{-- ESTUDANTES --}}
                <div
                    class="rounded-2xl p-6 border transition-all duration-200 hover:shadow-md"
                    style="background-color: var(--card); border-color: var(--border);"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--muted);">
                                Estudantes
                            </p>
                            <p class="mt-2 text-3xl font-bold" style="color: var(--title);">
                                {{ $totalStudents }}
                            </p>
                            <p class="mt-1 text-xs" style="color: var(--muted);">
                                estudantes cadastrados
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-xl"
                            style="background-color: var(--brand-primary-bg); color: var(--brand-primary);"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 21a8 8 0 0116 0" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- ATENDIMENTOS --}}
                <div
                    class="rounded-2xl p-6 border transition-all duration-200 hover:shadow-md"
                    style="background-color: var(--card); border-color: var(--border);"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--muted);">
                                Atendimentos
                            </p>
                            <p class="mt-2 text-3xl font-bold" style="color: var(--title);">
                                {{ $totalAttendances }}
                            </p>
                            <p class="mt-1 text-xs" style="color: var(--muted);">
                                atendimentos registrados
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-xl"
                            style="background-color: var(--brand-primary-bg); color: var(--brand-primary);"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5a3 3 0 006 0" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 13h6M9 17h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- ANAMNESES --}}
                <div
                    class="rounded-2xl p-6 border transition-all duration-200 hover:shadow-md"
                    style="background-color: var(--card); border-color: var(--border);"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--muted);">
                                Fichas de anamnese
                            </p>
                            <p class="mt-2 text-3xl font-bold" style="color: var(--title);">
                                {{ $totalAnamneses }}
                            </p>
                            <p class="mt-1 text-xs" style="color: var(--muted);">
                                fichas cadastradas
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-xl"
                            style="background-color: var(--brand-accent-bg); color: var(--brand-accent);"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6M9 16h6M9 8h2" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 3v4h4" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- TABELA DE ATENDIMENTOS --}}
            <div
                class="rounded-2xl border overflow-hidden transition-colors duration-200"
                style="background-color: var(--card); border-color: var(--border);"
            >
                <div class="px-6 py-5 border-b flex items-center justify-between" style="border-color: var(--border);">
                    <div>
                        <h3 class="text-base font-semibold" style="color: var(--title);">
                            Últimos atendimentos
                        </h3>
                        <p class="mt-0.5 text-xs" style="color: var(--muted);">
                            Atendimentos registrados recentemente.
                        </p>
                    </div>
                    <div class="hidden sm:flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" style="background-color: var(--brand-primary);"></span>
                        <span class="text-xs font-medium" style="color: var(--muted);">Atualizado</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b text-xs font-semibold uppercase tracking-wider" style="background-color: var(--card-hover); border-color: var(--border); color: var(--muted);">
                                <th class="px-6 py-3.5">Estudante</th>
                                <th class="px-6 py-3.5">Data do atendimento</th>
                                <th class="px-6 py-3.5 text-right">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: var(--border);">
                            @forelse($recentAttendances as $attendance)
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 flex items-center justify-center rounded-full text-xs font-bold"
                                                style="background-color: var(--brand-primary-bg); color: var(--brand-primary);"
                                            >
                                                {{ strtoupper(substr($attendance->student->name ?? 'E', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium" style="color: var(--title);">
                                                    {{ $attendance->student->name ?? 'Estudante #' . $attendance->student_id }}
                                                </p>
                                                <p class="text-xs" style="color: var(--muted);">
                                                    Atendimento registrado
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm" style="color: var(--text);">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" style="color: var(--muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3M4 11h16" />
                                                <rect x="4" y="5" width="16" height="16" rx="2" stroke="currentColor" stroke-width="1.8" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a
                                            href="{{ route('attendance.show', $attendance->id) }}"
                                            class="text-sm font-semibold transition-opacity hover:opacity-80"
                                            style="color: var(--brand-primary);"
                                        >
                                            Ver detalhes →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <p class="text-sm font-medium" style="color: var(--title);">Nenhum atendimento registrado</p>
                                        <p class="mt-1 text-xs" style="color: var(--muted);">Os atendimentos recentes aparecerão aqui.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- RODAPÉ --}}
            <div class="mt-8 flex items-center justify-between text-xs" style="color: var(--muted);">
                <span>SIAPAE • APAE Russas</span>
                <span>Inclusão que transforma vidas.</span>
            </div>

        </div>
    </div>

</x-app-layout>