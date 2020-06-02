<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Exceptions\NotFoundException;
use \App\Models\Article;

class AdminController extends Controller
{
    public function index()
    {
        return new View('admin.index', ['title' => 'Admin panel']);
    }

    public function allArticles()
    {
        return new View('admin.article.all', ['articles' => Article::all()]);
    }

    public function article(string $slug)
    {
        if ($article = Article::where('slug', $slug)->first()) {
            return new View('admin.article.current', ['article' => $article]);
        }

        throw new NotFoundException('Страница не найдена', 404);
    }
}
