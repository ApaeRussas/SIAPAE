<style>

    /* =========================================================
       SIAPAE - NOVO MENU (APAE RUSSAS)
       ========================================================= */

    .siapae-sidebar-nav {
        --sidebar-text: #243129;
        --sidebar-title: #23543E;
        --sidebar-muted: #6E7A72;

        --sidebar-hover: #F8F7F2;

        --sidebar-active-bg: #E7F0E9;
        --sidebar-active-text: #23543E;
        --sidebar-active-icon: #2F6B4F;

        --sidebar-divider: #E4E8E2;
    }


    /* =========================================================
       TEMA ESCURO (VERDE DISCRETO QUASE COR DO FUNDO)
       ========================================================= */

    .dark .siapae-sidebar-nav {
        --sidebar-text: #E4E8E2;
        --sidebar-title: #B8CCBD;
        --sidebar-muted: #8A99AD;

        --sidebar-hover: rgba(255, 255, 255, 0.05);

        /* Fundo super discreto (apenas 10% de opacidade do tom escuro) */
        --sidebar-active-bg: rgba(35, 84, 62, 0.22); 
        --sidebar-active-text: #FFFFFF;
        --sidebar-active-icon: #D5A85A; /* Dourado suave para o ícone */

        --sidebar-divider: rgba(255, 255, 255, 0.08);
    }


    /* =========================================================
       NAVEGAÇÃO
       ========================================================= */

    .siapae-sidebar-nav {
        scrollbar-width: thin;
        scrollbar-color: #B8CCBD transparent;
    }

    .dark .siapae-sidebar-nav {
        scrollbar-color: #23543E transparent;
    }


    /* =========================================================
       TÍTULOS DAS SEÇÕES
       ========================================================= */

    .siapae-section-title {
        padding: 0 12px;
        margin-top: 14px;
        margin-bottom: 4px;

        font-size: 10px;
        line-height: 1.2;
        font-weight: 700;

        letter-spacing: 0.12em;
        text-transform: uppercase;

        color: var(--sidebar-muted);

        transition:
            opacity 150ms ease,
            transform 150ms ease;
    }


    /* =========================================================
       ESPAÇAMENTO DOS ITENS
       ========================================================= */

    .siapae-menu-item {
        position: relative;
        border-radius: 10px;

        transition:
            background-color 150ms ease,
            color 150ms ease,
            transform 150ms ease;
    }


    /* =========================================================
       HOVER
       ========================================================= */

    .siapae-menu-item:hover {
        background-color: var(--sidebar-hover);
    }


    /* =========================================================
       ITEM ATIVO (DISCRETO E ELEGANTE)
       ========================================================= */

    .siapae-sidebar-nav .siapae-menu-item.is-active {
        background-color: var(--sidebar-active-bg) !important;
        color: var(--sidebar-active-text) !important;
    }

    .dark .siapae-sidebar-nav .siapae-menu-item.is-active {
        border: 1px solid rgba(47, 107, 79, 0.4); /* Linha fina e suave em volta */
    }


    /* Indicador lateral fino do item ativo */

    .siapae-sidebar-nav .siapae-menu-item.is-active::before {
        content: "";

        position: absolute;

        left: 0;
        top: 50%;

        width: 3px;
        height: 18px;

        border-radius: 0 4px 4px 0;

        background-color: var(--sidebar-active-icon);

        transform: translateY(-50%);
    }


    /* =========================================================
       ÍCONES
       ========================================================= */

    .siapae-sidebar-nav .siapae-menu-item svg {
        width: 20px;
        height: 20px;

        color: var(--sidebar-muted);

        transition:
            color 150ms ease,
            transform 150ms ease;
    }


    .siapae-sidebar-nav .siapae-menu-item:hover svg {
        color: var(--sidebar-text);
    }


    .siapae-sidebar-nav .siapae-menu-item.is-active svg {
        color: var(--sidebar-active-icon) !important;
    }


    /* =========================================================
       TEXTO
       ========================================================= */

    .siapae-sidebar-nav .siapae-menu-item span {
        color: var(--sidebar-text);
        transition: color 150ms ease;
    }


    .siapae-sidebar-nav .siapae-menu-item.is-active span {
        color: var(--sidebar-active-text) !important;
        font-weight: 600;
    }


    /* =========================================================
       SUBMENU
       ========================================================= */

    .siapae-sidebar-nav [x-show] {
        border-left: 1px solid var(--sidebar-divider);
        margin-left: 20px;
        padding-left: 8px;
    }


    /* =========================================================
       QUANDO A SIDEBAR ESTÁ RECOLHIDA
       ========================================================= */

    @media (min-width: 768px) {

        .siapae-sidebar-nav {
            transition: padding 150ms ease;
        }

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

    <div class="siapae-menu-item">

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

    <div class="siapae-menu-item">

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

    <div class="siapae-menu-item">

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

    <div class="siapae-menu-item">

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



    {{-- ATENDIMENTOS --}}

    <div class="siapae-menu-item">

        <x-sidebar.link
            title="{{ __('Attendance Register') }}"
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



    {{-- SCFV --}}

    <div class="siapae-menu-item">

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

    <div class="siapae-menu-item">

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
            Gestão
        </div>


        {{-- ATAS DE REUNIÕES --}}

        <div class="siapae-menu-item">

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

        <div class="siapae-menu-item">

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

        <div class="siapae-menu-item">

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