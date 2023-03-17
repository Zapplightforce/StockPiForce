<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\JsonResponse;

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

    public function fetchArticleContent($url)
    {
        $decodedUrl = urldecode($url);

        echo '<pre>';
        echo '$decodedUrl: '.$decodedUrl;
        echo '</pre>';
        echo '<script>console.log("'.$decodedUrl.'")</script>';

        $client = new Client();
        $crawler = $client->request('GET', $decodedUrl);

        // You need to inspect the target website and determine the appropriate CSS selector
        // In this example, I'm using a generic 'article' tag, but it may differ for each website
        try {
            $content = $crawler->filter('article')->html();
        } catch (\Exception $e) {
            // If there is an error, return an empty content with an error message
            return new JsonResponse(['content' => '', 'error' => 'Failed to fetch content']);
        }

        return new JsonResponse(['this just worked']);
        /*return new JsonResponse(['content' => $content]);*/
    }

}
