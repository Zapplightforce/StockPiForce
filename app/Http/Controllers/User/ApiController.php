<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


class ApiController extends Controller
{
    public function TopNewsHeadlines()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://newsapi.org/v2/top-headlines?country=us&apiKey='. env('API_KEY'));
        $response = json_decode($response->getBody());
        return $response;
    }
}
