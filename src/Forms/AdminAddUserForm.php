<?php

namespace App\Forms;

use \App\Models\User;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class AdminAddUserForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('adminAddUserBlock', 'row', ['class' => 'adminAddUser-block row']);

        if (isset($_POST['adminAddUser']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(ADD_USER_SUCCESS));           
        }

        $form = new Form('adminAddUser', "adminAddUser", "POST", $this->action, ['id' => 'adminAddUser', 'class' => 'user col-lg-12']);

        // checkbox
        $admin = new input('roles[admin]', 'checkbox', 'Администратор');
        $admin->setData(User::ROLE_ADMIN);
        $redactor = new input('roles[redactor]', 'checkbox', 'Редактор');
        $redactor->setData(User::ROLE_REDACTOR);
        $user = new input('roles[user]', 'checkbox', 'Пользователь', ['checked' => 'checked']);
        $user->setData(User::ROLE_USER);

        $row = new Div('radioButtons', 'row', ['class' => 'form-check form-check-inline align-items-start']);
        $row->add($admin);
        $row->add($redactor);
        $row->add($user);
        $form->add($row);

        // Name
        $name = new Input('name', 'text', 'Имя', [
            'class'       => 'form-control form-control-user',
            'required'    => 'required',
            'placeholder' => PLACEHOLDER_ADMIN_NAME,
        ]);
        $row = new Div('Имя', 'For name filed', ['class' => 'form-group']);
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
        $row->add(new Submit('Отправить', 'adminAddUser', ['class' => 'btn btn-primary btn-user btn-block col-lg-2 col-xs-12']));
        $form->add($row);

        $this->prepareFields([$name, $email, $password, $passwordConfirm]);

        return $formBlock;
    }
}
