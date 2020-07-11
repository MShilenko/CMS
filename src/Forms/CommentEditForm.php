<?php

namespace App\Forms;

use App\Modules\SimpleFormBuilder\Div;
use App\Modules\SimpleFormBuilder\Form;
use App\Modules\SimpleFormBuilder\FormElement;
use App\Modules\SimpleFormBuilder\Submit;
use App\Modules\SimpleFormBuilder\Textarea;

class CommentEditForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('commentEditBlock', 'row', ['class' => 'articl-edit-block row']);

        if (isset($_POST['commentEdit']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(COMMENT_EDIT_SUCCESS));
        }

        $form = new Form('commentEdit', "commentEdit", "POST", $this->action, ['id' => 'commentEdit', 'class' => 'user col-lg-12']);

        // Textarea
        $row = new Div('О себе', 'For text filed', ['class' => 'form-group']);
        $text = new Textarea('comment', 'text', 'Комментарий', [
            'class' => 'form-control form-control-user',
            'rows' => '15',
            'placeholder' => PLACEHOLDER_COMMENT_TEXT,
        ]);
        $textData = htmlspecialchars_decode($_POST['comment'] ?? $this->model->comment);
        $text->setData($textData);
        $row->add($text);
        $form->add($row);

        // Submit
        $row = new Div('Сохранить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Сохранить', 'commentEdit', ['class' => 'btn btn-primary btn-user btn-block col-lg-2 col-xs-12']));
        $form->add($row);

        $formBlock->add($form);

        $this->prepareFields([$text]);

        return $formBlock;
    }
}
