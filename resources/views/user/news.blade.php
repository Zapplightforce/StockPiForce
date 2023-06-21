<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="grid grid-cols-4 mx-3 overflow-y-auto">
            <div class="col-span-1 h-[calc(100vh-13rem)] overflow-y-scroll">

                @foreach($articles as $article)
                <div class="flex flex-col justify-center items-center mb-3">
                    <a class="article-link" href="">
                            <h5 class="text-xl font-bold tracking-tight dark:text-white">
                                {{$article->title}}</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">{{$article->description}}</p>
                    </a>
                </div>
                @endforeach
        </div>

            <div class="col-span-3 mx-3">
                <div id="content-container" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg h-[calc(100vh-13rem)] fixed-size-container w-full overflow-y-scroll py-5">
                        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                            <div id="spinner" class="loader"></div>
                            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                                <header class="mb-4 lg:mb-6 not-format">
                                    <address class="flex items-center mb-6 not-italic">
                                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                            <img id="favicon" class="mr-4 w-16 h-16 rounded-full" src="" alt="Favicon">
                                            <div>
                                                <p id="author" class="text-xl font-bold text-gray-900 dark:text-white"></p>
                                                <p id="sourceName" class="text-base font-light text-gray-500 dark:text-gray-400"></p>
                                                <p id="publishedAt" class="text-base font-light text-gray-500 dark:text-gray-400"></p>
                                            </div>
                                        </div>
                                    </address>
                                    <h1 id="title" class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white"></h1>
                                </header>
                                <p id="description" class="lead text-base font-bold text-gray-500 dark:text-gray-400 "></p>
                                <img id="image" src="" alt="article image">
                                <p id="content" class="text-base font-light text-gray-500 dark:text-gray-400"></p>
                                <a id="read-more" href="" target="_blank" class="text-base font-light text-blue-500 dark:text-blue-400">Read more ...</a>
                            </article>
                        </div>
                </div>
            </div>
    </div>
    </div>

    <script>
        function stripHTML(html) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            return doc.body.textContent || '';
        }

        async function fetchImageURL(title) {
            const response = await fetch(`/news/fetch-image-url?title=${encodeURIComponent(title)}`);

            if (response.ok) {
                const data = await response.json();
                return data.imageUrl;
            }

            return null;
        }
        async function displayArticle(data) {
            const faviconElement = document.getElementById('favicon');
            const authorElement = document.getElementById('author');
            const sourceNameElement = document.getElementById('sourceName');
            const publishedAtElement = document.getElementById('publishedAt');
            const titleElement = document.getElementById('title');
            const descriptionElement = document.getElementById('description');
            const imageElement = document.getElementById('image');
            const contentElement = document.getElementById('content');
            const anchorElement = document.getElementById('read-more');

            // Fetch favicon
            function getHostname(url) {
                const a = document.createElement('a');
                a.href = url;
                return a.hostname;
            }
            async function fetchFavicon(url) {
                const hostname = getHostname(url);
                return `https://logo.clearbit.com/${hostname}`;
            }
            faviconElement.src = await fetchFavicon(data.url);

            // Display author or generate a generic one
            authorElement.textContent = data.author || 'Unknown Author';

            // Display source name
            sourceNameElement.textContent = data.source.name;

            // Display published at or generate a generic date
            const publishedAtDate = data.publishedAt ? new Date(data.publishedAt) : new Date();
            publishedAtElement.textContent = publishedAtDate.toLocaleString();

            // Display title
            titleElement.textContent = data.title;

            // Display description
            descriptionElement.textContent = stripHTML(data.description);

            // Display image or fetch the first image suggested by Google
            if (data.urlToImage) {
                imageElement.src = data.urlToImage;
            } else {
                imageElement.src = await fetchImageURL(data.title);
            }

            // Display content
            const strippedContent = stripHTML(data.content);
            contentElement.textContent = strippedContent;

            anchorElement.href = stripHTML(data.url);
        }

        document.querySelectorAll('.article-link').forEach(link => {
            link.addEventListener('click', async function(event) {
                event.preventDefault();

                // Show spinner
                const spinnerElement = document.getElementById('spinner');
                spinnerElement.style.display = 'block';

                let title = event.currentTarget.querySelector('h5').textContent;
                title = title.trim();
                const fetchUrl = `/news/fetch-article-content?title=${encodeURIComponent(title)}`;

                const response = await fetch(fetchUrl);

                if (response.ok) {
                    const data = await response.json();

                    // Hide spinner before displaying the article
                    spinnerElement.style.display = 'none';

                    displayArticle(data);
                } else {
                    console.log('Error fetching article content');

                    // Hide spinner in case of an error
                    spinnerElement.style.display = 'none';
                }
            });
        });


        // Automatically load the first article
        document.querySelector('.article-link').click();

    </script>



</x-app-layout>
