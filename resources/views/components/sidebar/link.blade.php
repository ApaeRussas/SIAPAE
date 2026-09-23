@props([
    'isActive' => false,
    'title' => '',
    'collapsible' => false,
    'maxW44' => null,
])
 
@php
    $classes = 'sp-link relative flex-shrink-0 flex items-center gap-3 p-2.5 rounded-xl overflow-hidden'
        . ($isActive ? ' is-active' : '')
        . ($collapsible ? ' w-full' : '');
@endphp
 
@if ($collapsible)
 
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
 
        @if ($icon ?? false)
            {{ $icon }}
        @else
            <x-icons.empty-circle class="flex-shrink-0 w-5 h-5" aria-hidden="true" />
        @endif
 
        <span
            class="text-sm whitespace-nowrap"
            x-show="isSidebarOpen || isSidebarHovered"
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
                class="absolute right-[7px] mt-[-5px] h-2 w-[2px] top-1/2 transition-all duration-200 bg-current opacity-60"
            ></span>
            <span
                :class="open ? 'rotate-45' : '-rotate-45'"
                class="absolute left-[7px] mt-[-5px] h-2 w-[2px] top-1/2 transition-all duration-200 bg-current opacity-60"
            ></span>
        </span>
 
    </button>
 
@else
 
    <a {{ $attributes->merge(['class' => $classes]) }}>
 
        @if ($icon ?? false)
            {{ $icon }}
        @else
            <x-icons.empty-circle class="flex-shrink-0 w-5 h-5" aria-hidden="true" />
        @endif
 
        @php
            $spanClasses = 'text-sm whitespace-nowrap' . (isset($maxW44) ? ' max-w-44' : '');
        @endphp
 
        <span class="{{ $spanClasses }}" x-show="isSidebarOpen || isSidebarHovered">
            {{ $title }}
        </span>
 
    </a>
 
@endif
 
