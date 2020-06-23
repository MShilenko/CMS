<?php

namespace App\Forms;

use \App\Models\Subscribe;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class SubscribeDeleteForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $subscribeModel = Subscribe::find($this->params['subscribeId']);
        $formBlock = new Div('subscribeDeleteBlock', 'row', ['class' => 'subscribe-switch-block row']);

        if (isset($_POST['subscribeDelete']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(SUBSCRIBE_DELETE));
        }

        $form = new Form('subscribeDelete', "subscribeDelete", "POST", $this->action, ['id' => 'subscribeDelete' . $subscribeModel->id, 'class' => 'user col-lg-12 subscribeDelete']);

        // input subscribeId
        $subscribeId = new input('subscribeId', 'hidden', '', ['class' => 'd-none']);
        $subscribeId->setData($subscribeModel->id);
        $form->add($subscribeId);

        // Submit
        $row = new Div('Отключить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Удалить', 'subscribeDelete', ['class' => 'subscribe-delete btn btn-danger']));

        $form->add($row);

        $formBlock->add($form);

        return $formBlock;
    }
}