<?php

namespace App\Forms;

use \App\Models\User;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class SettingsForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('settingsBlock', 'row', ['class' => 'settings-block row']);

        if (isset($_POST['addSettings']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(SETTINGS_SUCCESS));
        }

        $form = new Form('settings', "settings", "POST", $this->action, ['id' => 'addSettings', 'class' => 'user col-lg-12']);

        // $postsCount
        $postsCount = new Input('posts_count', 'text', 'Число записей выводимых на странице', [
            'class' => 'form-control form-control-user col-lg-2 col-xs-12',
            'required' => 'required',
            'placeholder' => PLACEHOLDER_POSTS_COUNT,
        ]);
        $postsCount->setData($_POST['posts_count'] ?? $this->model->posts_count ?? '');

        $row = new Div('Число записей выводимых на странице', 'row', ['class' => 'form-check']);
        $row->add($postsCount);

        // Submit
        $submit = new Submit('Сохранить', 'addSettings', ['class' => 'btn btn-primary btn-user btn-block col-lg-2 col-xs-12']);
        $row->add($submit);

        $form->add($row);

        $this->prepareFields([$postsCount]);

        $formBlock->add($form);

        return $formBlock;
    }
}
