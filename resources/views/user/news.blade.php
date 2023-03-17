<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="grid grid-cols-3 max-h-[calc(100vh-13rem)] mx-3 overflow-y-auto">
            <div class="col-span-1 h-800px overflow-y-scroll">

                @foreach($articles as $article)

                    <a id="link" href="{{$article->url}}" class="article-link bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-w-sm mb-3">
                        <div class="p-6">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{$article->title}}</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{$article->description}}</p>
                        </div>
                    </a>

                @endforeach
        </div>

            <div class="col-span-2 mx-3">
                <div id="content-container" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-h-[650px] fixed-size-container w-full">
                    <!-- The fetched content will be displayed here -->
                </div>
            </div>
    </div>
    </div>

    <script>
        function extractText(html) {
            const div = document.createElement('div');
            div.innerHTML = html;
            const images = div.getElementsByTagName('img');
            while (images.length) {
                images[0].parentNode.removeChild(images[0]);
            }
            return div.innerText;
        }

        document.querySelectorAll('.article-link').forEach(link => {
            link.addEventListener('click', async function(event) {
                event.preventDefault();
                const url = event.currentTarget.href;
                const encodedUrl = encodeURIComponent(url);
                const fetchUrl = `/news/fetch-article-content?url=${encodedUrl}`;

                fetch(fetchUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error('Error fetching content:', data.error);
                        } else {
                            const content = data.content;
                            // Display the content in a container on your page
                            document.getElementById('content-container').innerHTML = content;
                        }
                    });
            });
        });

        // Automatically load the first article
        document.querySelector('.article-link').click();
    </script>



</x-app-layout>
