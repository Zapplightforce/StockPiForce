<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

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
}
