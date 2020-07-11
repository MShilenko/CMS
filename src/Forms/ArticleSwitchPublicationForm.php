<?php

namespace App\Forms;

use App\Models\Article;
use App\Modules\SimpleFormBuilder\Div;
use App\Modules\SimpleFormBuilder\Form;
use App\Modules\SimpleFormBuilder\FormElement;
use App\Modules\SimpleFormBuilder\Input;
use App\Modules\SimpleFormBuilder\Submit;

class ArticleSwitchPublicationForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $articleModel = Article::withTrashed()->find($this->params['articleId']);
        $formBlock = new Div('articleSwitchPublicationBlock', 'row', ['class' => 'articl-switch-block row']);

        if (isset($_POST['articleSwitchPublication']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(ARTICLE_DISABLED));
        }

        $form = new Form('articleSwitchPublication', "articleSwitchPublication", "POST", $this->action, ['id' => 'articleSwitchPublication' . $articleModel->id, 'class' => 'user col-lg-12 articleSwitchPublication']);

        // input userId
        $articleId = new input('articleId', 'hidden', '', ['class' => 'd-none']);
        $articleId->setData($articleModel->id);
        $form->add($articleId);

        // Submit
        $row = new Div('Отключить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Опубликовать', 'articleSwitchPublication', ['class' => 'article-restore btn btn-success']));
        $row->add(new Submit('Отключить', 'articleSwitchPublication', ['class' => 'article-delete btn btn-danger']));

        $form->add($row);

        $formBlock->add($form);

        return $formBlock;
    }
}
