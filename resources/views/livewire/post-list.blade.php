<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">
            @if ($this->activeCategory() || $search)
                <button wire:click='clearFilters()' class="text-gray-500 text-xs mr-3">X</button>
            @endif
            @if ($this->activeCategory())
                <x-badge wire:navigate href="{{ route('posts.index', ['category' => $this->activeCategory->slug]) }}"
                    :textColor="$this->activeCategory->text_color" :bgColor="$this->activeCategory->bg_color">{{ $this->activeCategory->title }}</x-badge>
            @endif
            @if ($search)
                <span class="ml-2">
                    {{ __('blog.containing') }} <strong> {{ $search }}</strong>
                </span>
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <x-label>{{ __('blog.filter.popular') }}</x-label>
            <x-checkbox wire:model.live='popular' />
            <button class="{{ $sort == 'desc' ? 'text-red-700 py-4 border-b border-red-800' : 'text-gray-500' }} py-4"
                wire:click='setSort("desc")'>{{ __('blog.filter.latest') }}</button>
            <button class="{{ $sort == 'asc' ? 'text-red-700 py-4 border-b border-red-800' : 'text-gray-500' }} py-4"
                wire:click='setSort("asc")'>{{ __('blog.filter.oldest') }}</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-post.post-item wire:key="{{ $post->id }}" :post="$post" />
        @endforeach
    </div>
    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
