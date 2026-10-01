<x-app-layout :notRegularSidebar="$notRegularSidebar" :element="$element">
 
    @php
        $parameter = isset($notRegularSidebar) ? '?notRegularSidebar=1' : null;
 
        $activityNotPerformed = (bool) $attendance->activity_not_performed;
 
        $hasAdvances =
            !empty($attendance->advances) ||
            !is_null($attendance->advances_level);
 
        $hasDifficulties =
            !empty($attendance->difficulties) ||
            !is_null($attendance->difficulties_level);
 
        $advancesLevels = [
            1 => 'Quase nada',
            2 => 'Muito pouco',
            3 => 'Pouco',
            4 => 'Bom',
            5 => 'Excelente',
        ];
 
        $difficultiesLevels = $advancesLevels;
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
 
                {{-- SITUAÇÃO DA ATIVIDADE --}}
                <div class="attendance-card">
                    <p class="attendance-card-title">Atividade realizada</p>
 
                    @if ($activityNotPerformed)
                        <span class="attendance-badge attendance-badge-danger">Não realizou a atividade</span>
                    @else
                        <span class="attendance-badge attendance-badge-success">Sim</span>
                    @endif
                </div>
 
 
                {{-- AVANÇOS --}}
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
 
 
                {{-- DIFICULDADES --}}
                <div class="attendance-card">
                    <p class="attendance-card-title">Houve dificuldades?</p>
 
                    @if ($hasDifficulties)
                        <span class="attendance-badge attendance-badge-warning mb-4">Sim</span>
 
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
 
 
                {{-- BOTÕES --}}
                <div class="flex gap-2 items-center justify-between pt-2">
 
                    <div>
                        <x-button
                            href="{{ route('student.show', $attendance->student->id) }}"
                            variant="blue"
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
 
                        {{-- EDITAR - MOBILE --}}
                        <x-button
                            href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                            class="flex sm:hidden"
                            title="Editar Atendimento"
                            variant="edit"
                            size="sm"
                        >
                            <x-icons.edit />
                        </x-button>
 
                        {{-- EDITAR - DESKTOP --}}
                        <x-button
                            href="{{ route('attendance.edit', $attendance->id) . $parameter }}"
                            class="hidden sm:flex"
                            title="Editar Atendimento"
                            variant="warning"
                        >
                            <p class="text-gray-900 px-2">{{ __('Editar') }}</p>
                        </x-button>
 
                        {{-- DELETAR --}}
                        @if ($attendance->student->state_student === 'alive')
                            <form
                                method="POST"
                                action="{{ route('attendance.destroy', $attendance->id) . $parameter }}"
                                accept-charset="UTF-8"
                                style="display:inline"
                            >
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
 
                                {{-- MOBILE --}}
                                <x-button
                                    variant="pdf-trash"
                                    title="Deletar Atendimento"
                                    size="sm"
                                    class="flex sm:hidden"
                                    onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')"
                                >
                                    <x-icons.trash />
                                </x-button>
 
                                {{-- DESKTOP --}}
                                <x-button
                                    type="submit"
                                    variant="danger"
                                    title="Deletar Atendimento"
                                    class="hidden sm:flex"
                                    onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')"
                                >
                                    <div class="text-gray-100 dark:text-gray-200 px-2">{{ __('Deletar') }}</div>
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
        --bg: transparent;
        --surface: #F7F5EF;
        --surface-soft: #E3EFE7;
        --surface-hover: #F0EEE6;
        --input-bg: #FFFFFF;
        --title: #183C2C;
        --text: #42564A;
        --muted: #78857D;
        --border: #E2E8E2;
        --green: #2F6B4F;
        --green-dark: #1F513A;
        --green-light: #E3EFE7;
        --gold: #C99B4A;
        --gold-light: #F7EFDD;
        --danger: #C98B45;
        --danger-dark: #A96F31;
        --neutral: #B8C7BE;
        --shadow: 0 10px 30px rgba(31, 81, 58, 0.06);
        display: block;
        min-height: calc(100vh - 64px);
        background-color: var(--bg);
        color: var(--text);
        padding-bottom: 2rem;
        transition: background-color 250ms ease, color 250ms ease;
    }
 
    .dark .attendance-page {
        --bg: #0D1B15;
        --surface: #14271E;
        --surface-soft: #1A3025;
        --surface-hover: #20392C;
        --input-bg: #FFFFFF;
        --title: #F5F1E8;
        --text: #D1DBD3;
        --muted: #91A197;
        --border: #294236;
        --green: #76B58F;
        --green-dark: #5D9D78;
        --green-light: rgba(118, 181, 143, 0.14);
        --gold: #D8B56A;
        --gold-light: rgba(216, 181, 106, 0.13);
        --danger: #D8935B;
        --danger-dark: #C77A3E;
        --neutral: #40584B;
        --shadow: 0 14px 35px rgba(0, 0, 0, 0.20);
    }
 
    /* Fundos: tudo que era branco/cinza vira off-white (igual à frequência) */
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
    .attendance-page .shadow-lg { box-shadow: none !important; }
    .attendance-page .border-gray-100,
    .attendance-page .border-gray-200,
    .attendance-page .border-gray-300,
    .attendance-page .dark\:border-gray-700,
    .attendance-page .dark\:border-gray-600 { border-color: var(--border) !important; }
 
    /* Tabelas */
    .attendance-page table { background-color: var(--surface) !important; }
    .attendance-page table thead,
    .attendance-page table thead th {
        background-color: var(--surface-soft) !important;
        color: var(--muted) !important;
        border-color: var(--border) !important;
        font-weight: 600;
    }
    .attendance-page table td { color: var(--text) !important; border-color: var(--border) !important; }
    .attendance-page table tbody tr { background-color: var(--surface) !important; transition: background-color 0.18s ease; }
    .attendance-page table tbody tr:hover { background-color: var(--surface-hover) !important; }
 
    /* Campos */
    .attendance-page input,
    .attendance-page select,
    .attendance-page textarea {
        color: var(--title) !important;
        background-color: var(--input-bg) !important;
        border: 1px solid var(--border) !important;
        border-radius: 9px !important;
        box-shadow: none !important;
        transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }
    .attendance-page input::placeholder,
    .attendance-page textarea::placeholder { color: var(--muted) !important; opacity: 1; }
    .attendance-page input:focus,
    .attendance-page select:focus,
    .attendance-page textarea:focus {
        border-color: var(--green) !important;
        box-shadow: 0 0 0 3px var(--green-light) !important;
        outline: none !important;
    }
    .attendance-page #search-container {
        background-color: var(--input-bg) !important;
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
        box-shadow: 0 0 0 3px var(--green-light) !important;
    }
 
    /* Azul -> verde */
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
    .attendance-page .text-blue-700 { color: var(--green) !important; }
 
    /* Paginação */
    .attendance-page nav { color: var(--muted) !important; }
    .attendance-page nav a,
    .attendance-page nav span { color: var(--text) !important; }
 
    .attendance-page button,
    .attendance-page a {
        transition: background-color 0.18s ease, border-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease;
    }
 
    /* Cards da tela de visualização */
    .attendance-page .attendance-card {
        background-color: var(--surface) !important;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1.1rem 1.25rem;
        box-shadow: var(--shadow);
    }
    .attendance-page .attendance-card-title {
        color: var(--title);
        font-size: 0.92rem;
        font-weight: 600;
        margin-bottom: 0.6rem;
    }
    .attendance-page .attendance-card-label {
        color: var(--muted);
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.25rem;
    }
    .attendance-page .attendance-card-text {
        color: var(--text);
        white-space: pre-line;
    }
 
    /* Selos */
    .attendance-page .attendance-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.8rem;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .attendance-page .attendance-badge-success { background: var(--green-light); color: var(--green-dark); }
    .attendance-page .attendance-badge-warning { background: var(--gold-light); color: var(--danger-dark); }
    .attendance-page .attendance-badge-danger  { background: var(--gold-light); color: var(--danger-dark); }
    .attendance-page .attendance-badge-neutral { background: var(--surface-soft); color: var(--muted); }
    .dark .attendance-page .attendance-badge-success { color: var(--green); }
    .dark .attendance-page .attendance-badge-warning,
    .dark .attendance-page .attendance-badge-danger  { color: var(--gold); }
 
    /* Nível */
    .attendance-page .attendance-level {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        border-radius: 10px;
        font-weight: 700;
        color: #FFFFFF;
    }
    .attendance-page .attendance-level-success { background: var(--green); }
    .attendance-page .attendance-level-warning { background: var(--danger); }
    .attendance-page .attendance-level-name {
        color: var(--text);
        font-size: 0.9rem;
        font-weight: 500;
    }
</style>