<?php

namespace App\Forms;

use \App\Models\Subscribe;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class SubscribeSwitchPublicationForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $subscribeModel = Subscribe::find($this->params['subscribeId']);
        $formBlock = new Div('subscribeSwitchPublicationBlock', 'row', ['class' => 'subscribe-switch-block row']);

        if (isset($_POST['subscribeSwitchPublication']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(SUBSCRIBE_DELETE));
        }

        $form = new Form('subscribeSwitchPublication', "subscribeSwitchPublication", "POST", $this->action, ['id' => 'subscribeSwitchPublication' . $subscribeModel->id, 'class' => 'user col-lg-12 subscribeSwitchPublication']);

        // input subscribeId
        $subscribeId = new input('subscribeId', 'hidden', '', ['class' => 'd-none']);
        $subscribeId->setData($subscribeModel->id);
        $form->add($subscribeId);

        // Submit
        $row = new Div('Отключить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Удалить', 'subscribeSwitchPublication', ['class' => 'subscribe-delete btn btn-danger']));

        $form->add($row);

        $formBlock->add($form);

        return $formBlock;
    }
}