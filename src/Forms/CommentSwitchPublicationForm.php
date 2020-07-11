<?php

namespace App\Forms;

use App\Models\Comment;
use App\Modules\SimpleFormBuilder\Div;
use App\Modules\SimpleFormBuilder\Form;
use App\Modules\SimpleFormBuilder\FormElement;
use App\Modules\SimpleFormBuilder\Input;
use App\Modules\SimpleFormBuilder\Submit;

class CommentSwitchPublicationForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $commentsModel = Comment::find($this->params['commentId']);
        $formBlock = new Div('commentsSwitchPublicationBlock', 'row', ['class' => 'articl-switch-block row']);

        if (isset($_POST['commentsSwitchPublication']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(COMMENT_STATUS_SWITCH));
        }

        $form = new Form('commentsSwitchPublication', "commentsSwitchPublication", "POST", $this->action, ['id' => 'commentsSwitchPublication' . $commentsModel->id, 'class' => 'user col-lg-12 commentsSwitchPublication']);

        // input userId
        $commentId = new input('commentId', 'hidden', '', ['class' => 'd-none']);
        $commentId->setData($commentsModel->id);
        $form->add($commentId);

        // Submit
        $row = new Div('Отключить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Опубликовать', 'commentsSwitchPublication', ['class' => 'comments-restore btn btn-success']));
        $row->add(new Submit('Отключить', 'commentsSwitchPublication', ['class' => 'comments-delete btn btn-danger']));

        $form->add($row);

        $formBlock->add($form);

        return $formBlock;
    }
}
