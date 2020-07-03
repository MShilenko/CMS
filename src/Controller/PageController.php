<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Exceptions\NotFoundException;
use \App\Forms\SubscribeForm;
use \App\Models\Article;
use \App\Models\Page;
use \App\Models\Subscribe;
use \App\Modules\ModelPagination;

class PageController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc');
        $pagination = new ModelPagination($articles);
        $modelWithPagination = $pagination->simplePaginate();

        return new View('index', ['articles' => $modelWithPagination, 'pagination' => $pagination->paginationCount(), 'form' => new SubscribeForm()]);
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

    public function unsubscribed(string $email)
    {
        $subscribe = new Subscribe();
        if ($subscribe->emailExists($email)) {
            $subscribe::where('email', $email)->delete();
            return new View('unsubscribed.index', ['email' => $email]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }
}
