<nav
    aria-label="secondary"
    x-data="{ open: false }"
    class="
        sticky
        top-0
        z-10
        flex
        items-center
        justify-between
        h-20
        px-5
        sm:px-7

        bg-white
        border-b
        border-[#E4E8E2]
        shadow-sm

        dark:bg-[#10251B]
        dark:border-[#294236]

        transition-transform
        duration-500
    "
    :class="{
        '-translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }"
>

    <!-- ==========================================================
         LADO ESQUERDO
         ========================================================== -->

    <div class="flex items-center gap-3">

        <!-- Tema no mobile -->
        <x-button
            type="button"
            class="
                md:hidden
                !rounded-xl
                !border
                !border-[#DCE5DE]
                !bg-[#F4F7F4]
                !text-[#2F6B4F]

                hover:!bg-[#E8F0EA]
                hover:!border-[#C8D8CC]

                dark:!border-[#294236]
                dark:!bg-[#173126]
                dark:!text-[#D8B56A]

                dark:hover:!bg-[#1E3A2C]

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
                class="w-5 h-5 text-[#2F6B4F] dark:text-[#D8B56A]"
            />

            <x-heroicon-o-sun
                x-show="isDarkMode"
                aria-hidden="true"
                class="w-5 h-5 text-[#D8B56A]"
            />

        </x-button>

    </div>


    <!-- ==========================================================
         LADO DIREITO
         ========================================================== -->

    <div class="flex items-center gap-3 sm:gap-4">

        <!-- ======================================================
             BOTÃO TEMA
             ====================================================== -->

        <x-button
            type="button"
            class="
                hidden
                md:inline-flex
                !w-11
                !h-11
                !rounded-xl

                !border
                !border-[#DCE5DE]
                !bg-[#F4F7F4]
                !text-[#2F6B4F]

                hover:!bg-[#E8F0EA]
                hover:!border-[#C8D8CC]

                dark:!border-[#294236]
                dark:!bg-[#173126]
                dark:!text-[#D8B56A]

                dark:hover:!bg-[#1E3A2C]
                dark:hover:!border-[#3B604B]

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
                class="w-5 h-5 text-[#2F6B4F] dark:text-[#D8B56A]"
            />

            <x-heroicon-o-sun
                x-show="isDarkMode"
                aria-hidden="true"
                class="w-5 h-5 text-[#D8B56A]"
            />

        </x-button>


        <!-- ======================================================
             USUÁRIO
             ====================================================== -->

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

                        hover:bg-[#F1F5F2]

                        focus:outline-none
                        focus:ring-2
                        focus:ring-[#2F6B4F]/20

                        dark:hover:bg-[#173126]
                        dark:focus:ring-[#D8B56A]/30
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

                            bg-[#E8F0EA]
                            border
                            border-[#C8D8CC]

                            dark:bg-[#173126]
                            dark:border-[#3B604B]
                        "
                    >

                        <svg
                            class="
                                w-5
                                h-5
                                text-[#2F6B4F]

                                dark:text-[#8FC5A5]
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

                                text-[#7A867E]

                                dark:text-[#91A197]
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

                                text-[#1B4632]

                                dark:text-[#F5F1E8]
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

                            text-[#7A867E]

                            transition-all
                            duration-200

                            group-hover:text-[#2F6B4F]

                            dark:text-[#91A197]
                            dark:group-hover:text-[#D8B56A]
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


            <!-- ==================================================
                 MENU DO USUÁRIO
                 ================================================== -->

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


<!-- ==========================================================
     BARRA INFERIOR MOBILE
     ========================================================== -->

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
        border-t
        border-[#E4E8E2]
        shadow-lg

        dark:bg-[#10251B]
        dark:border-[#294236]

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
        class="
            sidebar-toggle-button

            !rounded-xl

            !border
            !border-[#DCE5DE]

            !bg-[#F4F7F4]
            !text-[#2F6B4F]

            hover:!bg-[#E8F0EA]
            hover:!border-[#C8D8CC]

            dark:!border-[#294236]
            dark:!bg-[#173126]
            dark:!text-[#D8B56A]

            dark:hover:!bg-[#1E3A2C]

            transition-all
            duration-200
        "
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