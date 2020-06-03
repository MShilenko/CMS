<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Forms\AuthorizationForm;
use \App\Forms\RegistrationForm;
use \App\Models\User;

class UserController extends Controller
{
    public function add(array $request)
    {
        $error = '';
        $user  = new User();
        $form  = new RegistrationForm($request, $user::REG_VALIDATE);

        if ($form->verify()) {
            try {
                $user->add($request);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return new View('admin.registration.index', ['form' => $form, 'error' => $error]);
    }

    public function auth(array $request)
    {
        $error = '';
        $user  = new User();
        $form  = new AuthorizationForm($request, $user::AUTH_VALIDATE);

        if ($form->verify()) {
            try {
                $user->auth($request);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return new View('admin.authorization.index', ['form' => $form, 'error' => $error]);
    }
}
