<?php

namespace App\Forms;

use \App\Models\user;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class UserSwitchLockOutForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $userModel = User::withTrashed()->find($this->params['userId']);
        $formBlock = new Div('userSwitchLockOutBlock', 'row', ['class' => 'articl-switch-block row']);

        if (isset($_POST['userSwitchLockOut']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(USER_SWITCH));
        }

        $form = new Form('userSwitchLockOut', "userSwitchLockOut", "POST", $this->action, ['id' => 'userSwitchLockOut' . $userModel->id, 'class' => 'user col-lg-12 userSwitchLockOut']);

        // input userId
        $userSwitch = new input('userSwitch', 'hidden', '', ['class' => 'd-none']);
        $userId = new input('userId', 'hidden', '', ['class' => 'd-none']);
        $userId->setData($userModel->id);
        $form->add($userSwitch);
        $form->add($userId);

        // Submit
        $row = new Div('Отключить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Восстановить', 'userSwitchLockOut', ['class' => 'user-restore btn btn-success']));
        $row->add(new Submit('Заблокировать', 'userSwitchLockOut', ['class' => 'user-delete btn btn-danger']));

        $form->add($row);

        $formBlock->add($form);

        return $formBlock;
    }
}
