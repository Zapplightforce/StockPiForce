<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


class NewsController extends Controller
{
    public function TopNewsHeadlines()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://newsapi.org/v2/top-headlines?country=us&apiKey='. env('NEWS_API_KEY'));
        $response = json_decode($response->getBody());
        return $response;
    }

    public function fetchArticle($title)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://newsapi.org/v2/everything?q='.$title.'&apiKey='. env('API_KEY'));
        $response = json_decode($response->getBody());

        $articles = $response->articles;
        $filteredArticle = null;

        foreach ($articles as $article) {
            if ($article->title === $title) {
                $filteredArticle = $article;
                break;
            }
        }

        return $filteredArticle;
    }

    public function fetchImageURL($query)
    {
        $apiKey = env('BING_API_KEY');
        $url = "https://api.bing.microsoft.com/v7.0/images/search?q=" . urlencode($query) . "&count=1&safeSearch=Strict";

        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $apiKey,
        ])->get($url);

        if ($response->ok()) {
            $data = $response->json();
            if (isset($data['value']) && count($data['value']) > 0) {
                return response()->json(['imageUrl' => $data['value'][0]['contentUrl']]);
            }
        }

        return response()->json(['error' => 'Image not found'], 404);
    }
}
