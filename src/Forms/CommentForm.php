<?php

namespace App\Forms;

use App\Models\User;
use App\Modules\SimpleFormBuilder\Div;
use App\Modules\SimpleFormBuilder\Form;
use App\Modules\SimpleFormBuilder\FormElement;
use App\Modules\SimpleFormBuilder\Textarea;
use App\Modules\SimpleFormBuilder\Submit;

class CommentForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('commentBlock', 'row', ['class' => 'comment-block row']);

        if (isset($_POST['addComment']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(COMMENT_SUCCESS));
        }

        $form = new Form('comment', "comment", "POST", $this->action, ['id' => 'addComment', 'class' => 'user col-lg-12']);

        // Textarea
        $comment = new Textarea('comment', 'comment', 'Комментарий', [
            'class' => 'form-control form-control-user',
            'required' => 'required',
            'rows' => '3',
            'placeholder' => PLACEHOLDER_COMMENT,
        ]);

        $row = new Div('comment', 'row', ['class' => 'form-group']);
        $row->add($comment);

        // Submit
        $submit = new Submit('Отправить', 'addComment', ['class' => 'btn btn-primary btn-user btn-block mt-2']);
        $row->add($submit);

        $form->add($row);

        $this->prepareFields([$comment]);

        $formBlock->add($form);

        return $formBlock;
    }
}
