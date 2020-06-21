<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\ResponseAdapter;
use \App\Core\View;
use \App\Exceptions\NotFoundException;
use \App\Forms\ArticleEditForm;
use \App\Forms\ArticleSwitchPublicationForm;
use \App\Forms\RolesEditFrom;
use \App\Forms\SubscribeSwitchPublicationForm;
use \App\Models\Article;
use \App\Models\Subscribe;
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
        $form = new ArticleSwitchPublicationForm();

        return new View('admin.article.all', ['articles' => Article::withTrashed()->get(), 'form' => $form]);
    }

    public function subscribes()
    {
        $form = new SubscribeSwitchPublicationForm();

        return new View('admin.subscribes.index', ['subscribes' => Subscribe::all(), 'form' => $form]);
    }

    public function article(int $id)
    {
        if ($article = Article::withTrashed()->find($id)) {
            $form = new ArticleEditForm();
            $form->setModel($article);

            return new View('admin.article.current', ['article' => $article, 'form' => $form]);
        }

        throw new NotFoundException('Страница не найдена', 404);
    }

    public function editArticle(int $id, array $request, array $files)
    {
        if ($article = Article::withTrashed()->find($id)) {
            $messages = [];
            $request['imageName'] = $files['image']['name'];
            $request['image'] = $files['image']['tmp_name'];
            $form = new ArticleEditForm($request, $article::EDIT_VALIDATE);
            $form->setModel($article);

            $messages = (new ModelRequestHelper($request, $form, $article, 'edit'))->run();

            return (new ResponseAdapter($messages))->json();
        }

        throw new NotFoundException('Страница не найдена', 404);
    }

    public function toggleArticle(array $request)
    {
        $article = Article::withTrashed()->find($request['articleId']);
        if ($article->trashed()) {
            $article->restore();
        } else {
            $article->delete();
        }

        return (new ResponseAdapter([ARTICLE_SWITCH]))->json();
    }

    public function deleteSubscribe(array $request)
    {
        Subscribe::find($request['subscribeId'])->delete();

        return (new ResponseAdapter([SUBSCRIBE_DELETE]))->json();
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
