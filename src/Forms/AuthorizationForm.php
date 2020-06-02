<?php

namespace App\Forms;

use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class AuthorizationForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $form = new Form('authorization', "userAuthorization", "POST", "/authorization", ['id' => 'authUser', 'class' => 'user']);

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

        $this->prepareFields([$email, $password]);

        return $form;
    }
}
