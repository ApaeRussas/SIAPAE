<style>
 
    /* Cores vêm de resources/css/siapae-theme.css (variáveis --sp-*) */
 
    .siapae-sidebar-nav {
        scrollbar-width: thin;
        scrollbar-color: var(--sp-border) transparent;
    }
 
    .siapae-section-title {
        padding: 0 12px;
        margin-top: 16px;
        margin-bottom: 4px;
 
        font-size: 10px;
        line-height: 1.2;
        font-weight: 700;
 
        letter-spacing: 0.12em;
        text-transform: uppercase;
 
        color: var(--sp-section);
    }
 
</style>
 
 
<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="siapae-sidebar-nav flex flex-col flex-1 px-3 pb-4 z-20"
>
 
 
    {{-- =====================================================
         INÍCIO
         ===================================================== --}}
 
    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="siapae-section-title"
    >
        Início
    </div>
 
 
    {{-- DASHBOARD --}}
 
    <div>
 
        <x-sidebar.link
            title="Visão geral"
            href="{{ route('dashboard') }}"
            :isActive="request()->routeIs('dashboard')"
        >
 
            <x-slot name="icon">
 
                <x-icons.dashboard
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
        </x-sidebar.link>
 
    </div>
 
 
    {{-- =====================================================
         ATENDIMENTO
         ===================================================== --}}
 
    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="siapae-section-title"
    >
        Atendimento
    </div>
 
 
    {{-- ANAMNESE --}}
 
    <div>
 
        <x-sidebar.link
            title="{{ __('Anamnesis') }}"
            href="{{ route('anamnesis.index') }}"
            :isActive="request()->routeIs(
                'anamnesis.index',
                'anamnesis.create',
                'anamnesis.edit',
                'anamnesis.show',
                'anamnesis.deposit'
            )"
        >
 
            <x-slot name="icon">
 
                <x-icons.anamnesis
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
        </x-sidebar.link>
 
    </div>
 
 
    {{-- ESTUDANTES --}}
 
    <div>
 
        <x-sidebar.link
            title="{{ __('Student File') }}"
            href="{{ route('student.index') }}"
            :isActive="request()->routeIs(
                'student.index',
                'student.create',
                'student.edit',
                'student.show',
                'student.deposit'
            )"
        >
 
            <x-slot name="icon">
 
                <x-icons.person
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
        </x-sidebar.link>
 
    </div>
 
 
    {{-- FREQUÊNCIA --}}
 
    <div>
 
        <x-sidebar.link
            title="{{ __('Frequency List') }}"
            href="{{ route('frequency.index') }}"
            :isActive="request()->routeIs('frequency.index')"
        >
 
            <x-slot name="icon">
 
                <x-icons.frequency
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
        </x-sidebar.link>
 
    </div>
 
 
    {{-- REG. DE ATENDIMENTO --}}
 
    <div>
 
        <x-sidebar.link
            title="Reg. de Atendimento"
            href="{{ route('attendance.index') }}"
            :isActive="request()->routeIs(
                'attendance.index',
                'attendance.create',
                'attendance.edit',
                'attendance.show',
                'attendance.deposit'
            )"
        >
 
            <x-slot name="icon">
 
                <x-icons.register
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
        </x-sidebar.link>
 
    </div>
 
 
    {{-- LISTA DE ATENDIMENTO --}}
 
    <div>
 
        <x-sidebar.link
            title="Lista de Atendimento"
            href="{{ route('attendance.list') }}"
            :isActive="request()->routeIs('attendance.list')"
        >
 
            <x-slot name="icon">
 
                <x-icons.register
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
        </x-sidebar.link>
 
    </div>
 
 
    {{-- SCFV --}}
 
    <div>
 
        <x-sidebar.link
            title="{{ __('SCFV') }}"
            href="{{ route('scfv.index') }}"
            :isActive="request()->routeIs(
                'scfv.index',
                'scfv.create',
                'scfv.edit',
                'scfv.show'
            )"
        >
 
            <x-slot name="icon">
 
                <x-icons.scfv
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
        </x-sidebar.link>
 
    </div>
 
 
    {{-- =====================================================
         GESTÃO
         ===================================================== --}}
 
    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="siapae-section-title"
    >
        Gestão
    </div>
 
 
    {{-- RELATÓRIOS --}}
 
    <div>
 
        <x-sidebar.dropdown
            title="{{ __('Reports') }}"
            :active="Str::startsWith(
                request()->route()->uri(),
                ['educational', 'regional']
            )"
        >
 
            <x-slot name="icon">
 
                <x-icons.report
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
 
            </x-slot>
 
 
            {{-- PEDAGÓGICO --}}
 
            <x-sidebar.sublink
                title="{{ __('Pedagogic') }}"
                href="{{ route('educational.index') }}"
                :active="request()->routeIs(
                    'educational.index',
                    'educational.create',
                    'educational.edit',
                    'educational.show',
                    'educational.deposit'
                )"
            />
 
 
            {{-- REGIONAL --}}
 
            @canany(['coordinator-view', 'admin-view'])
 
                <x-sidebar.sublink
                    title="{{ __('Regional') }}"
                    href="{{ route('regional.index') }}"
                    :active="request()->routeIs(
                        'regional.index',
                        'regional.create',
                        'regional.edit',
                        'regional.show'
                    )"
                />
 
            @endcanany
 
        </x-sidebar.dropdown>
 
    </div>
 
 
    {{-- =====================================================
         REUNIÕES
         ===================================================== --}}
 
    @canany(['coordinator-view', 'admin-view'])
 
        <div
            x-transition
            x-show="isSidebarOpen || isSidebarHovered"
            class="siapae-section-title"
        >
            Reuniões
        </div>
 
 
        {{-- ATAS DE REUNIÕES --}}
 
        <div>
 
            <x-sidebar.link
                title="{{ __('Reunions Records') }}"
                href="{{ route('record.index') }}"
                :isActive="request()->routeIs(
                    'record.index',
                    'record.create',
                    'record.edit'
                )"
            >
 
                <x-slot name="icon">
 
                    <x-icons.meeting
                        class="flex-shrink-0 w-5 h-5"
                        aria-hidden="true"
                    />
 
                </x-slot>
 
            </x-sidebar.link>
 
        </div>
 
    @endcanany
 
 
    {{-- =====================================================
         ADMINISTRAÇÃO
         ===================================================== --}}
 
    @can('admin-view')
 
        <div
            x-transition
            x-show="isSidebarOpen || isSidebarHovered"
            class="siapae-section-title"
        >
            Administração
        </div>
 
 
        {{-- DOAÇÕES --}}
 
        <div>
 
            <x-sidebar.link
                title="{{ __('Donation Control') }}"
                href="{{ route('donation.index') }}"
                :isActive="request()->routeIs('donation.index')"
            >
 
                <x-slot name="icon">
 
                    <x-icons.partner
                        class="flex-shrink-0 w-5 h-5"
                        aria-hidden="true"
                    />
 
                </x-slot>
 
            </x-sidebar.link>
 
        </div>
 
 
        {{-- GASTOS --}}
 
        <div>
 
            <x-sidebar.link
                title="{{ __('Expense Control') }}"
                href="{{ route('expense.index') }}"
                :isActive="request()->routeIs(
                    'expense.index',
                    'expense.create',
                    'expense.edit',
                    'expense.show'
                )"
            >
 
                <x-slot name="icon">
 
                    <x-icons.expense
                        class="flex-shrink-0 w-5 h-5"
                        aria-hidden="true"
                    />
 
                </x-slot>
 
            </x-sidebar.link>
 
        </div>
 
    @endcan
 
 
</x-perfect-scrollbar>