@props([
    'variant' => 'primary',
    'iconOnly' => false,
    'srText' => '',
    'href' => false,
    'button' => false,
    'size' => 'base',
    'disabled' => false,
    'pill' => false,
    'squared' => false,
    'bg' => 'bg-white ',
])

@php

    $baseClasses = 'inline-flex items-center font-medium select-none disabled:cursor-not-allowed focus:outline-none focus:ring-offset-2 focus:ring-offset-white ';

    switch ($variant) {
        case 'primary':
            $variantClasses = 'bg-gray-700 text-white hover:text-white  hover:bg-gray-900 focus:ring focus:ring-gray-500 ';
        break;
        case 'secondary':
            $variantClasses = 'bg-white text-gray-500 hover:bg-gray-100 focus:ring focus:ring-gray-500    ';
        break;
        case 'success':
            $variantClasses = 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500   ';
        break;
        case 'danger':
            $variantClasses = 'bg-red-600 text-white hover:bg-red-700   focus:ring-red-700';
        break;
        case 'warning':
            $variantClasses = 'bg-yellow-400 text-white hover:bg-yellow-500   focus:ring focus:ring-yellow-400 ';
        break;
        case 'blue':
            $variantClasses = 'bg-blue-500 text-white hover:bg-blue-600   focus:ring focus:ring-blue-500 ';
        break;
        case 'black':
            $variantClasses = 'bg-black text-gray-300 hover:text-white hover:bg-gray-800 focus:ring focus:ring-black ';
        break;
        case 'excel':
            $variantClasses = $bg.' py-2 text-gray-900 border border-gray-300 hover:border-green-600   text-black hover:text-white hover:bg-green-600 focus:ring focus:ring-green-600   ';
        break;
        case 'pdf-trash':
            $variantClasses = $bg.' text-gray-900 border border-gray-300 hover:border-red-600   text-black hover:text-white hover:bg-red-600 focus:ring focus:ring-red-700   ';
        break;
        case 'edit':
            $variantClasses = $bg.' border border-gray-300 hover:border-yellow-400 hover:bg-yellow-400 focus:ring focus:ring-yellow-500     ';
        break;
        case 'restore':
            $variantClasses = $bg.' border border-gray-300 hover:border-blue-600 hover:bg-blue-600 hover:text-white focus:ring focus:ring-blue-600     ';
        break;
        case 'restart':
            $variantClasses = 'bg-gray-100  border border-gray-300 hover:border-gray-300 hover:bg-gray-200 focus:ring focus:ring-gray-300 text-gray-800     ';
        break;
        case 'question':
            $variantClasses = 'bg-gray-100  hover:bg-gray-200 text-blue-500 hover:text-blue-600   ';
        break;
        default:
            $variantClasses = 'bg-gray-300 text-white hover:bg-gray-600 focus:ring focus:ring-gray-500';
        }

    switch ($size) {
        case 'hyper-sm':
            $sizeClasses = $iconOnly ? 'p-1' : 'px-1.5 py-1 text-sm';
        break;
        case 'sm':
            $sizeClasses = $iconOnly ? 'p-1.5' : 'px-2.5 py-1.5 text-sm';
        break;
        case 'base':
            $sizeClasses = $iconOnly ? 'p-2' : 'px-4 py-2 text-base';
        break;
        case 'lg':
        default:
            $sizeClasses = $iconOnly ? 'p-3' : 'px-5 py-2 text-xl';
        break;
    }

    $classes = $baseClasses . ' ' . $sizeClasses . ' ' . $variantClasses . ' transition duration-300 ease-in-out';

    if(!$squared && !$pill){
        $classes .= ' rounded-md';
    } else if ($pill) {
        $classes .= ' rounded-full';

    }

@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </a>
@elseif ($button)
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
        {{ $slot }}
        @if($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </button>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
        @if($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </button>
@endif
