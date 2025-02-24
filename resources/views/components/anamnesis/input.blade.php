@props([
    'disabled' => false,
    'readOnly' => false,
])

<input
    {{ $disabled ? 'disabled' : '' }}
    {{ $readOnly ? 'readOnly' : '' }}
    {!! $attributes->merge([
            'class' => 'w-full py-1 border-gray-400 rounded-md focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1
            shadow-sm text-sm disabled:bg-gray-100 dark:disabled:bg-dark-eval-0 disabled:text-gray-500 disabled:border-gray-400 dark:text-gray-400',
        ])
    !!}
>
