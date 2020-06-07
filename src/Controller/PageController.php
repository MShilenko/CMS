<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Forms\SubscribeForm;
use \App\Models\Article;
use \App\Models\Subscribe;
use \Exception;

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

    public function logout()
    {
        \App\Models\User::logout();
    }

    public function addSubscribe(array $request)
    {
        $error = '';
        $subscribe = new Subscribe();
        $form = new SubscribeForm($request, $subscribe::VALIDATE);

        if ($form->verify()) {
            try {
                $subscribe->add($request);
            } catch (Exception $e) {
                $form->setError($e->getMessage());
            }
        }

        return new View('index', ['articles' => Article::front(), 'form' => $form]);
    }
}
