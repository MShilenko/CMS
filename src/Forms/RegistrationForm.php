<?php

namespace App\Forms;

use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class RegistrationForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('registrationBlock', 'row', ['class' => 'registration-block row']);

        if (isset($_POST['addSubscribe'])) {
            $formBlock->add($this->setAlertBlock(REGISTRATION_SUCCESS));           
        }

        $form = new Form('registration', "userRegistration", "POST", "/registration", ['id' => 'addUser', 'class' => 'user']);

        // Name
        $name = new Input('name', 'text', 'Ваше имя', [
            'class'       => 'form-control form-control-user',
            'required'    => 'required',
            'placeholder' => PLACEHOLDER_NAME,
        ]);
        $row = new Div('Ваше имя', 'For name filed', ['class' => 'form-group']);
        $row->add($name);
        $form->add($row);

        // E-mail
        $email = new Input('email', 'email', 'E-mail', [
            'class'       => 'form-control form-control-user',
            'required'    => 'required',
            'placeholder' => PLACEHOLDER_EMAIL,
        ]);
        $row = new Div('E-mail', 'For email filed', ['class' => 'form-group']);
        $row->add($email);
        $form->add($row);

        // Password
        $password        = new Input('password', 'password', 'Пароль', ['class' => 'form-control form-control-user', 'required' => 'required']);
        $passwordConfirm = new Input('passwordConfirm', 'password', 'Подтверждение пароля', ['class' => 'form-control form-control-user', 'required' => 'required']);
        $row             = new Div('Пароль', 'For email filed', ['class' => 'form-group row']);
        $col1            = new Div('Пароль', 'passwordFirstCol', ['class' => 'col-sm-6 mb-3 mb-sm-0']);
        $col1->add($password);
        $row->add($col1);
        $col2 = new Div('Подтверждение пароля', 'passwordSecondCol', ['class' => 'col-sm-6']);
        $col2->add($passwordConfirm);
        $row->add($col2);
        $form->add($row);
        $formBlock->add($form);

        // Submit
        $row = new Div('Отправить', 'For email filed', ['class' => 'form-group']);
        $row->add(new Submit('Отправить', 'addUser', ['class' => 'btn btn-primary btn-user btn-block']));
        $form->add($row);

        $this->prepareFields([$name, $email, $password, $passwordConfirm]);

        return $formBlock;
    }
}
