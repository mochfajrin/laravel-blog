@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center hover:text-red-900 text-sm text-red-700'
            : 'inline-flex items-center hover:text-red-900 text-sm text-gray-700';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>