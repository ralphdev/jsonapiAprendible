<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Article;

class ArticleController extends Controller
{
    
    public function index()
    {
        $articles = Article::applySorts(request('sort'))->get();

        return ArticleCollection::make( $articles );
    }

    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }
}
