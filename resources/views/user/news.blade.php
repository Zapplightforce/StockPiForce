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

                    <a id="link" href="{{$article->url}}" class="article-link bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg max-w-sm mb-3">
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
                    <iframe id="target-iframe" class="max-h-screen w-[1100px]"></iframe>
                </div>
            </div>
    </div>
    </div>

    <script>
        document.querySelectorAll('.article-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const iframe = document.getElementById('target-iframe');
                const url = event.currentTarget.href;

                iframe.src = url;

                iframe.addEventListener('load', function() {
                    const style = window.getComputedStyle(document.body);
                    const isDarkMode = style.backgroundColor === 'rgb(34, 34, 34)';

                    if (isDarkMode) {
                        // Custom Dark Mode styles for the iframe
                        const darkModeStyles = `
                    body {
                        background-color: #222;
                        color: #fff;
                    }
                `;

                        const darkModeStyleElement = document.createElement('style');
                        darkModeStyleElement.innerHTML = darkModeStyles;
                        iframe.contentWindow.document.head.appendChild(darkModeStyleElement);
                    }

                    // Custom ad-blocker event
                    /*iframe.contentWindow.document.addEventListener('ad-blocker', function() {
                        console.log('Ad-blocker event triggered');
                        // Implement custom ad-blocking logic here
                    });*/
                });
            });
        });
    </script>

</x-app-layout>
