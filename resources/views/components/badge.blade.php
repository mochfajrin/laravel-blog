@props(['textColor', 'bgColor'])
@php
    $textColor = match ($textColor) {
        'red' => 'text-red-700',
        'blue' => 'text-blue-700',
        'black' => 'text-black',
        'yellow' => 'text-yellow-600',
        'pink' => 'text-pink-700',
        'orange' => 'text-orange-400',
        'gray' => 'text-gray-700',
        'green' => 'text-green-700',
        'purple' => 'text-purple-700',
        'white' => 'text-white',
        default => 'text-white',
    };
    $bgColor = match ($bgColor) {
        'red' => 'bg-red-700',
        'blue' => 'bg-blue-700',
        'black' => 'bg-black',
        'yellow' => 'bg-yellow-400',
        'pink' => 'bg-pink-700',
        'orange' => 'bg-orange-400',
        'gray' => 'bg-gray-700',
        'green' => 'bg-green-700',
        'purple' => 'bg-purple-700',
        default => 'bg-gray-700',
    };
@endphp
<button {{ $attributes }}
    class="{{ $bgColor }}
        {{ $textColor }}
        rounded-xl px-3 py-1 text-base">
    {{ $slot }}
</button>
