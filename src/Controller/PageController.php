<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Exceptions\NotFoundException;
use \App\Forms\SubscribeForm;
use \App\Models\Article;
use \App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        return new View('index', ['articles' => Article::front(), 'form' => new SubscribeForm()]);
    }

    public function about()
    {
        return new View('company.about', ['title' => 'About company']);
    }

    public function current(string $slug)
    {
        if ($page = Page::where('slug', $slug)->first()) {
            return new View('pages.current', ['page' => $page]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }
}
