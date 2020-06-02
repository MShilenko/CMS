<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Models\Article;
use \App\Exceptions\NotFoundException;

class ArticleController extends Controller
{
    public function article(string $slug)
    {
        if ($article = Article::where('slug', $slug)->first()) {
            return new View('article.current', ['article' => $article]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }
}