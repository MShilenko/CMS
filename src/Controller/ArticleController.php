<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Exceptions\NotFoundException;
use \App\Models\Article;
use \App\Forms\CommentForm;

class ArticleController extends Controller
{
    public function article(string $slug)
    {
        if ($article = Article::where('slug', $slug)->first()) {
            $form = new CommentForm();

            return new View('article.current', ['article' => $article, 'form' => $form]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }
}
