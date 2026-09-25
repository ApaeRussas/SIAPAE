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
 
    $colorText = $isShow == true
        ? 'siapae-label siapae-label--muted'
        : 'siapae-label';
 
    $classes = $baseClasses . ' ' . $sizeClasses . ' ' . $colorText;
@endphp
 
<label {{ $attributes->merge(['class' => $classes]) }}>
    {{ $value ?? $slot }}
</label>
 
