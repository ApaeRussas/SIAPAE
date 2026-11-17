
<x-app-layout>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div>
                <h2 class="text-2xl font-semibold siapae-header-title">
                    Ficha mensal
                </h2>
                <p class="mt-1 text-sm siapae-header-subtitle">
                    Histórico de acompanhamento dos estudantes.
                </p>
            </div>
        </div>
    </x-slot>

    <style>
        :root {
            --sa-surface: #FFFFFF;
            --sa-soft: #F1F4EF;
            --sa-hover: #F7F7F7;
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

        .siapae-header-title {
            color: var(--sa-title) !important;
        }

        .siapae-header-subtitle {
            color: var(--sa-muted) !important;
        }

        .sa-card {
            overflow: hidden;
            border: 1px solid var(--sa-border);
            border-radius: 24px;
            background: var(--sa-surface);
            box-shadow: var(--sa-shadow);
        }

        .sa-toolbar {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            padding: 20px 24px;
        }

        .sa-search {
            display: flex;
            align-items: center;
            flex: 1 1 320px;
            min-width: 0;
            height: 46px;
            gap: 10px;
            padding: 0 6px 0 14px;
            border: 1px solid var(--sa-border);
            border-radius: 14px;
            background: var(--sa-field);
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

        .sa-search__input,
        .sa-search__input:focus {
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

        .sa-search__input::placeholder {
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
        }

        .sa-search__clear:hover {
            background: var(--sa-hover);
        }

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
        .sa-search__clear:focus-visible,
        .sa-link:focus-visible {
            outline: 2px solid var(--sa-green);
            outline-offset: 3px;
        }

        .sa-btn--soft {
            height: 34px;
            padding: 0 14px;
            border-radius: 10px;
            background: var(--sa-green-light);
            color: var(--sa-green);
        }

        .sa-btn--soft:hover {
            background: var(--sa-hover);
        }

        .sa-student-list {
            border-top: 1px solid var(--sa-border);
        }

        .sa-student-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 24px;
            border-bottom: 1px solid var(--sa-border);
            transition: background-color 160ms ease;
        }

        .sa-student-item:last-child {
            border-bottom: 0;
        }

        .sa-student-item:hover {
            background: var(--sa-hover);
        }

        .sa-student-info {
            display: flex;
            align-items: center;
            min-width: 0;
            gap: 14px;
        }

        .sa-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--sa-green-light);
            color: var(--sa-green);
            font-size: 0.875rem;
            font-weight: 700;
        }

        .sa-student__name {
            color: var(--sa-title);
            font-size: 0.9375rem;
            font-weight: 600;
        }

        .sa-student__details {
            display: flex;
            flex-wrap: wrap;
            gap: 6px 18px;
            margin-top: 6px;
            color: var(--sa-muted);
            font-size: 0.8125rem;
        }

        .sa-student__detail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .sa-student__detail svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
        }

        .sa-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            flex-shrink: 0;
            min-height: 38px;
            padding: 0 14px;
            border-radius: 10px;
            background: var(--sa-green-light);
            color: var(--sa-green);
            font-size: 0.8125rem;
            font-weight: 600;
            transition: background-color 160ms ease, color 160ms ease;
        }

        .sa-link:hover {
            background: var(--sa-green);
            color: #FFFFFF;
        }

        .sa-link svg {
            width: 16px;
            height: 16px;
        }

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
            background: var(--sa-green-light);
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

        @media (max-width: 640px) {
            .sa-toolbar {
                padding: 16px;
            }

            .sa-search {
                flex-basis: 100%;
            }

            .sa-student-item {
                align-items: flex-start;
                flex-direction: column;
                gap: 14px;
                padding: 18px 16px;
            }

            .sa-student-info {
                width: 100%;
            }

            .sa-link {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .sa-btn,
            .sa-search,
            .sa-student-item,
            .sa-link {
                transition: none;
            }
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <section class="sa-card">

                <div class="sa-toolbar">

                    <form
                        method="GET"
                        action="{{ route('monthlyStudentRecord.index') }}"
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
                            placeholder="Buscar pelo nome do estudante"
                            class="sa-search__input"
                            autocomplete="off"
                            aria-label="Buscar pelo nome do estudante"
                        >

                        @if ($search)
                            <a
                                href="{{ route('monthlyStudentRecord.index') }}"
                                class="sa-search__clear"
                                aria-label="Limpar busca"
                            >&times;</a>
                        @endif

                        <button type="submit" class="sa-btn sa-btn--soft">
                            Buscar
                        </button>

                    </form>

                </div>

                @php
                    $studentsWithAttendance = $students->filter(function ($student) {
                        return $student->attendances->isNotEmpty();
                    });
                @endphp

                <div class="sa-student-list">

                    @forelse ($studentsWithAttendance as $student)

                        @php
                            $attendanceCount = $student->attendances->count();

                            $professorCount = $student->attendances
                                ->pluck('signature_id')
                                ->filter()
                                ->unique()
                                ->count();

                            $lastAttendance = $student->attendances->first();

                            $initial = $student->name
                                ? mb_strtoupper(mb_substr($student->name, 0, 1))
                                : '?';
                        @endphp

                        <div class="sa-student-item">

                            <div class="sa-student-info">

                                <span class="sa-avatar">
                                    {{ $initial }}
                                </span>

                                <div class="min-w-0">

                                    <h3 class="sa-student__name">
                                        {{ $student->name }}
                                    </h3>

                                    <div class="sa-student__details">

                                        <span class="sa-student__detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                                            </svg>
                                            {{ $attendanceCount }}
                                            {{ $attendanceCount === 1 ? 'atendimento' : 'atendimentos' }}
                                        </span>

                                        <span class="sa-student__detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m16-10a4 4 0 1 0 0-8m4 18v-2a4 4 0 0 0-3-3.87M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>
                                            </svg>
                                            {{ $professorCount }}
                                            {{ $professorCount === 1 ? 'professor' : 'professores' }}
                                        </span>

                                        @if ($lastAttendance?->date)
                                            <span class="sa-student__detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16"/>
                                                    <rect x="4" y="5" width="16" height="16" rx="2"/>
                                                </svg>
                                                Último atendimento:
                                                {{ \Carbon\Carbon::parse($lastAttendance->date)->format('d/m/Y') }}
                                            </span>
                                        @endif

                                    </div>

                                </div>

                            </div>

                            <a
                                href="{{ route('monthlyStudentRecord.show', ['student' => $student->id]) }}"
                                class="sa-link"
                            >
                                <span>Ver ficha</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                        </div>

                    @empty

                        <div class="sa-empty">

                            <div class="sa-empty__icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5V3h6v1.5M9 4.5H6.75A2.25 2.25 0 0 0 4.5 6.75v12A2.25 2.25 0 0 0 6.75 21h10.5a2.25 2.25 0 0 0 2.25-2.25v-12a2.25 2.25 0 0 0-2.25-2.25H15M9 4.5h6M8.25 10.5h7.5M8.25 14h7.5M8.25 17.5h4.5"/>
                                </svg>
                            </div>

                            <p class="sa-empty__title">
                                Nenhum estudante encontrado.
                            </p>

                            <p class="sa-empty__text">
                                @if ($search)
                                    Nenhum estudante com registros corresponde a "{{ $search }}". Tente outro nome.
                                @else
                                    Os estudantes com registros de atendimento aparecerão aqui.
                                @endif
                            </p>

                        </div>

                    @endforelse

                </div>

            </section>

        </div>
    </div>

</x-app-layout>
