<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold siapae-header-title">
                {{ __('Painel Geral - SIAPAE') }}
            </h2>

            <p class="mt-1 text-sm siapae-header-subtitle">
                Acompanhe os principais dados e atendimentos da APAE Russas.
            </p>
        </div>
    </x-slot>


    <style>

        /* =========================================================
           SIAPAE — DASHBOARD
           SOMENTE O VISUAL DO PAINEL
           VERDE + CREME + DOURADO
           ========================================================= */


        /* =========================================================
           MODO CLARO
           ========================================================= */

        .siapae-dashboard {

            --bg: #F7F5EF;

            --surface: #FFFDF9;

            --surface-soft: #F1F4EF;

            --surface-hover: #EAF0EB;

            --title: #183C2C;

            --text: #42564A;

            --muted: #78857D;

            --border: #E2E8E2;

            --green: #2F6B4F;

            --green-dark: #1F513A;

            --green-light: #E3EFE7;

            --gold: #C99B4A;

            --gold-light: #F7EFDD;

            --shadow:
                0 10px 30px rgba(31, 81, 58, 0.06);

            min-height: 100%;

            color: var(--text);

            background-color: var(--bg);

            border-radius: 24px;

            transition:
                background-color 250ms ease,
                color 250ms ease;
        }


        /* =========================================================
           MODO ESCURO
           ========================================================= */

        .dark .siapae-dashboard {

            --bg: #0D1B15;

            --surface: #14271E;

            --surface-soft: #1A3025;

            --surface-hover: #20392C;

            --title: #F5F1E8;

            --text: #D1DBD3;

            --muted: #91A197;

            --border: #294236;

            --green: #76B58F;

            --green-dark: #5D9D78;

            --green-light: rgba(118, 181, 143, 0.14);

            --gold: #D8B56A;

            --gold-light: rgba(216, 181, 106, 0.13);

            --shadow:
                0 14px 35px rgba(0, 0, 0, 0.20);
        }


        /* =========================================================
           TÍTULO DO HEADER
           NÃO ALTERA O FUNDO DO HEADER
           ========================================================= */

        .siapae-header-title {
            color: #183C2C !important;
        }

        .siapae-header-subtitle {
            color: #78857D !important;
        }

        .dark .siapae-header-title {
            color: #F5F1E8 !important;
        }

        .dark .siapae-header-subtitle {
            color: #91A197 !important;
        }


        /* =========================================================
           PAINEL
           ========================================================= */

        .siapae-dashboard {

            min-height: 100%;

            color: var(--text);

            background-color: var(--bg);

            transition:
                background-color 250ms ease,
                color 250ms ease;
        }


        /* =========================================================
           PEQUENO TÍTULO SIAPAE
           ========================================================= */

        .siapae-eyebrow {

            color: var(--green);

            letter-spacing: 0.16em;

            font-size: 11px;

            font-weight: 800;

            text-transform: uppercase;
        }


        /* =========================================================
           TÍTULO PRINCIPAL
           ========================================================= */

        .siapae-main-title {

            color: var(--title);

            letter-spacing: -0.025em;
        }


        .siapae-main-subtitle {

            color: var(--muted);
        }


        /* =========================================================
           CARDS
           ========================================================= */

        .siapae-stat-card {

            position: relative;

            overflow: hidden;

            background: var(--surface);

            border: 1px solid var(--border);

            box-shadow: var(--shadow);

            transition:
                transform 180ms ease,
                box-shadow 180ms ease,
                border-color 180ms ease,
                background-color 180ms ease;
        }


        .siapae-stat-card:hover {

            transform: translateY(-2px);

            border-color: rgba(47, 107, 79, 0.30);

            box-shadow:
                0 16px 35px rgba(31, 81, 58, 0.10);
        }


        .dark .siapae-stat-card:hover {

            border-color: rgba(118, 181, 143, 0.30);

            box-shadow:
                0 18px 38px rgba(0, 0, 0, 0.28);
        }


        /* =========================================================
           DETALHE DOS CARDS
           ========================================================= */

        .siapae-stat-card::after {

            content: "";

            position: absolute;

            width: 90px;

            height: 90px;

            right: -45px;

            bottom: -45px;

            border-radius: 999px;

            background: var(--green-light);

            pointer-events: none;
        }


        /* =========================================================
           TEXTOS DOS CARDS
           ========================================================= */

        .siapae-stat-label {

            color: var(--muted);
        }


        .siapae-stat-number {

            color: var(--title);

            letter-spacing: -0.04em;
        }


        .siapae-stat-description {

            color: var(--muted);
        }


        /* =========================================================
           ÍCONES
           ========================================================= */

        .siapae-icon-green {

            background: var(--green-light);

            color: var(--green);
        }


        .siapae-icon-gold {

            background: var(--gold-light);

            color: var(--gold);
        }


        /* =========================================================
           TABELA
           ========================================================= */

        .siapae-table-card {

            background: var(--surface);

            border: 1px solid var(--border);

            box-shadow: var(--shadow);
        }


        .siapae-table-header {

            border-color: var(--border);
        }


        .siapae-table-title {

            color: var(--title);
        }


        .siapae-table-subtitle {

            color: var(--muted);
        }


        /* =========================================================
           STATUS
           ========================================================= */

        .siapae-status-dot {

            width: 7px;

            height: 7px;

            border-radius: 999px;

            background: var(--green);
        }


        .siapae-status-text {

            color: var(--muted);
        }


        /* =========================================================
           CABEÇALHO DA TABELA
           ========================================================= */

        .siapae-table-head {

            background: var(--surface-soft);

            border-color: var(--border);

            color: var(--muted);
        }


        /* =========================================================
           LINHAS DA TABELA
           ========================================================= */

        .siapae-table-row {

            border-color: var(--border);

            transition:
                background-color 160ms ease;
        }


        .siapae-table-row:hover {

            background: var(--surface-hover);
        }


        /* =========================================================
           AVATAR
           ========================================================= */

        .siapae-avatar {

            background: var(--green-light);

            color: var(--green);
        }


        /* =========================================================
           TEXTOS
           ========================================================= */

        .siapae-student-name {

            color: var(--title);
        }


        .siapae-student-description {

            color: var(--muted);
        }


        .siapae-date {

            color: var(--text);
        }


        .siapae-date-icon {

            color: var(--muted);
        }


        /* =========================================================
           LINK
           ========================================================= */

        .siapae-action {

            color: var(--green);

            transition:
                color 160ms ease,
                opacity 160ms ease;
        }


        .siapae-action:hover {

            color: var(--green-dark);

            opacity: 0.75;
        }


        .dark .siapae-action:hover {

            color: #8CC9A3;
        }


        /* =========================================================
           RODAPÉ
           ========================================================= */

        .siapae-footer {

            color: var(--muted);
        }


        /* =========================================================
           MOBILE
           ========================================================= */

        @media (max-width: 640px) {

            .siapae-footer {

                gap: 12px;

                flex-direction: column;

                align-items: flex-start;
            }
        }

    </style>


    {{-- =========================================================
         PAINEL PRINCIPAL
         ========================================================= --}}

    <div class="siapae-dashboard py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =====================================================
                 INTRODUÇÃO
                 ===================================================== --}}

            <div class="mb-8">

                <p class="siapae-eyebrow">
                    SIAPAE
                </p>

                <h1 class="siapae-main-title mt-1 text-3xl font-bold">
                    Visão geral
                </h1>

                <p class="siapae-main-subtitle mt-2 text-sm">
                    Consulte rapidamente as informações mais importantes do sistema.
                </p>

            </div>


            {{-- =====================================================
                 CARDS DE MÉTRICAS
                 ===================================================== --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">


                {{-- ESTUDANTES --}}

                <div class="siapae-stat-card rounded-2xl p-6">

                    <div class="relative z-10 flex items-center justify-between">

                        <div>

                            <p class="siapae-stat-label text-sm font-medium">
                                Estudantes
                            </p>

                            <p class="siapae-stat-number mt-2 text-3xl font-bold">
                                {{ $totalStudents }}
                            </p>

                            <p class="siapae-stat-description mt-1 text-xs">
                                estudantes cadastrados
                            </p>

                        </div>


                        <div class="siapae-icon-green w-12 h-12 flex items-center justify-center rounded-2xl">

                            <svg
                                class="w-6 h-6"
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


                {{-- ATENDIMENTOS --}}

                <div class="siapae-stat-card rounded-2xl p-6">

                    <div class="relative z-10 flex items-center justify-between">

                        <div>

                            <p class="siapae-stat-label text-sm font-medium">
                                Atendimentos
                            </p>

                            <p class="siapae-stat-number mt-2 text-3xl font-bold">
                                {{ $totalAttendances }}
                            </p>

                            <p class="siapae-stat-description mt-1 text-xs">
                                atendimentos registrados
                            </p>

                        </div>


                        <div class="siapae-icon-green w-12 h-12 flex items-center justify-center rounded-2xl">

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
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


                {{-- ANAMNESES --}}

                <div class="siapae-stat-card rounded-2xl p-6">

                    <div class="relative z-10 flex items-center justify-between">

                        <div>

                            <p class="siapae-stat-label text-sm font-medium">
                                Fichas de anamnese
                            </p>

                            <p class="siapae-stat-number mt-2 text-3xl font-bold">
                                {{ $totalAnamneses }}
                            </p>

                            <p class="siapae-stat-description mt-1 text-xs">
                                fichas cadastradas
                            </p>

                        </div>


                        <div class="siapae-icon-gold w-12 h-12 flex items-center justify-center rounded-2xl">

                            <svg
                                class="w-6 h-6"
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
                                    d="M15 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V7z"
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


            {{-- =====================================================
                 ÚLTIMOS ATENDIMENTOS
                 ===================================================== --}}

            <div class="siapae-table-card rounded-2xl overflow-hidden">


                {{-- CABEÇALHO --}}

                <div class="siapae-table-header px-6 py-5 border-b flex items-center justify-between">

                    <div>

                        <h3 class="siapae-table-title text-base font-semibold">
                            Últimos atendimentos
                        </h3>

                        <p class="siapae-table-subtitle mt-1 text-xs">
                            Atendimentos registrados recentemente.
                        </p>

                    </div>


                    <div class="hidden sm:flex items-center gap-2">

                        <span class="siapae-status-dot"></span>

                        <span class="siapae-status-text text-xs font-medium">
                            Atualizado
                        </span>

                    </div>

                </div>


                {{-- TABELA --}}

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead>

                            <tr class="siapae-table-head border-b text-xs font-semibold uppercase tracking-wider">

                                <th class="px-6 py-3.5">
                                    Estudante
                                </th>

                                <th class="px-6 py-3.5">
                                    Data do atendimento
                                </th>

                                <th class="px-6 py-3.5 text-right">
                                    Ação
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($recentAttendances as $attendance)

                                <tr class="siapae-table-row border-b">

                                    {{-- ESTUDANTE --}}

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="siapae-avatar w-9 h-9 flex items-center justify-center rounded-full text-xs font-bold">

                                                {{ strtoupper(substr($attendance->student->name ?? 'E', 0, 1)) }}

                                            </div>


                                            <div>

                                                <p class="siapae-student-name text-sm font-medium">

                                                    {{ $attendance->student->name ?? 'Estudante #' . $attendance->student_id }}

                                                </p>

                                                <p class="siapae-student-description text-xs">

                                                    Atendimento registrado

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- DATA --}}

                                    <td class="px-6 py-4">

                                        <div class="siapae-date flex items-center gap-2 text-sm">

                                            <svg
                                                class="siapae-date-icon w-4 h-4"
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
                                            class="siapae-action text-sm font-semibold"
                                        >
                                            Ver detalhes →
                                        </a>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="px-6 py-12 text-center"
                                    >

                                        <p class="siapae-student-name text-sm font-medium">
                                            Nenhum atendimento registrado
                                        </p>

                                        <p class="siapae-student-description mt-1 text-xs">
                                            Os atendimentos recentes aparecerão aqui.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =====================================================
                 RODAPÉ
                 ===================================================== --}}

            <div class="siapae-footer mt-8 flex items-center justify-between text-xs">

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