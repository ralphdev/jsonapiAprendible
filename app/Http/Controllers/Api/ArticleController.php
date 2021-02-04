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
        //sort=-title,content

        $sortFields = Str::of(request('sort'))->explode(',');
        $articleQuery = Article::query();

        foreach ($sortFields as $sortField) {

            $direction = 'asc';

            if(Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortField = Str::of($sortField)->substr(1);
            }
            $articleQuery->orderBy($sortField, $direction);
        }

        return ArticleCollection::make( $articleQuery->get() );
    }

    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }
}
