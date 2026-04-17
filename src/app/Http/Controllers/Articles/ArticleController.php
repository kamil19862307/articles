<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index');
    }

    public function show(string $slug)
    {
        $article = Article::whereSlug($slug)->with('partner')->firstOrFail();

        return view('articles.show', compact('article'));
    }
}
