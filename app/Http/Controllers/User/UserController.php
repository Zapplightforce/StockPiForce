<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function news()
    {
        $news = new ApiController();
        $articles = $news->TopNewsHeadlines()->articles;
        return view('user.news', compact('articles'));
    }


    public function fetchArticleContent(Request $request)
    {
        $url = $request->input('url');
        $decodedUrl = urldecode($url);

        // echo '<pre>';
        // echo '$decodedUrl: '.$decodedUrl;
        // echo '</pre>';
        // echo '<script>console.log("'.$decodedUrl.'")</script>';

        $cacheKey = 'article_content:' . md5($decodedUrl);
        $cacheTtl = 60 * 60; // Cache for 1 hour

        if (Cache::has($cacheKey)) {
            $content = Cache::get($cacheKey);
        } else {
            $client = new GuzzleClient();
            try {
                $response = $client->get($decodedUrl);
                $html = (string) $response->getBody();
                $crawler = new Crawler($html);

                // You need to inspect the target website and determine the appropriate CSS selector
                // In this example, I'm using a generic 'article' tag, but it may differ for each website
                $content = $crawler->filter('article')->html();
            } catch (\Exception $e) {
                // If there is an error, return an empty content with an error message
                return new JsonResponse(['content' => '', 'error' => 'Failed to fetch content']);
            }
            // Store the fetched content in the cache
            Cache::put($cacheKey, $content, $cacheTtl);
        }

        return new JsonResponse(['content' => $content]);
    }

}
