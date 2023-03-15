<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="flex">
            <div class="max-w-[400] mx-3">
            <div class="bg-white dark:bg-gray-800 overflow-y-scroll shadow-sm sm:rounded-lg max-h-[650px]">

                    @foreach($articles as $article)
                    <a href="{{$article->url}}">
                    <div class="bg-gray-200 m-3 p-1 rounded-lg dark:bg-gray-600">
                        <div class="mb-4">
                            <h2 class="text-2xl font-bold dark:text-white">{{ $article->title }}</h2>
                            <p class="text-gray-900">{{ $article->description }}</p>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="mx-3 max-w-screen">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-h-[650px]">
                    <iframe class="max-h-screen w-[1100px]"></iframe>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
