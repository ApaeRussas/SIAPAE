<x-app-layout :notRegularSidebar="$notRegularSidebar" :element="$element">

    @php
        $parameter = isset($notRegularSidebar) ? '?notRegularSidebar=1' : null;

        $activityNotPerformed = (bool) $attendance->activity_not_performed;

        $hasAdvances = !empty($attendance->advances) || !is_null($attendance->advances_level);

        $hasDifficulties = !empty($attendance->difficulties) || !is_null($attendance->difficulties_level);

        $advancesLevels = [
            1 => 'Quase nada',
            2 => 'Muito pouco',
            3 => 'Pouco',
            4 => 'Bom',
            5 => 'Excelente',
        ];

        $difficultiesLevels = [
            1 => 'Quase nada',
            2 => 'Muito pouco',
            3 => 'Pouco',
            4 => 'Não apresenta',
            5 => 'Ainda com dificuldade',
        ];
    @endphp

    <div class="attendance-page">

        <x-table-show
            :title="'Atendimento de data ' . ' - ' . $attendance->date"
            :elementShow="$attendance"
            :labelsVariables="[
                ['Nome do aluno', 'student.name', 'select'],
                ['Assinatura do Professor Responsável', 'professor.name', 'text'],
                ['Eixo educacional trabalhado', 'educational_axis', 'textarea'],
                ['Habilidades', 'skills', 'textarea'],
                ['Evolução das habilidades', 'skills_evolution', 'textarea'],
                ['Descrição da atividade realizada', 'activity_description', 'textarea'],
            ]"
            actionRoute="attendance"
            additional
            notRegularSidebar
            notEditDelete
        >

            <div class="mt-5 space-y-5">

                <div class="attendance-card">
                    <p class="attendance-card-title">Atividade realizada</p>

                    @if ($activityNotPerformed)
                        <span class="attendance-badge attendance-badge-warning">Não realizou a atividade</span>
                    @else
                        <span class="attendance-badge attendance-badge-success">Sim</span>
                    @endif
                </div>

                <div class="attendance-card">
                    <p class="attendance-card-title">Houve avanços?</p>

                    @if ($hasAdvances)
                        <span class="attendance-badge attendance-badge-success mb-4">Sim</span>

                        @if (!empty($attendance->advances))
                            <div class="mb-4">
                                <p class="attendance-card-label">Descrição dos avanços</p>
                                <div class="attendance-card-text">{{ $attendance->advances }}</div>
                            </div>
                        @endif

                        @if (!is_null($attendance->advances_level))
                            <div>
                                <p class="attendance-card-label mb-2">Nível do avanço</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="attendance-level attendance-level-success">
                                        {{ $attendance->advances_level }}
                                    </span>
                                    <span class="attendance-level-name">
                                        {{ $advancesLevels[$attendance->advances_level] ?? 'Nível não informado' }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @else
                        <span class="attendance-badge attendance-badge-neutral">Não</span>
                    @endif
                </div>

                <div class="attendance-card">
                    <p class="attendance-card-title">Houve dificuldades?</p>

                    @if ($hasDifficulties)
                        <span class="attendance-badge attendance-badge-success mb-4">Sim</span>

                        @if (!empty($attendance->difficulties))
                            <div class="mb-4">
                                <p class="attendance-card-label">Descrição das dificuldades</p>
                                <div class="attendance-card-text">{{ $attendance->difficulties }}</div>
                            </div>
                        @endif

                        @if (!is_null($attendance->difficulties_level))
                            <div>
                                <p class="attendance-card-label mb-2">Nível das dificuldades</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="attendance-level attendance-level-warning">
                                        {{ $attendance->difficulties_level }}
                                    </span>
                                    <span class="attendance-level-name">
                                        {{ $difficultiesLevels[$attendance->difficulties_level] ?? 'Nível não informado' }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @else
                        <span class="attendance-badge attendance-badge-neutral">Não</span>
                    @endif
                </div>

                <div class="flex gap-2 items-center justify-between pt-2">

                    <div>
                        <x-button
                            href="{{ route('student.show', $attendance->student->id) }}"
                            variant="success"
                        >
                            <p class="flex px-2">
                                Ir para Aluno
                                <span class="hidden sm:flex ml-1">
                                    {{ \Illuminate\Support\Str::limit($attendance->student->name, 15) }}
                                </span>
                            </p>
                        </x-button>
                    </div>

                    <div class="flex gap-2">

                        <x-button
                            href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                            class="flex sm:hidden"
                            title="Editar Atendimento"
                            variant="edit"
                            size="sm"
                        >
                            <x-icons.edit />
                        </x-button>

                        <x-button
                            href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                            class="hidden sm:flex"
                            title="Editar Atendimento"
                            variant="warning"
                        >
                            <p class="text-gray-900 px-2">{{ __('Editar') }}</p>
                        </x-button>

                        @if ($attendance->student->state_student === 'alive')
                            <form
                                method="POST"
                                action="{{ route('attendance.destroy', $attendance->id) . $parameter }}"
                                accept-charset="UTF-8"
                                style="display:inline"
                            >
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}

                                <x-button
                                    variant="pdf-trash"
                                    title="Deletar Atendimento"
                                    size="sm"
                                    class="flex sm:hidden"
                                    onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')"
                                >
                                    <x-icons.trash />
                                </x-button>

                                <x-button
                                    type="submit"
                                    variant="danger"
                                    title="Deletar Atendimento"
                                    class="hidden sm:flex"
                                    onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')"
                                >
                                    <div class="text-gray-100  px-2">{{ __('Deletar') }}</div>
                                </x-button>
                            </form>
                        @endif

                    </div>
                </div>

            </div>

        </x-table-show>

    </div>

</x-app-layout>

<style>
    .attendance-page {
        --surface: #FFFFFF;
        --surface-soft: #F1F4EF;
        --surface-hover: #F7F7F7;
        --title: #243129;
        --text: #42564A;
        --muted: #78857D;
        --border: #E2E8E2;
        --green: #2F6B4F;
        --green-dark: #1F513A;
        --green-light: #E3EFE7;
        --field: #FFFFFF;
        --ring: rgba(47, 107, 79, 0.18);
        --neutral: #A5B0A8;
        --shadow: 0 10px 30px rgba(31, 81, 58, 0.06);

        display: block;
        min-height: calc(100vh - 64px);
        padding-bottom: 2rem;
        color: var(--text);
        background: transparent;
        transition: color 200ms ease;
    }

    .dark .attendance-page {
        --surface: #14271E;
        --surface-soft: #1A3025;
        --surface-hover: #20392C;
        --title: #F5F1E8;
        --text: #D1DBD3;
        --muted: #91A197;
        --border: #294236;
        --green: #76B58F;
        --green-dark: #8CC9A3;
        --green-light: rgba(118, 181, 143, 0.14);
        --field: #0F2018;
        --ring: rgba(118, 181, 143, 0.25);
        --neutral: #40584B;
        --shadow: 0 14px 35px rgba(0, 0, 0, 0.20);
    }

    .attendance-page,
    .attendance-page * {
        box-sizing: border-box;
    }

    .attendance-page .bg-white,
    .attendance-page .dark\:bg-gray-800,
    .attendance-page .dark\:bg-gray-900,
    .attendance-page .dark\:bg-gray-700 {
        background-color: var(--surface) !important;
    }

    .attendance-page .bg-gray-50,
    .attendance-page .bg-gray-100,
    .attendance-page .dark\:bg-gray-600 {
        background-color: var(--surface-soft) !important;
    }

    .attendance-page .shadow,
    .attendance-page .shadow-sm,
    .attendance-page .shadow-md,
    .attendance-page .shadow-lg {
        box-shadow: none !important;
    }

    .attendance-page .border-gray-100,
    .attendance-page .border-gray-200,
    .attendance-page .border-gray-300,
    .attendance-page .dark\:border-gray-700,
    .attendance-page .dark\:border-gray-600 {
        border-color: var(--border) !important;
    }

    .attendance-page table {
        background: var(--surface) !important;
        border-color: var(--border) !important;
    }

    .attendance-page table thead,
    .attendance-page table thead th {
        background: var(--surface-soft) !important;
        color: var(--muted) !important;
        border-color: var(--border) !important;
        font-weight: 600;
    }

    .attendance-page table td {
        color: var(--text) !important;
        border-color: var(--border) !important;
    }

    .attendance-page table tbody tr {
        background: var(--surface) !important;
        transition: background-color 160ms ease;
    }

    .attendance-page table tbody tr:hover {
        background: var(--surface-hover) !important;
    }

    .attendance-page input,
    .attendance-page select,
    .attendance-page textarea {
        color: var(--title) !important;
        background: var(--field) !important;
        border: 1px solid var(--border) !important;
        border-radius: 9px !important;
        box-shadow: none !important;
    }

    .attendance-page input::placeholder,
    .attendance-page textarea::placeholder {
        color: var(--muted) !important;
        opacity: 1;
    }

    .attendance-page input:focus,
    .attendance-page select:focus,
    .attendance-page textarea:focus {
        border-color: var(--green) !important;
        box-shadow: 0 0 0 3px var(--ring) !important;
        outline: none !important;
    }

    .attendance-page #search-container {
        background: var(--field) !important;
        border: 1px solid var(--border) !important;
        border-radius: 10px !important;
        box-shadow: none !important;
    }

    .attendance-page #search-container input,
    .attendance-page #search-container select {
        border-color: transparent !important;
    }

    .attendance-page #search-container:focus-within {
        border-color: var(--green) !important;
        box-shadow: 0 0 0 3px var(--ring) !important;
    }

    .attendance-page .bg-blue-500,
    .attendance-page .bg-blue-600,
    .attendance-page .bg-blue-700 {
        background-color: var(--green) !important;
        border-color: var(--green) !important;
        color: #FFFFFF !important;
    }

    .attendance-page .bg-blue-500:hover,
    .attendance-page .bg-blue-600:hover,
    .attendance-page .bg-blue-700:hover,
    .attendance-page .hover\:bg-blue-600:hover,
    .attendance-page .hover\:bg-blue-700:hover {
        background-color: var(--green-dark) !important;
        border-color: var(--green-dark) !important;
    }

    .attendance-page .text-blue-500,
    .attendance-page .text-blue-600,
    .attendance-page .text-blue-700 {
        color: var(--green) !important;
    }

    .attendance-page nav {
        color: var(--muted) !important;
    }

    .attendance-page nav a,
    .attendance-page nav span {
        color: var(--text) !important;
    }

    .attendance-page button,
    .attendance-page a {
        transition: background-color 160ms ease, border-color 160ms ease, color 160ms ease, box-shadow 160ms ease;
    }

    .attendance-page .attendance-card {
        padding: 20px 24px;
        border: 1px solid var(--border);
        border-radius: 18px;
        background: var(--surface) !important;
        box-shadow: var(--shadow);
    }

    .attendance-page .attendance-card-title {
        margin-bottom: 10px;
        color: var(--title);
        font-size: 0.9375rem;
        font-weight: 700;
    }

    .attendance-page .attendance-card-label {
        margin-bottom: 5px;
        color: var(--muted);
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .attendance-page .attendance-card-text {
        color: var(--text);
        font-size: 0.875rem;
        line-height: 1.65;
        overflow-wrap: anywhere;
        white-space: pre-line;
    }

    .attendance-page .attendance-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
    }

    .attendance-page .attendance-badge-success {
        background: var(--green-light);
        color: var(--green);
        border-color: transparent;
    }

    .attendance-page .attendance-badge-warning {
        background: var(--surface-soft);
        color: var(--text);
        border-color: var(--border);
    }

    .attendance-page .attendance-badge-neutral {
        background: var(--surface-soft);
        color: var(--muted);
        border-color: var(--border);
    }

    .attendance-page .attendance-level {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        border-radius: 10px;
        color: #FFFFFF;
        font-weight: 700;
    }

    .attendance-page .attendance-level-success {
        background: var(--green);
    }

    .attendance-page .attendance-level-warning {
        background: #718078;
    }

    .attendance-page .attendance-level-name {
        color: var(--text);
        font-size: 0.875rem;
        font-weight: 500;
    }

    @media (max-width: 640px) {
        .attendance-page .attendance-card {
            padding: 16px;
            border-radius: 14px;
        }
    }

    @media print {
        .attendance-page .attendance-card {
            box-shadow: none !important;
            break-inside: avoid;
        }
    }
</style>