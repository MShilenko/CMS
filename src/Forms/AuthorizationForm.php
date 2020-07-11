<?php

namespace App\Forms;

use App\Modules\SimpleFormBuilder\Div;
use App\Modules\SimpleFormBuilder\Form;
use App\Modules\SimpleFormBuilder\FormElement;
use App\Modules\SimpleFormBuilder\Input;
use App\Modules\SimpleFormBuilder\Submit;

class AuthorizationForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('authorizationblock', 'row', ['class' => 'authorization-block row']);

        if (isset($_POST['authUser']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(AUTHORIZATION_SUCCESS));           
        }

        $form = new Form('authorization', "userAuthorization", "POST", $this->action, ['id' => 'authUser', 'class' => 'user col-lg-12']);

        // E-mail
        $email = new Input('email', 'email', 'E-mail', [
            'class'            => 'form-control form-control-user',
            'required'         => 'required',
            'placeholder'      => PLACEHOLDER_EMAIL,
        ]);

        $row = new Div('E-mail', 'For email filed', ['class' => 'form-group']);
        $row->add($email);
        $form->add($row);

        // Password
        $password = new Input('password', 'password', 'Пароль', [
            'class'       => 'form-control form-control-user',
            'required'    => 'required',
            'placeholder' => PLACEHOLDER_PASSWORD,
        ]);
        $row = new Div('Пароль', 'For email filed', ['class' => 'form-group row']);
        $row->add($password);
        $form->add($row);

        // Submit
        $row = new Div('Отправить', 'For email filed', ['class' => 'form-group']);
        $row->add(new Submit('Отправить', 'authUser', ['class' => 'btn btn-primary btn-user btn-block']));
        $form->add($row);

        if (isset($_COOKIE['login'])) {
            $email->setData($_COOKIE['login']);   
        }

        $this->prepareFields([$email, $password]);

        $formBlock->add($form);

        return $formBlock;
    }
}
