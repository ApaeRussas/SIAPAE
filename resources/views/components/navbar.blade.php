<style>
 
    /* =========================================================
       SIAPAE — NAVBAR
       As cores ficam em CSS próprio (variáveis + .dark), assim
       o tema escuro funciona mesmo que o Tailwind não gere as
       classes arbitrárias dark:bg-[#...] deste arquivo.
       ========================================================= */
 
    /* ---------- MODO CLARO ---------- */
 
    .siapae-nav {
        --nav-bg: #F7F5EF;  /* É AQUI!!! */
        --nav-border: #E4E8E2;
        --nav-title: #1B4632;
        --nav-muted: #7A867E;
        --nav-hover: #F1F5F2;
        --nav-focus: rgba(47, 107, 79, 0.35);
 
        --avatar-bg: #E8F0EA;
        --avatar-border: #C8D8CC;
        --avatar-icon: #2F6B4F;
 
        --toggle-track: #EEF3EF;
        --toggle-border: #DCE5DE;
        --toggle-border-hover: #C8D8CC;
        --toggle-knob: #FFFFFF;
        --toggle-knob-shadow: 0 2px 6px rgba(31, 81, 58, 0.18);
        --toggle-sun: #C99B4A;
        --toggle-moon: #9AA89F;
 
        background-color: var(--nav-bg);
        border-bottom: 1px solid var(--nav-border);
    }
 
    /* ---------- MODO ESCURO ---------- */
 
    .dark .siapae-nav {
        --nav-bg: #10251B;
        --nav-border: #294236;
        --nav-title: #F5F1E8;
        --nav-muted: #91A197;
        --nav-hover: #173126;
        --nav-focus: rgba(216, 181, 106, 0.45);
 
        --avatar-bg: #173126;
        --avatar-border: #3B604B;
        --avatar-icon: #8FC5A5;
 
        --toggle-track: #0D1B15;
        --toggle-border: #294236;
        --toggle-border-hover: #3B604B;
        --toggle-knob: #20392C;
        --toggle-knob-shadow: 0 2px 8px rgba(0, 0, 0, 0.45);
        --toggle-sun: #6F8577;
        --toggle-moon: #D8B56A;
    }
 
 
    /* =========================================================
       BOTÃO DE TEMA (switch)
       ========================================================= */
 
    .siapae-theme-toggle {
        position: relative;
        flex-shrink: 0;
        width: 64px;
        height: 34px;
        padding: 0;
        border-radius: 999px;
        border: 1px solid var(--toggle-border);
        background-color: var(--toggle-track);
        cursor: pointer;
        transition:
            background-color 250ms ease,
            border-color 250ms ease;
    }
 
    .siapae-theme-toggle:hover {
        border-color: var(--toggle-border-hover);
    }
 
    .siapae-theme-toggle:focus-visible {
        outline: 2px solid var(--nav-focus);
        outline-offset: 2px;
    }
 
    .siapae-theme-toggle__knob {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 26px;
        height: 26px;
        border-radius: 999px;
        background-color: var(--toggle-knob);
        box-shadow: var(--toggle-knob-shadow);
        transition:
            transform 320ms cubic-bezier(0.34, 1.3, 0.64, 1),
            background-color 250ms ease;
    }
 
    .dark .siapae-theme-toggle__knob {
        transform: translateX(30px);
    }
 
    .siapae-theme-toggle__icon {
        position: absolute;
        top: 3px;
        z-index: 1;
        display: grid;
        place-items: center;
        width: 26px;
        height: 26px;
        pointer-events: none;
        transition: color 250ms ease;
    }
 
    .siapae-theme-toggle__icon svg {
        width: 16px;
        height: 16px;
    }
 
    .siapae-theme-toggle__icon--sun {
        left: 3px;
        color: var(--toggle-sun);
    }
 
    .siapae-theme-toggle__icon--moon {
        right: 3px;
        color: var(--toggle-moon);
    }
 
 
    /* =========================================================
       USUÁRIO
       ========================================================= */
 
    .siapae-user-btn {
        border-radius: 12px;
        transition: background-color 200ms ease;
    }
 
    .siapae-user-btn:hover {
        background-color: var(--nav-hover);
    }
 
    .siapae-user-btn:focus-visible {
        outline: 2px solid var(--nav-focus);
        outline-offset: 2px;
    }
 
    .siapae-user-avatar {
        background-color: var(--avatar-bg);
        border: 1px solid var(--avatar-border);
        color: var(--avatar-icon);
    }
 
    .siapae-user-label {
        color: var(--nav-muted);
    }
 
    .siapae-user-name {
        color: var(--nav-title);
    }
 
    .siapae-user-chevron {
        color: var(--nav-muted);
        transition: color 200ms ease;
    }
 
    .siapae-user-btn:hover .siapae-user-chevron {
        color: var(--avatar-icon);
    }
 
 
    /* =========================================================
       BOTÃO DO MENU (mobile)
       ========================================================= */
 
    .siapae-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        border: 1px solid var(--toggle-border);
        background-color: var(--toggle-track);
        color: var(--avatar-icon);
        transition:
            background-color 200ms ease,
            border-color 200ms ease;
    }
 
    .siapae-icon-btn:hover {
        border-color: var(--toggle-border-hover);
        background-color: var(--nav-hover);
    }
 
    .siapae-icon-btn:focus-visible {
        outline: 2px solid var(--nav-focus);
        outline-offset: 2px;
    }
 
 
    /* ---------- Movimento reduzido ---------- */
 
    @media (prefers-reduced-motion: reduce) {
        .siapae-theme-toggle,
        .siapae-theme-toggle__knob,
        .siapae-theme-toggle__icon {
            transition: none;
        }
    }
 
</style>
 
 
<!-- ==========================================================
     NAVBAR SUPERIOR
     ========================================================== -->
 
<nav
    aria-label="secondary"
    x-data="{ open: false }"
    class="
        siapae-nav
        sticky
        top-0
        z-10
        flex
        items-center
        justify-end
        h-20
        px-5
        sm:px-7
        shadow-sm
        transition-transform
        duration-500
    "
    :class="{
        '-translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }"
>
 
    <div class="flex items-center gap-3 sm:gap-4">
 
        <!-- ======================================================
             BOTÃO TEMA
             ====================================================== -->
 
        <button
            type="button"
            role="switch"
            class="siapae-theme-toggle"
            :aria-checked="isDarkMode"
            aria-label="Alternar entre tema claro e escuro"
            x-on:click="toggleTheme"
        >
 
            <span class="siapae-theme-toggle__knob" aria-hidden="true"></span>
 
            <span class="siapae-theme-toggle__icon siapae-theme-toggle__icon--sun" aria-hidden="true">
                <x-heroicon-o-sun />
            </span>
 
            <span class="siapae-theme-toggle__icon siapae-theme-toggle__icon--moon" aria-hidden="true">
                <x-heroicon-o-moon />
            </span>
 
        </button>
 
 
        <!-- ======================================================
             USUÁRIO
             ====================================================== -->
 
        <x-dropdown align="right" width="48">
 
            <x-slot name="trigger">
 
                <button class="siapae-user-btn group flex items-center gap-3 pl-2 pr-3 py-1.5 focus:outline-none">
 
                    <!-- Avatar -->
                    <div class="siapae-user-avatar flex items-center justify-center w-9 h-9 rounded-full">
 
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
 
                    </div>
 
 
                    <!-- Nome -->
                    <div class="hidden sm:flex flex-col items-start justify-center leading-tight">
 
                        <span class="siapae-user-label text-[11px] font-medium">
                            Usuário
                        </span>
 
                        <span class="siapae-user-name max-w-[130px] truncate text-sm font-semibold">
                            {{ Auth::user()->name }}
                        </span>
 
                    </div>
 
 
                    <!-- Seta -->
                    <svg
                        class="siapae-user-chevron w-4 h-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
 
                </button>
 
            </x-slot>
 
 
            <!-- Menu do usuário -->
 
            <x-slot name="content">
 
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
 
                @canany(['coordinator-view', 'admin-view'])
                    <x-dropdown-link :href="route('coordinator.index')">
                        {{ __('Users Table') }}
                    </x-dropdown-link>
                @endcanany
 
                @can('admin-view')
                    <x-dropdown-link :href="route('admin.index')">
                        {{ __('Admin') }}
                    </x-dropdown-link>
                @endcan
 
                <form method="POST" action="{{ route('logout') }}">
 
                    @csrf
 
                    <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-dropdown-link>
 
                </form>
 
            </x-slot>
 
        </x-dropdown>
 
    </div>
 
</nav>
 
 
<!-- ==========================================================
     BARRA INFERIOR MOBILE
     ========================================================== -->
 
<div
    class="
        siapae-nav
        fixed
        inset-x-0
        bottom-0
        flex
        items-center
        justify-between
        px-4
        py-3
        sm:px-6
        shadow-lg
        md:hidden
        z-10
        transition-transform
        duration-500
    "
    style="border-bottom: 0; border-top: 1px solid var(--nav-border);"
    :class="{
        'translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }"
>
 
    <!-- Espaço -->
    <div class="w-10"></div>
 
 
    <!-- Logo -->
    <a
        href="{{ route('dashboard') }}"
        class="flex items-center justify-center"
    >
 
        <x-application-logo-light
            x-show="!isDarkMode"
            class="w-24"
        />
 
        <x-application-logo-dark
            x-show="isDarkMode"
            class="w-24"
        />
 
        <span class="sr-only">
            Dashboard
        </span>
 
    </a>
 
 
    <!-- Menu mobile -->
    <button
        type="button"
        class="siapae-icon-btn sidebar-toggle-button"
        x-on:click="toggleSidebar"
    >
 
        <span class="sr-only">Open main menu</span>
 
        <x-heroicon-o-menu
            x-show="!isSidebarOpen"
            aria-hidden="true"
            class="w-6 h-6"
        />
 
        <x-heroicon-o-x
            x-show="isSidebarOpen"
            aria-hidden="true"
            class="w-6 h-6"
        />
 
    </button>
 
</div>
 
