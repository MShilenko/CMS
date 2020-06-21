<?php

namespace App\Forms;

use \App\Models\User;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;
use \App\Modules\SimpleFormBuilder\Textarea;

class ProfileForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('profileBlock', 'row', ['class' => 'profile-block row']);

        if (isset($_POST['editProfile']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(PROFILE_EDIT_SUCCESS));
        }

        $form = new Form('profile', "editProfile", "POST", $this->action, ['id' => 'editProfile', 'class' => 'user col-lg-8 m-auto', 'enctype' => 'multipart/form-data']);

        // Name
        $name = new Input('name', 'text', 'Ваше имя', [
            'class' => 'form-control form-control-user',
            'required' => 'required',
            'placeholder' => PLACEHOLDER_NAME,
        ]);
        $name->setData($_POST['name'] ?? $this->model->name);
        $row = new Div('Ваше имя', 'For name filed', ['class' => 'form-group']);
        $row->add($name);
        $form->add($row);

        // E-mail
        $email = new Input('email', 'email', 'E-mail', [
            'class' => 'form-control form-control-user',
            'required' => 'required',
            'placeholder' => PLACEHOLDER_EMAIL,
        ]);
        $email->setData($_POST['email'] ?? $this->model->email);
        $row = new Div('E-mail', 'For email filed', ['class' => 'form-group']);
        $row->add($email);
        $form->add($row);

        // Avatar
        $row = new Div('Блок', 'For avatar filed', ['class' => 'form-group row align-items-center']);
        $col1 = new Div('Аватар', 'avatar', ['class' => 'col-sm-6 mb-3 mb-sm-0']);
        $avatar = new Input('avatar', 'file', 'Заменить изображение', ['class' => 'form-control-file']);
        $avatar->setData($_POST['avatar'] ?? $this->model->avatar->name ?? '');
        $col1->add($avatar);
        $row->add($col1);
        

        // Checkbox
        $col2 = new Div('Подписка', 'passwordSecondCol', ['class' => 'col-sm-6']);        
        $checkboxParams = ['class' => 'form-control form-check-input'];
        if ($this->model->subscribed()) {
            $checkboxParams['checked'] = 'checked';
        }
        $checkbox = new Input('subscribe', 'checkbox', ' подписан на расссылку', $checkboxParams);
        $checkbox->setData('yes');
        $col2->add($checkbox);
        $row->add($col2);

        $form->add($row);

        // Password
        $password = new Input('password', 'password', 'Пароль', ['class' => 'form-control form-control-user']);
        $passwordConfirm = new Input('passwordConfirm', 'password', 'Подтверждение пароля', ['class' => 'form-control form-control-user']);
        $row = new Div('Пароль', 'For email filed', ['class' => 'form-group row']);
        $col1 = new Div('Пароль', 'passwordFirstCol', ['class' => 'col-sm-6 mb-3 mb-sm-0']);
        $col1->add($password);
        $row->add($col1);
        $col2 = new Div('Подтверждение пароля', 'passwordSecondCol', ['class' => 'col-sm-6']);
        $col2->add($passwordConfirm);
        $row->add($col2);
        $form->add($row);

        // Textarea
        $row = new Div('О себе', 'For about filed', ['class' => 'form-group']);
        $about = new Textarea('about', 'about', 'О себе', [
            'class' => 'form-control form-control-user',
            'rows' => '3',
            'placeholder' => PLACEHOLDER_ABOUT,
        ]);
        $about->setData($_POST['about'] ?? $this->model->about);
        $row->add($about);
        $form->add($row);

        // Submit
        $row = new Div('Отправить', 'For email filed', ['class' => 'form-group']);
        $row->add(new Submit('Отправить', 'editProfile', ['class' => 'btn btn-primary btn-user btn-block']));
        $form->add($row);

        $formBlock->add($form);

        $this->prepareFields([$name, $email, $password, $passwordConfirm]);

        return $formBlock;
    }
}
