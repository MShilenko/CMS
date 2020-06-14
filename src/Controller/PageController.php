<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Forms\SubscribeForm;
use \App\Models\User;
use \App\Models\Article;
use \App\Models\Subscribe;
use \App\Core\ResponseAdapter;
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
        User::logout();
    }

    public function addSubscribe(array $request)
    {
        $success = '';
        $messages = [];
        $subscribe = new Subscribe();
        $form = new SubscribeForm($request, $subscribe::VALIDATE);

        if ($form->verify()) {
            try {
                $success = $messages['success'] = $subscribe->add($request);
            } catch (Exception $e) {
                $messages['modelError'] = $e->getMessage();
                $form->setError($e->getMessage());
            }
        }

        if ($form->hasErrors()) {
            $messages['errors'] = $form->getErrors();
        }

        return (new ResponseAdapter($messages))->json();
    }
}
