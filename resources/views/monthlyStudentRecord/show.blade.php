
<x-app-layout>
    <x-slot name="header">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 px-4 sm:flex-row sm:items-center sm:px-6 lg:px-8">
            <div>
                <h2 class="text-2xl font-semibold siapae-header-title">
                    Ficha mensal
                </h2>
                <p class="mt-1 text-sm siapae-header-subtitle">
                    Acompanhamento e evolução de {{ $student->name }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('monthlyStudentRecord.index') }}" class="sa-header-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    <span>Voltar</span>
                </a>

                <button type="button" onclick="window.print()" class="sa-btn sa-btn--primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V3h12v6M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v7H6z" />
                    </svg>
                    <span>Imprimir ficha</span>
                </button>
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

        .sa-header-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 42px;
            padding: 0 16px;
            border: 1px solid var(--sa-border);
            border-radius: 12px;
            background: var(--sa-surface);
            color: var(--sa-title);
            font-size: 0.875rem;
            font-weight: 600;
            transition: background-color 160ms ease;
        }

        .sa-header-btn:hover {
            background: var(--sa-hover);
        }

        .sa-header-btn svg {
            width: 18px;
            height: 18px;
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

        .sa-btn--primary {
            min-height: 42px;
            padding: 0 18px;
            border-radius: 12px;
            background: var(--sa-btn);
            color: #FFFFFF;
        }

        .sa-btn--primary:hover {
            background: var(--sa-btn-hover);
            box-shadow: 0 8px 20px rgba(31, 81, 58, 0.15);
        }

        .sa-btn svg {
            width: 18px;
            height: 18px;
        }

        .sa-card {
            overflow: hidden;
            border: 1px solid var(--sa-border);
            border-radius: 20px;
            background: var(--sa-surface);
            box-shadow: var(--sa-shadow);
        }

        .sa-card__header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--sa-border);
        }

        .sa-card__body {
            padding: 24px;
        }

        .sa-section-title {
            color: var(--sa-title);
            font-size: 1rem;
            font-weight: 700;
        }

        .sa-section-description {
            margin-top: 4px;
            color: var(--sa-muted);
            font-size: 0.8125rem;
            line-height: 1.5;
        }

        .sa-student-panel {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 24px;
        }

        .sa-student-label {
            color: var(--sa-muted);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .sa-student-name {
            margin-top: 5px;
            color: var(--sa-title);
            font-size: 1.4rem;
            font-weight: 700;
        }

        .sa-period {
            padding: 12px 16px;
            border: 1px solid var(--sa-border);
            border-radius: 12px;
            background: var(--sa-soft);
        }

        .sa-period-label {
            color: var(--sa-muted);
            font-size: 0.75rem;
        }

        .sa-period-value {
            margin-top: 3px;
            color: var(--sa-green);
            font-size: 0.9rem;
            font-weight: 700;
        }

        .sa-filter-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            padding: 22px 24px;
        }

        .sa-field label {
            display: block;
            margin-bottom: 7px;
            color: var(--sa-text);
            font-size: 0.8125rem;
            font-weight: 600;
        }

        .sa-field select {
            width: 100%;
            height: 44px;
            padding: 0 12px;
            border: 1px solid var(--sa-border);
            border-radius: 11px;
            outline: none;
            background: var(--sa-field);
            color: var(--sa-title);
            font-size: 0.875rem;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }

        .sa-field select:focus {
            border-color: var(--sa-green);
            box-shadow: 0 0 0 3px var(--sa-ring);
        }

        .sa-filter-action {
            display: flex;
            align-items: flex-end;
        }

        .sa-filter-action button {
            width: 100%;
            height: 44px;
        }

        .sa-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .sa-stat {
            position: relative;
            overflow: hidden;
            padding: 20px;
            border: 1px solid var(--sa-border);
            border-radius: 18px;
            background: var(--sa-surface);
            box-shadow: var(--sa-shadow);
        }

        .sa-stat::before {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--sa-green);
            content: "";
        }

        .sa-stat__label {
            color: var(--sa-muted);
            font-size: 0.8125rem;
            font-weight: 600;
        }

        .sa-stat__value {
            margin-top: 10px;
            color: var(--sa-title);
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1.1;
        }

        .sa-stat__value--green {
            color: var(--sa-green);
        }

        .sa-stat__detail {
            margin-top: 7px;
            color: var(--sa-muted);
            font-size: 0.75rem;
        }

        .sa-chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .sa-chart-container--tall {
            height: 340px;
        }

        .sa-status-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .sa-status-item {
            padding: 18px;
            border: 1px solid var(--sa-border);
            border-radius: 14px;
            background: var(--sa-soft);
        }

        .sa-status-label {
            color: var(--sa-muted);
            font-size: 0.8125rem;
            font-weight: 600;
        }

        .sa-status-value {
            margin-top: 8px;
            color: var(--sa-green);
            font-size: 1.65rem;
            font-weight: 700;
        }

        .sa-table-scroll {
            overflow-x: auto;
        }

        .sa-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .sa-table thead {
            background: var(--sa-soft);
        }

        .sa-table th {
            padding: 14px 22px;
            color: var(--sa-muted);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .sa-table td {
            padding: 15px 22px;
            border-top: 1px solid var(--sa-border);
            color: var(--sa-text);
            font-size: 0.875rem;
        }

        .sa-table tbody tr {
            transition: background-color 160ms ease;
        }

        .sa-table tbody tr:hover {
            background: var(--sa-hover);
        }

        .sa-month-card {
            overflow: hidden;
            border: 1px solid var(--sa-border);
            border-radius: 18px;
            background: var(--sa-surface);
            box-shadow: var(--sa-shadow);
        }

        .sa-month-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 22px;
            border-bottom: 1px solid var(--sa-border);
            background: var(--sa-soft);
        }

        .sa-month-title {
            color: var(--sa-title);
            font-size: 1rem;
            font-weight: 700;
        }

        .sa-month-year {
            margin-top: 3px;
            color: var(--sa-muted);
            font-size: 0.8125rem;
        }

        .sa-professor {
            overflow: hidden;
            border: 1px solid var(--sa-border);
            border-radius: 14px;
            background: var(--sa-surface);
        }

        .sa-professor-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 18px;
            border-bottom: 1px solid var(--sa-border);
            background: var(--sa-soft);
        }

        .sa-professor-avatar {
            display: flex;
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--sa-green-light);
            color: var(--sa-green);
            font-size: 0.8rem;
            font-weight: 700;
        }

        .sa-professor-label {
            color: var(--sa-muted);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .sa-professor-name {
            margin-top: 2px;
            color: var(--sa-title);
            font-size: 0.875rem;
            font-weight: 700;
        }

        .sa-attendance {
            padding: 18px;
            border-bottom: 1px solid var(--sa-border);
        }

        .sa-attendance:last-child {
            border-bottom: 0;
        }

        .sa-attendance-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        .sa-tag {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 4px 10px;
            border-radius: 8px;
            background: var(--sa-green-light);
            color: var(--sa-green);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .sa-tag--neutral {
            background: var(--sa-soft);
            color: var(--sa-text);
            font-weight: 500;
        }

        .sa-attendance-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .sa-detail {
            padding: 14px;
            border: 1px solid var(--sa-border);
            border-radius: 11px;
            background: var(--sa-soft);
        }

        .sa-detail-title {
            margin-bottom: 6px;
            color: var(--sa-title);
            font-size: 0.8125rem;
            font-weight: 700;
        }

        .sa-detail-text {
            color: var(--sa-text);
            font-size: 0.8125rem;
            line-height: 1.65;
            overflow-wrap: anywhere;
            white-space: pre-line;
        }

        .sa-not-performed {
            margin-top: 12px;
            padding: 13px 15px;
            border: 1px solid var(--sa-border);
            border-radius: 11px;
            background: var(--sa-soft);
            color: var(--sa-text);
            font-size: 0.8125rem;
            font-weight: 600;
        }

        .sa-empty {
            padding: 48px 24px;
            text-align: center;
        }

        .sa-empty-icon {
            display: flex;
            width: 54px;
            height: 54px;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            border-radius: 17px;
            background: var(--sa-green-light);
            color: var(--sa-green);
        }

        .sa-empty-icon svg {
            width: 26px;
            height: 26px;
        }

        .sa-empty-title {
            color: var(--sa-title);
            font-size: 0.9375rem;
            font-weight: 700;
        }

        .sa-empty-text {
            margin-top: 5px;
            color: var(--sa-muted);
            font-size: 0.8125rem;
        }

        @media (max-width: 900px) {
            .sa-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sa-stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .sa-filter-grid,
            .sa-status-grid,
            .sa-attendance-grid {
                grid-template-columns: 1fr;
            }

            .sa-student-panel {
                padding: 18px;
            }

            .sa-card__body {
                padding: 18px;
            }

            .sa-card__header {
                padding: 18px;
            }

            .sa-stats-grid {
                gap: 10px;
            }

            .sa-stat {
                padding: 15px;
            }

            .sa-stat__value {
                font-size: 1.5rem;
            }

            .sa-chart-container,
            .sa-chart-container--tall {
                height: 270px;
            }

            .sa-month-header {
                padding: 15px 17px;
            }

            .sa-attendance {
                padding: 14px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .sa-btn,
            .sa-header-btn,
            .sa-table tbody tr {
                transition: none;
            }
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 7mm;
            }

            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                background: #FFFFFF !important;
                color: #243129 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                overflow: visible !important;
            }

            nav,
            header {
                display: none !important;
            }

            body * {
                visibility: hidden !important;
            }

            #monthly-print,
            #monthly-print * {
                visibility: visible !important;
            }

            #monthly-print {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                background: #FFFFFF !important;
                color: #243129 !important;
            }

            #monthly-print .monthly-filter-card,
            #monthly-print form,
            #monthly-print select,
            #monthly-print button,
            #monthly-print a {
                display: none !important;
            }

            #monthly-print .sa-card,
            #monthly-print .sa-stat,
            #monthly-print .sa-month-card,
            #monthly-print .sa-professor {
                box-shadow: none !important;
                break-inside: avoid;
            }

            #monthly-print .sa-card,
            #monthly-print .sa-stat,
            #monthly-print .sa-month-card,
            #monthly-print .sa-professor,
            #monthly-print .sa-detail {
                border-color: #D7DED8 !important;
            }

            #monthly-print .sa-student-panel,
            #monthly-print .sa-card__body {
                padding: 10px !important;
            }

            #monthly-print .sa-card__header,
            #monthly-print .sa-month-header {
                padding: 8px 10px !important;
            }

            #monthly-print .sa-filter-grid {
                display: none !important;
            }

            #monthly-print .sa-stats-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                gap: 6px !important;
            }

            #monthly-print .sa-stat {
                padding: 9px !important;
            }

            #monthly-print .sa-stat__value {
                font-size: 17px !important;
            }

            #monthly-print .sa-stat__label,
            #monthly-print .sa-stat__detail {
                font-size: 8px !important;
            }

            #monthly-print .sa-chart-container,
            #monthly-print .sa-chart-container--tall {
                height: 160px !important;
            }

            #monthly-print .sa-status-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
                gap: 6px !important;
            }

            #monthly-print .sa-status-item {
                padding: 9px !important;
            }

            #monthly-print .sa-status-value {
                font-size: 17px !important;
            }

            #monthly-print .sa-attendance {
                padding: 9px !important;
            }

            #monthly-print .sa-attendance-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 6px !important;
            }

            #monthly-print .sa-detail {
                padding: 8px !important;
            }

            #monthly-print .sa-detail-title,
            #monthly-print .sa-detail-text,
            #monthly-print .sa-professor-name,
            #monthly-print .sa-table td {
                font-size: 8px !important;
            }

            #monthly-print .sa-table th {
                font-size: 7px !important;
                padding: 6px 8px !important;
            }

            #monthly-print .sa-table td {
                padding: 6px 8px !important;
            }

            #monthly-print .sa-section-title {
                font-size: 11px !important;
            }

            #monthly-print .sa-section-description,
            #monthly-print .sa-period-label,
            #monthly-print .sa-month-year {
                font-size: 8px !important;
            }

            #monthly-print .sa-student-name {
                font-size: 16px !important;
            }

            #monthly-print .sa-month-card {
                margin-bottom: 8px !important;
            }

            #monthly-print .sa-professor {
                margin-bottom: 6px !important;
            }

            #monthly-print .sa-attendance-meta {
                margin-bottom: 7px !important;
            }

            #monthly-print .sa-empty {
                padding: 20px !important;
            }

            #monthly-print .sa-table-scroll {
                overflow: visible !important;
            }

            #monthly-print .sa-table tr {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            #monthly-print h1,
            #monthly-print h2,
            #monthly-print h3,
            #monthly-print h4,
            #monthly-print h5,
            #monthly-print h6 {
                break-after: avoid;
                page-break-after: avoid;
            }

            #monthly-print .sa-detail,
            #monthly-print .sa-status-item {
                background: #F1F4EF !important;
            }

            #monthly-print .sa-month-header {
                background: #E3EFE7 !important;
            }

            #monthly-print .sa-title,
            #monthly-print .sa-student-name,
            #monthly-print .sa-section-title,
            #monthly-print .sa-detail-title {
                color: #243129 !important;
            }

            #monthly-print .sa-section-description,
            #monthly-print .sa-detail-text,
            #monthly-print .sa-stat__detail {
                color: #5E6962 !important;
            }

            #monthly-print .sa-stat__value,
            #monthly-print .sa-status-value,
            #monthly-print .sa-period-value {
                color: #2F6B4F !important;
            }
        }
    </style>

    <div id="monthly-print" class="py-6">
        <div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">

            <section class="sa-card">
                <div class="sa-student-panel">
                    <div>
                        <p class="sa-student-label">Estudante</p>
                        <h1 class="sa-student-name">{{ $student->name }}</h1>
                    </div>

                    <div class="sa-period">
                        <p class="sa-period-label">Período analisado</p>
                        <p class="sa-period-value">
                            @if ($month)
                                {{ $monthNames[(int) $month] }} de {{ $year }}
                            @else
                                Todo o ano de {{ $year }}
                            @endif
                        </p>
                    </div>
                </div>
            </section>

            <section class="sa-card monthly-filter-card">
                <div class="sa-card__header">
                    <h3 class="sa-section-title">Filtros de consulta</h3>
                    <p class="sa-section-description">Selecione o professor e o período que deseja consultar.</p>
                </div>

                <form method="GET" action="{{ route('monthlyStudentRecord.show', ['student' => $student->id]) }}" class="sa-filter-grid">
                    <div class="sa-field">
                        <label for="professor_id">Professor</label>
                        <select id="professor_id" name="professor_id">
                            <option value="">Todos os professores</option>
                            @foreach ($professors as $professor)
                                <option value="{{ $professor->id }}" @selected($professorId == $professor->id)>
                                    {{ $professor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sa-field">
                        <label for="year">Ano</label>
                        <select id="year" name="year">
                            @foreach ($years as $availableYear)
                                <option value="{{ $availableYear }}" @selected($year == $availableYear)>
                                    {{ $availableYear }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sa-field">
                        <label for="month">Mês</label>
                        <select id="month" name="month">
                            <option value="">Todos os meses</option>
                            @foreach ($monthNames as $monthNumber => $monthName)
                                <option value="{{ $monthNumber }}" @selected((int) $month === $monthNumber)>
                                    {{ $monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sa-filter-action">
                        <button type="submit" class="sa-btn sa-btn--primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 9h12m-9 5h6m-4 5h2" />
                            </svg>
                            Filtrar resultados
                        </button>
                    </div>
                </form>
            </section>

            <section class="sa-stats-grid">
                <div class="sa-stat">
                    <p class="sa-stat__label">Presenças</p>
                    <p class="sa-stat__value sa-stat__value--green">{{ $presenceCount }}</p>
                    <p class="sa-stat__detail">{{ $presencePercentage }}% do período</p>
                </div>

                <div class="sa-stat">
                    <p class="sa-stat__label">Faltas</p>
                    <p class="sa-stat__value">{{ $absenceCount }}</p>
                    <p class="sa-stat__detail">{{ $absencePercentage }}% do período</p>
                </div>

                <div class="sa-stat">
                    <p class="sa-stat__label">Atividades realizadas</p>
                    <p class="sa-stat__value sa-stat__value--green">{{ $activitiesPerformed }}</p>
                    <p class="sa-stat__detail">Total de atividades realizadas</p>
                </div>

                <div class="sa-stat">
                    <p class="sa-stat__label">Participação</p>
                    <p class="sa-stat__value">
                        {{ $participationPercentage !== null ? number_format($participationPercentage, 1, ',', '.') . '%' : '—' }}
                    </p>
                    <p class="sa-stat__detail">Sobre {{ $classifiableActivities }} registros com situação identificável</p>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div class="sa-card">
                    <div class="sa-card__header">
                        <h3 class="sa-section-title">Presenças e faltas</h3>
                        <p class="sa-section-description">
                            Quantidade de atendimentos por resposta e nível no período filtrado. Campos sem nível ficam separados para não presumir respostas.
                        </p>
                    </div>
                    <div class="sa-card__body">
                        <div class="sa-chart-container">
                            <canvas id="frequencyChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="sa-card">
                    <div class="sa-card__header">
                        <h3 class="sa-section-title">Avanços e dificuldades</h3>
                        <p class="sa-section-description">
                            @if ($month)
                                Percentual de atividades realizadas em {{ $monthNames[(int) $month] }}.
                            @else
                                Percentual de atividades realizadas por mês.
                            @endif
                        </p>
                    </div>
                    <div class="sa-card__body">
                        <div class="sa-chart-container sa-chart-container--tall">
                            <canvas id="advancesDifficultiesChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>

            <section class="sa-card">
                <div class="sa-card__header">
                    <h3 class="sa-section-title">Situação das atividades</h3>
                    <p class="sa-section-description">
                        Distribuição dos registros conforme a situação informada pelos professores.
                    </p>
                </div>

                <div class="sa-card__body">
                    <div class="sa-status-grid">
                        <div class="sa-status-item">
                            <p class="sa-status-label">Atividades realizadas</p>
                            <p class="sa-status-value">{{ $activitiesPerformed }}</p>
                        </div>

                        <div class="sa-status-item">
                            <p class="sa-status-label">Atividades não realizadas</p>
                            <p class="sa-status-value">{{ $activitiesNotPerformed }}</p>
                        </div>

                        <div class="sa-status-item">
                            <p class="sa-status-label">Sem informação suficiente</p>
                            <p class="sa-status-value">{{ $activitiesWithoutStatus }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="sa-card">
                <div class="sa-card__header">
                    <h3 class="sa-section-title">Histórico mensal</h3>
                    <p class="sa-section-description">
                        Frequência e participação no período selecionado.
                    </p>
                </div>

                <div class="sa-table-scroll">
                    <table class="sa-table">
                        <thead>
                            <tr>
                                <th>Mês</th>
                                <th>Presenças</th>
                                <th>Faltas</th>
                                <th>Participação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($monthlyLabels); $i++)
                                @if ($monthlyPresences[$i] > 0 || $monthlyAbsences[$i] > 0 || $monthlyParticipation[$i] !== null)
                                    <tr>
                                        <td class="font-semibold">{{ $monthlyLabels[$i] }}</td>
                                        <td>{{ $monthlyPresences[$i] }}</td>
                                        <td>{{ $monthlyAbsences[$i] }}</td>
                                        <td class="font-semibold" style="color: var(--sa-green)">
                                            {{ $monthlyParticipation[$i] !== null ? number_format($monthlyParticipation[$i], 1, ',', '.') . '%' : '—' }}
                                        </td>
                                    </tr>
                                @endif
                            @endfor
                        </tbody>
                    </table>
                </div>
            </section>

            <section>
                <div class="mb-4">
                    <h3 class="sa-section-title text-lg">Histórico de atendimentos</h3>
                    <p class="sa-section-description">
                        Registros realizados pelos professores no período selecionado.
                    </p>
                </div>

                <div class="space-y-5">
                    @forelse ($months as $monthKey => $monthAttendances)
                        @php
                            $monthDate = \Carbon\Carbon::createFromFormat('Y-m', $monthKey);
                            $monthNumber = (int) $monthDate->format('n');
                        @endphp

                        <div class="sa-month-card">
                            <div class="sa-month-header">
                                <div>
                                    <h4 class="sa-month-title">{{ $monthNames[$monthNumber] }}</h4>
                                    <p class="sa-month-year">{{ $year }}</p>
                                </div>
                                <span class="sa-tag">
                                    {{ $monthAttendances->count() }} {{ $monthAttendances->count() === 1 ? 'registro' : 'registros' }}
                                </span>
                            </div>

                            <div class="space-y-4 p-4 sm:p-5">
                                @foreach ($monthAttendances->groupBy('signature_id') as $professorAttendances)
                                    @php
                                        $professor = $professorAttendances->first()->professor;
                                        $professorName = $professor?->name ?? 'Professor não informado';
                                        $professorInitial = mb_strtoupper(mb_substr($professorName, 0, 1));
                                    @endphp

                                    <div class="sa-professor">
                                        <div class="sa-professor-header">
                                            <span class="sa-professor-avatar">{{ $professorInitial }}</span>
                                            <div>
                                                <p class="sa-professor-label">Professor responsável</p>
                                                <h5 class="sa-professor-name">{{ $professorName }}</h5>
                                            </div>
                                        </div>

                                        <div>
                                            @foreach ($professorAttendances as $attendance)
                                                <article class="sa-attendance">
                                                    <div class="sa-attendance-meta">
                                                        <span class="sa-tag">
                                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}
                                                        </span>

                                                        @if ($attendance->educational_axis)
                                                            <span class="sa-tag sa-tag--neutral">
                                                                {{ $attendance->educational_axis }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="sa-attendance-grid">
                                                        @if ($attendance->skills)
                                                            <div class="sa-detail">
                                                                <h6 class="sa-detail-title">Habilidades</h6>
                                                                <p class="sa-detail-text">{{ $attendance->skills }}</p>
                                                            </div>
                                                        @endif

                                                        @if ($attendance->skills_evolution)
                                                            <div class="sa-detail">
                                                                <h6 class="sa-detail-title">Evolução das habilidades</h6>
                                                                <p class="sa-detail-text">{{ $attendance->skills_evolution }}</p>
                                                            </div>
                                                        @endif

                                                        @if ($attendance->activity_description)
                                                            <div class="sa-detail">
                                                                <h6 class="sa-detail-title">Atividade realizada</h6>
                                                                <p class="sa-detail-text">{{ $attendance->activity_description }}</p>
                                                            </div>
                                                        @endif

                                                        @if ($attendance->advances)
                                                            <div class="sa-detail">
                                                                <h6 class="sa-detail-title">Avanços</h6>
                                                                <p class="sa-detail-text">{{ $attendance->advances }}</p>
                                                            </div>
                                                        @endif

                                                        @if ($attendance->difficulties)
                                                            <div class="sa-detail">
                                                                <h6 class="sa-detail-title">Dificuldades</h6>
                                                                <p class="sa-detail-text">{{ $attendance->difficulties }}</p>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    @if ($attendance->activity_not_performed)
                                                        <div class="sa-not-performed">
                                                            Atividade não realizada
                                                        </div>
                                                    @endif
                                                </article>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="sa-card">
                            <div class="sa-empty">
                                <div class="sa-empty-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                    </svg>
                                </div>
                                <h3 class="sa-empty-title">Nenhum atendimento encontrado</h3>
                                <p class="sa-empty-text">
                                    Não existem atendimentos para este estudante no período selecionado.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const labels = @json($monthlyLabels);
            const presences = @json($monthlyPresences);
            const absences = @json($monthlyAbsences);

            const textColor = getComputedStyle(document.documentElement)
                .getPropertyValue('--sa-text').trim() || '#42564A';

            const mutedColor = getComputedStyle(document.documentElement)
                .getPropertyValue('--sa-muted').trim() || '#78857D';

            const gridColor = 'rgba(120, 133, 125, 0.14)';

            const frequencyCanvas = document.getElementById('frequencyChart');

            if (frequencyCanvas) {
                new Chart(frequencyCanvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Presenças',
                                data: presences,
                                backgroundColor: '#2F6B4F',
                                borderRadius: 6,
                                maxBarThickness: 38
                            },
                            {
                                label: 'Faltas',
                                data: absences,
                                backgroundColor: '#A5B0A8',
                                borderRadius: 6,
                                maxBarThickness: 38
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: textColor,
                                    usePointStyle: true,
                                    padding: 18,
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: mutedColor
                                },
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    color: mutedColor
                                },
                                grid: {
                                    color: gridColor
                                }
                            }
                        }
                    }
                });
            }

            const advancesDifficultiesCanvas = document.getElementById('advancesDifficultiesChart');

            if (advancesDifficultiesCanvas) {
                const levelLabels = @json($advancesDifficultyChartLabels);
                const levelCounts = @json($advancesDifficultyChartValues);

                new Chart(advancesDifficultiesCanvas, {
                    type: 'bar',
                    data: {
                        labels: levelLabels,
                        datasets: [{
                            label: 'Quantidade de atendimentos',
                            data: levelCounts,
                            backgroundColor: levelLabels.map((_, index) =>
                                index < 7 ? '#2F6B4F' : '#A5B0A8'
                            ),
                            borderRadius: 5,
                            maxBarThickness: 24
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    color: mutedColor
                                },
                                grid: {
                                    color: gridColor
                                }
                            },
                            y: {
                                ticks: {
                                    color: textColor,
                                    font: {
                                        size: 11
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
