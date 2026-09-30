@props([
    'active' => false,
    'title' => ''
])

<style>
    .siapae-dropdown-wrapper {
        position: relative;
        width: 100%;
    }

    .siapae-dropdown-trigger {
        width: 100% !important;
        min-width: 0 !important;
    }

    .siapae-dropdown-trigger span {
        white-space: nowrap !important;
    }

    .siapae-dropdown-submenu {
        position: relative;
        width: 100%;
    }

    .siapae-dropdown-submenu ul {
        width: calc(100% - 20px);
    }
</style>

<div
    class="relative siapae-dropdown-wrapper"
    x-data="{ open: @json($active) }"
>

    <x-sidebar.link
        collapsible
        title="{{ $title }}"
        x-on:click="open = !open"
        isActive="{{ $active }}"
        class="siapae-dropdown-trigger"
    >
        @if ($icon ?? false)
            <x-slot name="icon">
                {{ $icon }}
            </x-slot>
        @endif
    </x-sidebar.link>

    <div
        class="siapae-dropdown-submenu"
        x-show="open && (isSidebarOpen || isSidebarHovered)"
        x-collapse
    >
        <ul
            class="relative px-0 pt-2 pb-0 ml-5 before:w-0 before:block before:absolute before:inset-y-0 before:left-0 before:border-l-2 before:border-l-gray-200 dark:before:border-l-gray-600"
        >
            {{ $slot }}
        </ul>
    </div>

</div>