<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\ResponseAdapter;
use \App\Core\View;
use \App\Forms\AuthorizationForm;
use \App\Forms\RegistrationForm;
use \App\Models\User;
use \Exception;

class UserController extends Controller
{
    public function add(array $request)
    {
        $messages = [];
        $user = new User();
        $form = new RegistrationForm($request, $user::REG_VALIDATE);

        if ($form->verify()) {
            try {
                $success = $messages['success'] = $user->add($request);
            } catch (Exception $e) {
                $messages['modelError'] = $e->getMessage();
                $form->setError($e->getMessage());
            }
        }

        if ($form->hasErrors()) {
            $messages['errors'] = $form->getErrors();
        }

        //return new View('admin.registration.index', ['form' => $form]);
        return (new ResponseAdapter($messages))->json();
    }

    public function auth(array $request)
    {
        $messages = [];
        $user = new User();
        $form = new AuthorizationForm($request, $user::AUTH_VALIDATE);

        if ($form->verify()) {
            try {
                $success = $messages['success'] = $user->auth($request);
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

