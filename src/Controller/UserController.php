<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\ResponseAdapter;
use \App\Core\View;
use \App\Exceptions\AccessException;
use \App\Exceptions\NotFoundException;
use \App\Forms\AuthorizationForm;
use \App\Forms\ProfileForm;
use \App\Forms\RegistrationForm;
use \App\Models\User;
use \App\Modules\ModelRequestHelper;

class UserController extends Controller
{
    public function add(array $request)
    {
        $messages = [];
        $user = new User();
        $form = new RegistrationForm($request, $user::REG_VALIDATE);
        $messages = (new ModelRequestHelper($request, $form, $user, 'add'))->run();

        return (new ResponseAdapter($messages))->json();
    }

    public function auth(array $request)
    {
        $messages = [];
        $user = new User();
        $form = new AuthorizationForm($request, $user::AUTH_VALIDATE);

        $messages = (new ModelRequestHelper($request, $form, $user, 'auth'))->run();

        return (new ResponseAdapter($messages))->json();
    }

    public function personal()
    {
        if (hasUserSession()) {
            $form = new ProfileForm();
            $form->setModel(User::find($_SESSION['userId']));

            return new View('personal-area.index', ['form' => $form]);
        }

        throw new AccessException(MSG_FORBIDDEN, 403);
    }

    public function edit(array $request, array $files)
    {
        if (hasUserSession()) {
            $messages = [];

            $request['imageName'] = $files['avatar']['name'];
            $request['avatar'] = $files['avatar']['tmp_name'];

            $user = User::find($_SESSION['userId']);
            $form = new ProfileForm($request, $user::EDIT_VALIDATE);

            $messages = (new ModelRequestHelper($request, $form, $user, 'edit'))->run();

            return (new ResponseAdapter($messages))->json();
        }

        throw new AccessException(MSG_FORBIDDEN, 403);
    }

    public function profile(int $id)
    {
        if ($user = User::find($id)) {
            return new View('profile.index', ['currentUser' => $user]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }

    public function logout()
    {
        User::logout();
    }
}
