<footer class="text-sm px-6 flex items-center border-t border-gray-100 flex-wrap justify-between py-4 ">
    <div class="space-x-4">
        <a class="text-gray-500 hover:text-red-700" href="{{ route('home') }}">{{ __('menu.home') }}</a>
        <a class="text-gray-500 hover:text-red-700" href="{{ route('profile.show') }}">{{ __('menu.profile') }}</a>
        <a class="text-gray-500 hover:text-red-700" href="{{ route('posts.index') }}">{{ __('menu.blog') }}</a>
    </div>
    <div class="flex gap-2">
        @foreach (config('app.supported_locales') as $locale => $data)
            <a href="{{ route('language', ['locale' => $locale]) }}">
                <x-dynamic-component :component="'flag-country-' . $data['icon']" class="w6 h-6" />
            </a>
        @endforeach
    </div>
</footer>
