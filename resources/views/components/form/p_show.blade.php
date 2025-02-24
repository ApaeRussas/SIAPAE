@props([
    'sizeFont' => 'base',
])

@php
    $baseClasses = 'border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 font-normal dark:text-gray-300 rounded-lg';

    switch ($sizeFont) {
        case 'sm':
            $sizeClasses = 'text-sm px-3 py-1';
        break;
        case 'base':
        default:
            $sizeClasses = 'text-base px-3 py-2';
        break;
    }

    $classes = $baseClasses . ' ' . $sizeClasses;
@endphp

<p 
    {!! $attributes->merge([
            'class' => $classes
        ])
    !!}>
    {{$slot}}
</p>