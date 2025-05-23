@props([
    'variant' => 'primary', // DIFERENTS TIUPUS
    'href' => null,
])

@php
    $baseClasses = 'inline-block px-4 py-2 rounded font-semibold focus:outline-none focus:ring transition';
    $variantClasses = match($variant) {
        'crear' => 'bg-green-600 hover:bg-green-700 text-white',
        'editar' => 'bg-yellow-600 hover:bg-yellow-700 text-white',
        'borrar' => 'bg-red-600 hover:bg-red-700 text-white',
        default => 'bg-gray-600 hover:bg-gray-700 text-white',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses $variantClasses"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => "$baseClasses $variantClasses"]) }}>
        {{ $slot }}
    </button>
@endif
