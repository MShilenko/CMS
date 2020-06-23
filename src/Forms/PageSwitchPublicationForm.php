<?php

namespace App\Forms;

use \App\Models\Page;
use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;

class PageSwitchPublicationForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $pageModel = Page::withTrashed()->find($this->params['pageId']);
        $formBlock = new Div('pageSwitchPublicationBlock', 'row', ['class' => 'page-switch-block row']);

        if (isset($_POST['pageSwitchPublication']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(PAGE_STATUS_SWITCH));
        }

        $form = new Form('pageSwitchPublication', "pageSwitchPublication", "POST", $this->action, ['id' => 'pageSwitchPublication' . $pageModel->id, 'class' => 'user col-lg-12 pageSwitchPublication']);

        // input pageId
        $pageId = new input('pageId', 'hidden', '', ['class' => 'd-none']);
        $pageId->setData($pageModel->id);
        $form->add($pageId);

        // Submit
        $row = new Div('Отключить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Опубликовать', 'pageSwitchPublication', ['class' => 'page-restore btn btn-success']));
        $row->add(new Submit('Отключить', 'pageSwitchPublication', ['class' => 'page-delete btn btn-danger']));

        $form->add($row);

        $formBlock->add($form);

        return $formBlock;
    }
}
