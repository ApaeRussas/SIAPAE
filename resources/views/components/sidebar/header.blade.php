<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Logo -->
    <a
        href="{{ route('dashboard') }}"
        class="inline-flex items-center gap-2"
    >

        <x-application-mini-light-logo    
            x-show="!isSidebarOpen && !isDarkMode"
            aria-hidden="true" 
            class="mini-logo" />
        <x-application-mini-dark-logo    
        x-show="!isSidebarOpen && isDarkMode"
        aria-hidden="true" 
        class="mini-logo" /> 
        <x-application-logo-light
            x-show="isSidebarOpen && !isDarkMode" 
            class="h-logo" /> 
        <x-application-logo-dark 
            x-show="isSidebarOpen && isDarkMode" 
            class="h-logo" />

        <span class="sr-only">Dashboard</span>
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
