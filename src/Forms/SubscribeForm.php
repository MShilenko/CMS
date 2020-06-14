<?php

namespace App\Forms;

use \App\Models\User;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class SubscribeForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('subscribeBlock', 'row', ['class' => 'subscribe-block row']);

        if (isset($_POST['addSubscribe']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(SUBSCRIBE_SUCCESS));
        }

        $form = new Form('subscribe', "subscribe", "POST", $this->action, ['id' => 'addSubscribe', 'class' => 'user col-lg-12']);

        // E-mail
        $email = new Input('email', 'email', 'E-mail', [
            'class' => 'form-control form-control-user',
            'required' => 'required',
            'placeholder' => PLACEHOLDER_EMAIL,
        ]);

        $row = new Div('E-mail', 'row', ['class' => 'form-group row align-items-center']);
        $emailClass = hasUserSession() ? 'd-none' : '';
        $col1 = new Div('E-mail', 'First col', ['class' => 'col-lg-8 ' . $emailClass]);
        $col1->add($email);
        $row->add($col1);

        // Submit
        $col2 = new Div('E-mail button', 'Second col', ['class' => 'col-lg-4 mx-auto']);
        $col2->add(new Submit('Подписаться', 'addSubscribe', ['class' => 'btn btn-primary btn-user btn-block']));
        $row->add($col2);

        $form->add($row);

        $this->prepareFields([$email]);

        if (hasUserSession()) {
            $email->setData(User::find($_SESSION['userId'])->email);
        }

        $formBlock->add($form);

        return $formBlock;
    }
}
