<footer class="text-sm space-x-4 flex items-center border-t border-gray-100 flex-wrap justify-center py-4 ">
    <a class="text-gray-500 hover:text-red-700" href="{{ route('home') }}">{{ __('menu.home') }}</a>
    <a class="text-gray-500 hover:text-red-700" href="{{ route('profile.show') }}">{{ __('menu.profile') }}</a>
    <a class="text-gray-500 hover:text-red-700" href="{{ route('posts.index') }}">{{ __('menu.blog') }}</a>
</footer>
