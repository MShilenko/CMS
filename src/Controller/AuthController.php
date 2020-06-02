<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Forms\AuthorizationForm;
use \App\Forms\RegistrationForm;

class AuthController extends Controller
{
    public function registration()
    {
        return new View('admin.registration.index', ['form' => new RegistrationForm()]);
    }

    public function authorization()
    {
        return new View('admin.authorization.index', ['form' => new AuthorizationForm()]);
    }
}
