<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\ResponseAdapter;
use \App\Forms\CommentForm;
use \App\Models\Article;
use \App\Models\Comment;
use \App\Models\User;

class CommentController extends Controller
{
    public function add(string $slug, array $request)
    {
        $messages = [];

        if ($article = Article::where('slug', $slug)->first()) {
            $success = '';
            $user = User::find($_SESSION['userId']);
            $comment = new Comment();
            $form = new CommentForm($request, $comment::VALIDATE);

            if ($form->verify()) {
                try {
                    $success = $messages['success'] = $comment->add($request, $user, $article);
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

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }
}
