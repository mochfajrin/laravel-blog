<x-app-layout title='Home Page'>
    @section('hero')
        <div class="w-full text-center py-32">
            <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
                {{ __('home.hero.title') }} <span class="text-red-700">Fajrin</span> <span class="text-gray-900"> News</span>
            </h1>
            <p class="text-gray-500 text-lg mt-2">{{ __('home.hero.desc') }}</p>
            <a class="px-3 py-2 text-lg text-white bg-black rounded mt-5 inline-block" wire:navigate
                href="{{ route('posts.index') }}"><strong>{{ __('home.hero.cta') }}</strong>
            </a>
        </div>
    @endsection
    <div class="w-full mb-10">
        <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl text-red-700 font-bold">{{ __('home.featured_posts') }}</h2>
            <div class="w-full">
                <div class="grid grid-cols-3 gap-10 w-full">
                    @foreach ($featuredPost as $post)
                        <x-post.post-card :post="$post" class="md:col-span-1 col-span-3" />
                    @endforeach
                </div>
            </div>
            <a class="mt-10 block text-center text-lg text-red-700 font-semibold"
                href="{{ route('posts.index') }}">{{ __('home.more_posts') }}</a>
        </div>
        <hr>

        <h2 class="mt-16 mb-5 text-3xl text-red-700 font-bold">{{ __('home.latest_posts') }}</h2>
        <div class="w-full mb-5">
            <div class="grid grid-cols-3 gap-10 w-full">
                @foreach ($latestPost as $post)
                    <x-post.post-card :post="$post" class="md:col-span-1 col-span-3" />
                @endforeach
            </div>
        </div>
        <a class="mt-10 block text-center text-lg text-red-700 font-semibold"
            href="{{ route('posts.index') }}">{{ __('home.more_posts') }}</a>
    </div>
</x-app-layout>
