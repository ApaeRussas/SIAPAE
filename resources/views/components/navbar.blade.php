<nav
    aria-label="secondary"
    x-data="{ open: false }"
    class="
        sticky top-0 z-10
        flex items-center justify-between
        h-20
        px-5 sm:px-7
        bg-white dark:bg-dark-eval-1
        shadow-sm dark:shadow-black/10
        transition-transform duration-500
    "
    :class="{
        '-translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }"
>

    <!-- LADO ESQUERDO -->
    <div class="flex items-center gap-3">

        <!-- Tema no mobile -->
        <x-button
            type="button"
            class="
                md:hidden
                !rounded-xl
                !border-0
                !bg-gray-50
                dark:!bg-dark-eval-2
                hover:!bg-gray-100
                dark:hover:!bg-dark-eval-3
            "
            icon-only
            variant="secondary"
            sr-text="Toggle dark mode"
            x-on:click="toggleTheme"
        >
            <x-heroicon-o-moon
                x-show="!isDarkMode"
                aria-hidden="true"
                class="w-5 h-5 text-gray-500 dark:text-gray-400"
            />

            <x-heroicon-o-sun
                x-show="isDarkMode"
                aria-hidden="true"
                class="w-5 h-5 text-gray-400"
            />
        </x-button>

    </div>


    <!-- LADO DIREITO -->
    <div class="flex items-center gap-3 sm:gap-4">

        <!-- BOTÃO TEMA -->
        <x-button
            type="button"
            class="
                hidden md:inline-flex
                !w-11
                !h-11
                !rounded-xl
                !border-0
                !bg-gray-50
                dark:!bg-dark-eval-2
                hover:!bg-gray-100
                dark:hover:!bg-dark-eval-3
                transition-all
                duration-200
            "
            icon-only
            variant="secondary"
            sr-text="Toggle dark mode"
            x-on:click="toggleTheme"
        >

            <x-heroicon-o-moon
                x-show="!isDarkMode"
                aria-hidden="true"
                class="w-5 h-5 text-gray-500 dark:text-gray-400"
            />

            <x-heroicon-o-sun
                x-show="isDarkMode"
                aria-hidden="true"
                class="w-5 h-5 text-gray-400"
            />

        </x-button>


        <!-- USUÁRIO -->
        <x-dropdown align="right" width="48">

            <x-slot name="trigger">

                <button
                    class="
                        group
                        flex
                        items-center
                        gap-3
                        pl-2
                        pr-3
                        py-1.5
                        rounded-xl
                        transition-all
                        duration-200
                        hover:bg-gray-50
                        dark:hover:bg-dark-eval-2
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-200/70
                        dark:focus:ring-gray-700
                    "
                >

                    <!-- Avatar -->
                    <div
                        class="
                            flex
                            items-center
                            justify-center
                            w-9
                            h-9
                            rounded-full
                            bg-gray-100
                            dark:bg-dark-eval-3
                            border
                            border-gray-200/70
                            dark:border-gray-700/60
                        "
                    >

                        <svg
                            class="
                                w-5
                                h-5
                                text-gray-500
                                dark:text-gray-400
                            "
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


                    <!-- NOME -->
                    <div
                        class="
                            hidden
                            sm:flex
                            flex-col
                            items-start
                            justify-center
                            leading-tight
                        "
                    >

                        <span
                            class="
                                text-[11px]
                                font-medium
                                text-gray-400
                                dark:text-gray-500
                            "
                        >
                            Usuário
                        </span>

                        <span
                            class="
                                max-w-[130px]
                                truncate
                                text-sm
                                font-semibold
                                text-gray-700
                                dark:text-gray-200
                            "
                        >
                            {{ Auth::user()->name }}
                        </span>

                    </div>


                    <!-- SETA -->
                    <svg
                        class="
                            w-4
                            h-4
                            text-gray-400
                            transition-all
                            duration-200
                            group-hover:text-gray-600
                            dark:group-hover:text-gray-300
                        "
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


            <!-- MENU DO USUÁRIO -->
            <x-slot name="content">

                <!-- Perfil -->
                <x-dropdown-link
                    :href="route('profile.edit')"
                >
                    {{ __('Profile') }}
                </x-dropdown-link>


                <!-- Coordenador -->
                @canany(['coordinator-view', 'admin-view'])

                    <x-dropdown-link
                        :href="route('coordinator.index')"
                    >
                        {{ __('Users Table') }}
                    </x-dropdown-link>

                @endcanany


                <!-- Administrador -->
                @can('admin-view')

                    <x-dropdown-link
                        :href="route('admin.index')"
                    >
                        {{ __('Admin') }}
                    </x-dropdown-link>

                @endcan


                <!-- Logout -->
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
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


<!-- ========================================================== -->
<!-- BARRA INFERIOR MOBILE -->
<!-- ========================================================== -->

<div
    class="
        fixed
        inset-x-0
        bottom-0
        flex
        items-center
        justify-between
        px-4
        py-3
        sm:px-6
        bg-white
        dark:bg-dark-eval-1
        border-t
        border-gray-100/70
        dark:border-gray-800/60
        shadow-lg
        dark:shadow-black/20
        md:hidden
        z-10
        transition-transform
        duration-500
    "
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
    <x-button
        type="button"
        icon-only
        variant="secondary"
        sr-text="Open main menu"
        x-on:click="toggleSidebar"
        class="sidebar-toggle-button !rounded-xl !border-0"
    >

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

    </x-button>

</div>