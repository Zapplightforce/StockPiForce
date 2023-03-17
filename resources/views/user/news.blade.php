<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="flex max-h-[calc(100vh-13rem)] mx-3 overflow-y-auto">
            <div class="flex flex-col w-1/3 h-800px overflow-y-scroll">

                @foreach($articles as $article)

                    <a id="link" href="/news/fetch-article-content/{{urlencode($article->url)}}" class="article-link bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-w-sm mb-3">
                        <div class="p-6">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{$article->title}}</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{$article->description}}</p>
                        </div>
                    </a>

                @endforeach
        </div>

            <div class="flex mx-3 max-w-screen">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-h-[650px]">
                    <div id="content-container" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-h-[650px]">
                        <!-- The fetched content will be displayed here -->
                    </div>
                </div>
            </div>
    </div>
    </div>

    {{--<script>
        document.querySelectorAll('.article-link').forEach(link => {
            link.addEventListener('click', async function(event) {
                event.preventDefault();
                const url = event.currentTarget.href;
                const encodedUrl = encodeURIComponent(url);
                const contentUrl = `/news/fetch-article-content/${encodedUrl}`;
                console.log('Fetching content from:', contentUrl);
                try {
                    const response = await fetch(contentUrl);
                    const responseText = await response.text();
                    console.log('Response status:', response.status);
                    console.log('Raw response text:', responseText); // Log the raw response text

                    const data = JSON.parse(responseText);

                    if (data.error) {
                        console.error('Error fetching content:', data.error);
                    } else {
                        const content = data.content;
                        // Display the content in a container on your page
                        document.getElementById('content-container').innerHTML = content;
                    }
                } catch (error) {
                    console.error('Error fetching content:', error);
                }
            });
        });
    </script>--}}


</x-app-layout>
