@props([
    'isActive' => false,
    'title' => '',
    'collapsible' => false,
    'maxW44' => null,
])

@php
    if ($isActive) {
        $isActiveClasses = '
            text-gray-700
            bg-blue-50
            shadow-sm
            hover:bg-blue-100
            dark:!text-gray-800
            dark:!bg-gray-100
            dark:hover:!bg-gray-200
        ';
    } else {
        $isActiveClasses = '
            text-gray-500
            hover:text-gray-700
            hover:bg-gray-100
            dark:text-gray-300
            dark:hover:text-white
            dark:hover:bg-dark-eval-2
        ';
    }

    $classes = '
        flex-shrink-0
        flex
        items-center
        gap-3
        p-2.5
        transition-all
        duration-200
        rounded-xl
        overflow-hidden
    ' . $isActiveClasses;

    if ($collapsible) {
        $classes .= ' w-full';
    }
@endphp

@if ($collapsible)

    <button
        type="button"
        {{ $attributes->merge(['class' => $classes]) }}
    >

        @if ($icon ?? false)
            {{ $icon }}
        @else
            <x-icons.empty-circle
                class="flex-shrink-0 w-5 h-5"
                aria-hidden="true"
            />
        @endif

        <span
            class="text-sm font-medium whitespace-nowrap"
            x-show="isSidebarOpen || isSidebarHovered"
            @if($isActive)
                style="color: #1f2937 !important;"
            @endif
        >
            {{ $title }}
        </span>

        <span
            x-show="isSidebarOpen || isSidebarHovered"
            aria-hidden="true"
            class="relative block ml-auto w-5 h-5"
        >
            <span
                :class="open ? '-rotate-45' : 'rotate-45'"
                class="
                    absolute
                    right-[7px]
                    bg-gray-400
                    dark:bg-gray-500
                    mt-[-5px]
                    h-2
                    w-[2px]
                    top-1/2
                    transition-all
                    duration-200
                "
            ></span>

            <span
                :class="open ? 'rotate-45' : '-rotate-45'"
                class="
                    absolute
                    left-[7px]
                    bg-gray-400
                    dark:bg-gray-500
                    mt-[-5px]
                    h-2
                    w-[2px]
                    top-1/2
                    transition-all
                    duration-200
                "
            ></span>
        </span>

    </button>

@else

    <a
        {{ $attributes->merge(['class' => $classes]) }}
    >

        @if ($icon ?? false)

            {{ $icon }}

        @else

            <x-icons.empty-circle
                class="flex-shrink-0 w-5 h-5"
                aria-hidden="true"
            />

        @endif

        @php
            $defaultSpanClasses = '
                text-sm
                font-medium
                whitespace-nowrap
            ';

            $addClasses = isset($maxW44)
                ? ' max-w-44'
                : '';

            $spanClasses = $defaultSpanClasses . $addClasses;
        @endphp

        <span
            class="{{ $spanClasses }}"
            x-show="isSidebarOpen || isSidebarHovered"
            @if($isActive)
                style="color: #1f2937 !important;"
            @endif
        >
            {{ $title }}
        </span>

    </a>

@endif