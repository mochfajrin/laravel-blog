@props(['post'])
<div {{ $attributes }}>
    <a wire:navigate href="{{ route('posts.show', $post->id) }}"">
        <div>
            <img class="w-full rounded-xl h-72 object-cover" src="{{ $post->getThumbnailUrl() }}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-x-2">
            @if ($category = $post->categories()->first())
                <x-post.category-badge :category="$category" />
            @endif
            <p class="text-gray-500 text-sm">{{ $post->published_at }}</p>
        </div>
        <a wire:navigate href="{{ route('posts.show', $post->id) }}"
            class="text-xl font-bold text-gray-900">{{ $post->title }}</a>
    </div>

</div>
