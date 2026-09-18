@props([
    'isActive' => false,
    'title' => '',
    'collapsible' => false,
    'maxW44' => null,
])

@php
    if ($isActive) {
        $isActiveClasses = '
            text-[var(--primary-dark,#23543E)]
            bg-[var(--primary-light,#E7F0E9)]
            shadow-sm
            hover:bg-[var(--sage,#B8CCBD)]
            dark:!text-[var(--paper,#FFFDF9)]
            dark:!bg-[var(--primary,#2F6B4F)]
            dark:hover:!bg-[var(--primary-dark,#23543E)]
        ';
    } else {
        $isActiveClasses = '
            text-[var(--muted,#6E7A72)]
            hover:text-[var(--text,#243129)]
            hover:bg-[var(--cream,#F8F7F2)]
            dark:text-[var(--sage,#B8CCBD)]
            dark:hover:text-[var(--white,#FFFFFF)]
            dark:hover:bg-[var(--primary-dark,#23543E)]
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
                style="color: var(--primary-dark, #23543E) !important;"
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
                    bg-[var(--muted,#6E7A72)]
                    dark:bg-[var(--sage,#B8CCBD)]
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
                    bg-[var(--muted,#6E7A72)]
                    dark:bg-[var(--sage,#B8CCBD)]
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
                style="color: var(--primary-dark, #23543E) !important;"
            @endif
        >
            {{ $title }}
        </span>

    </a>

@endif