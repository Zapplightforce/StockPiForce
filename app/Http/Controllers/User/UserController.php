<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function news()
    {
        $news = new NewsController();
        $articles = $news->TopNewsHeadlines()->articles;
        return view('user.news', compact('articles'));
    }


    public function fetchArticleContent(Request $request)
    {
        $title = $request->input('title');

        $news = new NewsController();
        $article = $news->fetchArticle($title);

        if ($article) {
            if (!isset($article->urlToImage)) {
                $imageResponse = $news->fetchImageURL($article->title);
                $imageData = json_decode($imageResponse->getContent(), true);
                $article->urlToImage = $imageData['imageUrl'];
            }
            return response()->json($article);
        } else {
            return response()->json(['error' => 'Article not found'], 404);
        }
    }

}
