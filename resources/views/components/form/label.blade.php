@props([
    'value',
    'sizeClass' => 'base',
])

@php
    $baseClasses = 'block font-medium text-gray-700 dark:text-gray-300 mb-1';

    switch ($sizeClass) {
        case 'sm':
            $sizeClasses = 'text-sm';
        break;
        case 'base':
            default:
            $sizeClasses = 'text-base';
        break;
    }

    $classes = $baseClasses . ' ' . $sizeClasses;
@endphp

<label {{ $attributes->merge(['class' => $classes]) }}>
    {{ $value ?? $slot }}
</label>