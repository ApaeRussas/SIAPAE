<div
    class="flex items-center justify-between flex-shrink-0 px-3
           bg-transparent"
>

    {{-- =========================================================
         LOGO
         ========================================================= --}}
    <a
        href="{{ route('dashboard') }}"
        class="inline-flex items-center gap-3 min-w-0"
    >

        {{-- Logo oficial --}}
        <img
            src="https://apaerussas.com.br/assets/logo.png"
            alt="APAE Russas"
            class="flex-shrink-0 w-11 h-11 object-contain"
        >

        {{-- Nome da instituição --}}
        <div
            x-show="isSidebarOpen || isSidebarHovered"
            x-transition
            class="flex flex-col whitespace-nowrap"
        >

            <span
                class="text-base font-bold tracking-wide
                       text-[#1F513A]
                       dark:text-[#F5F1E8]"
            >
                APAE
            </span>

            <span
                class="text-xs font-medium tracking-wider
                       text-[#6F7D73]
                       dark:text-[#A8B9AE]"
            >
                RUSSAS - CE
            </span>

        </div>

        <span class="sr-only">
            APAE Russas - CE
        </span>

    </a>


    {{-- =========================================================
         BOTÃO DE RECOLHER / EXPANDIR SIDEBAR
         ========================================================= --}}
    <button
        type="button"
        x-on:click="toggleSidebar"
        class="
            flex items-center justify-center
            w-12 h-12
            rounded-xl

            bg-transparent
            border-0
            shadow-none

            text-[#5D7668]

            hover:bg-[#E8F0EA]
            hover:text-[#2F6B4F]

            focus:outline-none
            focus:ring-0
            focus:bg-transparent

            dark:bg-transparent
            dark:text-[#A8C0B0]

            dark:hover:bg-[#1D3A2C]
            dark:hover:text-[#D8B56A]

            dark:focus:bg-transparent

            transition-all duration-200
        "
        aria-label="Alternar menu lateral"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            class="w-7 h-7"
            aria-hidden="true"
        >

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4 6h16M4 12h10M4 18h16"
            />

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M16 9l3 3-3 3"
            />

        </svg>

    </button>

</div>