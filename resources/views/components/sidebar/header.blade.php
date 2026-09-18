<div class="flex items-center justify-between flex-shrink-0 px-3">

    <!-- Logo -->
    <a
        href="{{ route('dashboard') }}"
        class="inline-flex items-center gap-3 min-w-0"
    >

        <!-- Logo oficial -->
        <img
            src="https://apaerussas.com.br/assets/logo.png"
            alt="APAE Russas"
            class="flex-shrink-0 w-11 h-11 object-contain"
        >

        <!-- Nome da instituição -->
        <div
            x-show="isSidebarOpen || isSidebarHovered"
            x-transition
            class="flex flex-col whitespace-nowrap"
        >
            <span class="text-base font-bold tracking-wide text-gray-700 dark:text-gray-200">
                APAE
            </span>

            <span class="text-xs font-medium tracking-wider text-gray-500 dark:text-gray-400">
                RUSSAS - CE
            </span>
        </div>

        <span class="sr-only">APAE Russas - CE</span>
    </a>

    <!-- Toggle button -->
    <x-button
        type="button"
        icon-only
        sr-text="Toggle sidebar"
        variant="secondary"
        x-show="isSidebarOpen || isSidebarHovered"
        x-on:click="toggleSidebar"
    >
        <x-icons.menu-fold-right
            x-show="!isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-icons.menu-fold-left
            x-show="isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-heroicon-o-x
            aria-hidden="true"
            class="w-6 h-6 lg:hidden"
        />
    </x-button>

</div>