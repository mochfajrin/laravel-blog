@props(['author', 'size'])
@php
    $imageSize = match ($size ?? null) {
        'xs' => 'w-7 h-7',
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-14 h-14',
        default => 'w-7 h-7',
    };
    $textSize = match ($size ?? null) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-xl',
        default => 'text-sm',
    };
@endphp
<img class="{{ $imageSize }} rounded-full mr-3 object-cover" src="{{ $author->profile_photo_url }}"
    alt="{{ $author->name }}">
<span class="mr-1 {{ $textSize }}">{{ $author->name }}</span>
