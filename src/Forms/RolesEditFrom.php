<?php

namespace App\Forms;

use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;
use \App\Models\User;

class RolesEditFrom extends BaseForm
{
    public function assembly(): FormElement
    {
        $userModel = User::withTrashed()->find($this->params['userId']);
        $formBlock = new Div('rolesEditBlock', 'row', ['class' => 'roles-edit-block row']);

        if (isset($_POST['rolesEdit']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(SAVE));
        }

        $form = new Form('rolesEdit', "rolesEdit", "POST", $this->action, ['id' => 'rolesEdit' . $userModel->id, 'class' => 'editRoles user col-lg-12']);

        // input userId
        $userId = new input('userId', 'hidden', '', ['class' => 'd-none']);
        $userId->setData($userModel->id);

        // checkbox
        $adminParams = $redactorParams = $userParams = ['class' => 'form-check-input'];
        if ($userModel->isAdmin()) {
            $adminParams['checked'] = 'checked';    
        }
        if ($userModel->isRedactor()) {
            $redactorParams['checked'] = 'checked';    
        }
        if ($userModel->isUser()) {
            $userParams['checked'] = 'checked';    
        } 
        $admin = new input('roles[admin]', 'checkbox', 'Администратор', $adminParams);
        $admin->setData($userModel::ROLE_ADMIN);
        $redactor = new input('roles[redactor]', 'checkbox', 'Редактор', $redactorParams);
        $redactor->setData($userModel::ROLE_REDACTOR);
        $user = new input('roles[user]', 'checkbox', 'Пользователь', $userParams);
        $user->setData($userModel::ROLE_USER);

        $row = new Div('radioButtons', 'row', ['class' => 'form-check form-check-inline align-items-baseline']);
        $row->add($userId);
        $row->add($admin);
        $row->add($redactor);
        $row->add($user);

        // Submit
        $submit = new Submit('Сохранить', 'rolesEdit', ['class' => 'btn btn-primary']);
        $row->add($submit);

        $form->add($row);
        $formBlock->add($form);

        return $formBlock;
    }
}
