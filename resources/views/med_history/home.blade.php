<x-app-layout :context="$context">
 
    {{-- =========================================================
         CABEÇALHO DA PÁGINA
         ========================================================= --}}
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
 
            <div>
                <h2 class="text-2xl font-semibold siapae-header-title">
                    {{ __('Lista de Anamneses') }}
                </h2>
 
                <p class="mt-1 text-sm siapae-header-subtitle">
                    Consulte e gerencie as fichas de anamnese dos alunos.
                </p>
            </div>
 
            <a href="{{ route('anamnesis.deposit') }}" class="sa-header-btn">
                <x-icons.archive class="w-5 h-5" aria-hidden="true" />
                <span>{{ __('Armazém') }}</span>
            </a>
 
        </div>
    </x-slot>
 
 
    <style>
 
        /* =========================================================
           SIAPAE — LISTA DE ANAMNESES
           VERDE + CREME + DOURADO (mesma paleta do painel)
           ========================================================= */
 
        /* ---------- MODO CLARO ---------- */
 
        :root {
            --sa-surface: #F7F5EF;
            --sa-soft: #F1F4EF;
            --sa-hover: #EAF0EB;
 
            --sa-title: #000000;
            --sa-text: #42564A;
            --sa-muted: #78857D;
 
            --sa-border: #E2E8E2;
 
            --sa-green: #2F6B4F;
            --sa-green-dark: #1F513A;
            --sa-green-light: #E3EFE7;
 
            --sa-field: #FFFFFF;
            --sa-ring: rgba(47, 107, 79, 0.18);
 
            --sa-btn: #2F6B4F;
            --sa-btn-hover: #1F513A;
 
            --sa-shadow: 0 10px 30px rgba(31, 81, 58, 0.06);
        }
 
        /* ---------- MODO ESCURO ---------- */
 
        .dark {
            --sa-surface: #14271E;
            --sa-soft: #1A3025;
            --sa-hover: #20392C;
 
            --sa-title: #F5F1E8;
            --sa-text: #D1DBD3;
            --sa-muted: #91A197;
 
            --sa-border: #294236;
 
            --sa-green: #76B58F;
            --sa-green-dark: #8CC9A3;
            --sa-green-light: rgba(118, 181, 143, 0.14);
 
            --sa-field: #0F2018;
            --sa-ring: rgba(118, 181, 143, 0.25);
 
            --sa-btn: #3A8060;
            --sa-btn-hover: #4A9A75;
 
            --sa-shadow: 0 14px 35px rgba(0, 0, 0, 0.20);
        }
 
 
        /* ---------- TÍTULO DO HEADER ---------- */
 
        .siapae-header-title {
            color: var(--sa-title) !important;
        }
 
        .siapae-header-subtitle {
            color: var(--sa-muted) !important;
        }
 
 
        /* ---------- BOTÃO DO HEADER (Armazém) ---------- */
 
        .sa-header-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            height: 40px;
            padding: 0 16px;
            border-radius: 12px;
            border: 1px solid var(--sa-border);
            background-color: var(--sa-surface);
            color: var(--sa-title);
            font-size: 0.875rem;
            font-weight: 600;
            transition: background-color 160ms ease, border-color 160ms ease;
        }
 
        .sa-header-btn:hover {
            background-color: var(--sa-hover);
        }
 
 
        /* =========================================================
           CAIXA ÚNICA
           ========================================================= */
 
        .sa-card {
            overflow: hidden;
            border-radius: 24px;
            border: 1px solid var(--sa-border);
            background-color: var(--sa-surface);
            box-shadow: var(--sa-shadow);
        }
 
 
        /* =========================================================
           BARRA DE BUSCA + AÇÃO
           ========================================================= */
 
        .sa-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            padding: 20px 24px;
        }
 
        .sa-search {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1 1 320px;
            min-width: 0;
            height: 46px;
            padding: 0 6px 0 14px;
            border-radius: 14px;
            border: 1px solid var(--sa-border);
            background-color: var(--sa-field);
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }
 
        .sa-search:focus-within {
            border-color: var(--sa-green);
            box-shadow: 0 0 0 3px var(--sa-ring);
        }
 
        .sa-search__icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            color: var(--sa-muted);
        }
 
        .sa-search .sa-search__input,
        .sa-search .sa-search__input:focus {
            flex: 1;
            min-width: 0;
            height: 100%;
            padding: 0;
            border: 0;
            outline: none;
            box-shadow: none;
            background: transparent;
            color: var(--sa-title);
            font-size: 0.9375rem;
        }
 
        .sa-search .sa-search__input::placeholder {
            color: var(--sa-muted);
            opacity: 1;
        }
 
        .sa-search__clear {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            border-radius: 999px;
            color: var(--sa-muted);
            font-size: 1.25rem;
            line-height: 1;
            transition: background-color 160ms ease;
        }
 
        .sa-search__clear:hover {
            background-color: var(--sa-hover);
        }
 
 
        /* ---------- BOTÕES ---------- */
 
        .sa-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-shrink: 0;
            border: 0;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
            transition: background-color 160ms ease, box-shadow 160ms ease;
        }
 
        .sa-btn:focus-visible,
        .sa-header-btn:focus-visible,
        .sa-link:focus-visible,
        .sa-student:focus-visible {
            outline: 2px solid var(--sa-green);
            outline-offset: 2px;
        }
 
        .sa-btn--soft {
            height: 34px;
            padding: 0 14px;
            border-radius: 10px;
            background-color: var(--sa-green-light);
            color: var(--sa-green);
        }
 
        .sa-btn--soft:hover {
            background-color: var(--sa-hover);
        }
 
        .sa-btn--primary {
            height: 46px;
            padding: 0 20px;
            border-radius: 14px;
            background-color: var(--sa-btn);
            color: #FFFFFF;
        }
 
        .sa-btn--primary:hover {
            background-color: var(--sa-btn-hover);
            box-shadow: 0 8px 20px rgba(31, 81, 58, 0.18);
        }
 
        .sa-btn svg {
            width: 18px;
            height: 18px;
        }
 
 
        /* =========================================================
           TABELA
           ========================================================= */
 
        .sa-scroll {
            overflow-x: auto;
            border-top: 1px solid var(--sa-border);
        }
 
        .sa-table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
            text-align: left;
        }
 
        .sa-table thead tr {
            background-color: var(--sa-soft);
            border-bottom: 1px solid var(--sa-border);
        }
 
        .sa-table th {
            padding: 14px 24px;
            color: var(--sa-muted);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
 
        .sa-table tbody tr {
            border-bottom: 1px solid var(--sa-border);
            transition: background-color 160ms ease;
        }
 
        .sa-table tbody tr:last-child {
            border-bottom: 0;
        }
 
        .sa-table tbody tr:hover {
            background-color: var(--sa-hover);
        }
 
        .sa-table td {
            padding: 16px 24px;
            color: var(--sa-text);
            font-size: 0.875rem;
        }
 
        .sa-right {
            text-align: right;
        }
 
 
        /* ---------- ESTUDANTE ---------- */
 
        .sa-student {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
        }
 
        .sa-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            border-radius: 999px;
            background-color: var(--sa-green-light);
            color: var(--sa-green);
            font-size: 0.75rem;
            font-weight: 700;
        }
 
        .sa-student__name {
            color: var(--sa-title);
            font-weight: 600;
            transition: color 160ms ease;
        }
 
        .sa-student:hover .sa-student__name {
            color: var(--sa-green);
        }
 
 
        /* ---------- DATA ---------- */
 
        .sa-date {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
 
        .sa-date svg {
            width: 16px;
            height: 16px;
            color: var(--sa-muted);
        }
 
 
        /* ---------- LINK DE AÇÃO ---------- */
 
        .sa-link {
            border-radius: 8px;
            color: var(--sa-green);
            font-weight: 600;
            transition: color 160ms ease, opacity 160ms ease;
        }
 
        .sa-link:hover {
            color: var(--sa-green-dark);
            opacity: 0.8;
        }
 
 
        /* =========================================================
           SEM RESULTADOS
           ========================================================= */
 
        .sa-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 56px 24px;
            text-align: center;
        }
 
        .sa-empty__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            margin-bottom: 16px;
            border-radius: 18px;
            background-color: var(--sa-green-light);
            color: var(--sa-green);
        }
 
        .sa-empty__icon svg {
            width: 28px;
            height: 28px;
        }
 
        .sa-empty__title {
            color: var(--sa-title);
            font-size: 0.9375rem;
            font-weight: 600;
        }
 
        .sa-empty__text {
            margin-top: 4px;
            color: var(--sa-muted);
            font-size: 0.8125rem;
        }
 
 
        /* ---------- PAGINAÇÃO ---------- */
 
        .sa-pagination {
            padding: 16px 24px;
            border-top: 1px solid var(--sa-border);
        }
 
 
        /* ---------- MOBILE ---------- */
 
        @media (max-width: 640px) {
            .sa-toolbar {
                padding: 16px;
            }
 
            .sa-btn--primary {
                width: 100%;
            }
 
            .sa-table th,
            .sa-table td {
                padding-left: 16px;
                padding-right: 16px;
            }
        }
 
        @media (prefers-reduced-motion: reduce) {
            .sa-btn,
            .sa-header-btn,
            .sa-search,
            .sa-table tbody tr,
            .sa-student__name,
            .sa-link {
                transition: none;
            }
        }
 
    </style>
 
 
    {{-- =========================================================
         CONTEÚDO
         ========================================================= --}}
 
    <div class="py-6">
 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
 
            <section class="sa-card">
 
                {{-- BUSCA + ADICIONAR --}}
                <div class="sa-toolbar">
 
                    <form
                        method="GET"
                        action="{{ route('anamnesis.index') }}"
                        class="sa-search"
                        role="search"
                    >
 
                        <svg
                            class="sa-search__icon"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.35-5.15a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z"
                            />
                        </svg>
 
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Buscar pelo nome do aluno"
                            class="sa-search__input"
                            autocomplete="off"
                            aria-label="Buscar pelo nome do aluno"
                        >
 
                        @if ($search)
                            <a
                                href="{{ route('anamnesis.index') }}"
                                class="sa-search__clear"
                                aria-label="Limpar busca"
                            >&times;</a>
                        @endif
 
                        <button type="submit" class="sa-btn sa-btn--soft">
                            Buscar
                        </button>
 
                    </form>
 
 
                    <a href="{{ route('anamnesis.create') }}" class="sa-btn sa-btn--primary">
 
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                        </svg>
 
                        <span>{{ __('Adicionar anamnese') }}</span>
 
                    </a>
 
                </div>
 
 
                {{-- TABELA --}}
                <div class="sa-scroll">
 
                    <table class="sa-table">
 
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>ID do Assistido</th>
                                <th>Data Anamnese</th>
                                <th>Assinatura</th>
                                <th class="sa-right">Ações</th>
                            </tr>
                        </thead>
 
                        <tbody>
 
                            @forelse ($medHistories as $medHistory)
 
                                @php
                                    $studentName = $medHistory->student->name ?? null;
                                    $initial = $studentName
                                        ? mb_strtoupper(mb_substr($studentName, 0, 1))
                                        : '?';
                                @endphp
 
                                <tr>
 
                                    {{-- NOME --}}
                                    <td>
                                        <a
                                            href="{{ route('anamnesis.show', $medHistory->id) }}"
                                            class="sa-student"
                                        >
                                            <span class="sa-avatar">{{ $initial }}</span>
                                            <span class="sa-student__name">
                                                {{ $studentName ?? 'Não informado' }}
                                            </span>
                                        </a>
                                    </td>
 
                                    {{-- ID --}}
                                    <td>
                                        {{ $medHistory->student_id }}
                                    </td>
 
                                    {{-- DATA --}}
                                    <td>
                                        <span class="sa-date">
 
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                aria-hidden="true"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16" />
                                                <rect x="4" y="5" width="16" height="16" rx="2" />
                                            </svg>
 
                                            {{ $medHistory->date_of_anamnesis }}
 
                                        </span>
                                    </td>
 
                                    {{-- ASSINATURA --}}
                                    <td>
                                        {{ $medHistory->user->name ?? 'Não informado' }}
                                    </td>
 
                                    {{-- AÇÕES --}}
                                    <td class="sa-right">
                                        <a
                                            href="{{ route('anamnesis.show', $medHistory->id) }}"
                                            class="sa-link"
                                        >
                                            Ver detalhes →
                                        </a>
                                    </td>
 
                                </tr>
 
                            @empty
 
                                <tr>
                                    <td colspan="5">
 
                                        <div class="sa-empty">
 
                                            <div class="sa-empty__icon">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.6"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 4.5V3h6v1.5M9 4.5H6.75A2.25 2.25 0 0 0 4.5 6.75v12A2.25 2.25 0 0 0 6.75 21h10.5a2.25 2.25 0 0 0 2.25-2.25v-12a2.25 2.25 0 0 0-2.25-2.25H15M9 4.5h6M8.25 10.5h7.5M8.25 14h7.5M8.25 17.5h4.5"
                                                    />
                                                </svg>
                                            </div>
 
                                            <p class="sa-empty__title">
                                                Nenhum registro encontrado.
                                            </p>
 
                                            <p class="sa-empty__text">
                                                @if ($search)
                                                    Nenhuma ficha corresponde a “{{ $search }}”. Tente outro nome.
                                                @else
                                                    As fichas de anamnese cadastradas aparecerão aqui.
                                                @endif
                                            </p>
 
                                        </div>
 
                                    </td>
                                </tr>
 
                            @endforelse
 
                        </tbody>
 
                    </table>
 
                </div>
 
 
                {{-- PAGINAÇÃO --}}
                @if ($medHistories->hasPages())
                    <div class="sa-pagination">
                        {{ $medHistories->appends(request()->query())->links() }}
                    </div>
                @endif
 
            </section>
 
        </div>
 
    </div>
 
</x-app-layout>
 
