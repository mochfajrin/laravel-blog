<x-app-layout title='Home Page'>
    @section('hero')
        <div class="w-full text-center py-32">
            <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
                Welcome to <span class="text-red-700">Fajrin</span> <span class="text-gray-900"> News</span>
            </h1>
            <p class="text-gray-500 text-lg mt-2">Get News About Programming, Anime, Linux And Other Stuff</p>
            <a class="px-3 py-2 text-lg text-white bg-black rounded mt-5 inline-block" wire:navigate
                href="{{ route('posts.index') }}"><strong>Start Reading</strong>
            </a>
        </div>
    @endsection
    <div class="w-full mb-10">
        <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl text-red-700 font-bold">Featured Posts</h2>
            <div class="w-full">
                <div class="grid grid-cols-3 gap-10 w-full">
                    @foreach ($featuredPost as $post)
                        <x-post.post-card :post="$post" class="md:col-span-1 col-span-3" />
                    @endforeach
                </div>
            </div>
            <a class="mt-10 block text-center text-lg text-red-700 font-semibold" href="{{ route('posts.index') }}">More
                Posts</a>
        </div>
        <hr>

        <h2 class="mt-16 mb-5 text-3xl text-red-700 font-bold">Latest Posts</h2>
        <div class="w-full mb-5">
            <div class="grid grid-cols-3 gap-10 w-full">
                @foreach ($latestPost as $post)
                    <x-post.post-card :post="$post" class="md:col-span-1 col-span-3" />
                @endforeach
            </div>
        </div>
        <a class="mt-10 block text-center text-lg text-red-700 font-semibold" href="{{ route('posts.index') }}">More
            Posts</a>
    </div>
</x-app-layout>
