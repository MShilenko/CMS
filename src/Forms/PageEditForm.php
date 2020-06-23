<?php

namespace App\Forms;

use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Input;
use \App\Modules\SimpleFormBuilder\Submit;
use \App\Modules\SimpleFormBuilder\Textarea;

class PageEditForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('pageEditBlock', 'row', ['class' => 'articl-edit-block row']);

        if (isset($_POST['pageEdit']) && !$this->hasErrors()) {
            $formBlock->add($this->setAlertBlock(PAGE_EDIT_SUCCESS));
        }

        $form = new Form('pageEdit', "pageEdit", "POST", $this->action, ['id' => 'pageEdit', 'class' => 'user col-lg-12']);

        // title
        $title = new Input('title', 'text', 'Название', [
            'class' => 'form-control col-lg-4 col-xs-12 form-control-user',
            'required' => 'required',
            'placeholder' => PLACEHOLDER_PAGE_TITLE,
        ]);
        $title->setData($_POST['title'] ?? $this->model->title ?? '');
        $row = new Div('Ваше имя', 'title', ['class' => 'form-group']);
        $row->add($title);
        $form->add($row);

        // slug
        $slug = new Input('slug', 'text', 'Символный код', [
            'class' => 'form-control col-lg-4 col-xs-12 form-control-user',
            'required' => 'required',
            'placeholder' => PLACEHOLDER_PAGE_SLUG,
        ]);
        $slug->setData($_POST['slug'] ?? $this->model->slug ?? '');
        $row = new Div('Символный код', 'slug', ['class' => 'form-group']);
        $row->add($slug);
        $form->add($row);

        // Textarea
        $row = new Div('О себе', 'For text filed', ['class' => 'form-group']);
        $text = new Textarea('text', 'text', 'Текст', [
            'class' => 'form-control form-control-user',
            'rows' => '15',
            'placeholder' => PLACEHOLDER_PAGE_TEXT,
        ]);
        $textData = htmlspecialchars_decode($_POST['text'] ?? $this->model->text ?? '');
        $text->setData($textData);
        $row->add($text);
        $form->add($row);

        // Submit
        $row = new Div('Сохранить', 'Submit', ['class' => 'form-group']);
        $row->add(new Submit('Сохранить', 'pageEdit', ['class' => 'btn btn-primary btn-user btn-block col-lg-2 col-xs-12']));
        $form->add($row);

        $formBlock->add($form);

        $this->prepareFields([$title, $slug, $text]);

        return $formBlock;
    }
}
