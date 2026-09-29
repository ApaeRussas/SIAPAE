@props([
    'disabled' => false,
    'readOnly' => false,
])
 
<input
    {{ $disabled ? 'disabled' : '' }}
    {{ $readOnly ? 'readOnly' : '' }}
    {!! $attributes->merge([
            'class' => 'siapae-input w-full text-sm',
        ])
    !!}
>
 
