<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\ResponseAdapter;
use \App\Core\View;
use \App\Exceptions\NotFoundException;
use \App\Forms\RolesEditFrom;
use \App\Models\Article;
use \App\Models\User;
use \App\Modules\ModelRequestHelper;

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

    public function users()
    {
        $form = new RolesEditFrom();

        return new View('admin.user.index', ['users' => User::all(), 'form' => $form]);
    }

    public function editUser(array $request)
    {
        if ($user = User::find($request['userId'])) {
            $messages = [];
            $form = new RolesEditFrom($request);
            $form->setModel($user);

            $messages = (new ModelRequestHelper($request, $form, $user, 'editRoles'))->run();

            return (new ResponseAdapter($messages))->json();
        }

        throw new NotFoundException('Страница не найдена', 404);
    }
}
