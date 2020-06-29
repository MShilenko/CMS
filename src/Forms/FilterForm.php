<?php

namespace App\Forms;

use \App\Modules\SimpleFormBuilder\Div;
use \App\Modules\SimpleFormBuilder\Form;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\SimpleFormBuilder\Option;
use \App\Modules\SimpleFormBuilder\Select;
use \App\Modules\SimpleFormBuilder\Submit;

class FilterForm extends BaseForm
{
    public function assembly(): FormElement
    {
        $formBlock = new Div('filterBlock', 'row', ['class' => 'filter-block row']);

        $form = new Form('filter', "filter", "GET", $this->action, ['id' => 'addFilter', 'class' => 'user col-lg-12']);

        $row = new Div('row', 'row', ['class' => 'form-check row d-flex text-right align-items-center']);

        // $select
        $select = new Select('on_page', 'Число записей выводимых на странице', ['class' => 'form-control']);
        $options = [
            'option1' => 10,
            'option2' => 20,
            'option3' => 50,
            'option4' => 200,
            'optionAll' => 'all',
        ];

        foreach ($options as $key => $value) {
            $params = [];
            if (isset($_GET['on_page']) && $_GET['on_page'] == $value) {
                $params['selected'] = 'selected';
            } 
            $option = $key == 'optionAll' ? new Option($key, SELECT_ALL, $params) : new Option($key, $value, $params);
            $option->setData($value);
            $select->add($option);
        }

        $row->add($select);

        // Submit
        $submit = new Submit('Применить', '', ['class' => 'btn btn-primary']);
        $row->add($submit);

        $form->add($row);

        $formBlock->add($form);

        return $formBlock;
    }
}
