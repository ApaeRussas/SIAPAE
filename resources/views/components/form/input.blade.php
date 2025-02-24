@props([
    'disabled' => false,
    'withicon' => false,
    'small' => null,
])

@php
    $withiconClasses = $withicon ? 'pl-11 pr-4' : '';
    if($small) { $sizeClasses = 'py-0.5 w-36 text-xs';}
    else { $sizeClasses = 'py-2'; } 
@endphp

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
            'class' => $withiconClasses . ' ' . $sizeClasses . ' max-w-full border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:focus:ring-offset-dark-eval-1',
        ])
    !!}
>
