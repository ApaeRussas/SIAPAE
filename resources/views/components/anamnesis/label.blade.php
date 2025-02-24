@props([
    'value', 
    'isShow' => false,
    'sizeFont' => 'base'
])

@php
    $baseClasses = 'block font-medium';

    switch ($sizeFont) {
        case 'sm':
            $sizeClasses = 'text-sm';
        break;
        case 'base':
        default:
            $sizeClasses = 'text-base py-2';
        break;
    }
    
    if($isShow == true) {
        $colorText = "dark:text-gray-400 text-gray-700";
    } else {
        $colorText = "text-gray-700 dark:text-gray-300";
    }

    $classes = $baseClasses . ' ' . $sizeClasses . ' ' . $colorText;
@endphp

<label {{ $attributes->merge(['class' => $classes]) }}>
    {{ $value ?? $slot }}
</label>