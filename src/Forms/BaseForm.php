<?php

namespace App\Forms;

use \App\Interfaces\Renderable;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\Validation\RequestValidation;

abstract class BaseForm implements Renderable
{
    protected $data          = [];
    protected $errors        = [];
    protected $validateRules = [];

    public function __construct(array $data = [], array $validateRules = [])
    {
        $this->data          = $data;
        $this->validateRules = $validateRules;
    }

    /**
     * Assemble the form
     * @return FormElement
     */
    abstract public function assembly(): FormElement;

    /**
     * Check and set errors value
     * @return  boolean
     */
    public function verify(): bool
    {
        $validation = new RequestValidation($this->data, $this->validateRules);

        if (!$validation->validate()) {
            $this->errors = $validation->errors;
        }

        return empty($this->errors);
    }

    /**
     * Print the form rendering result
     * @return string
     */
    public function render(): string
    {
        return $this->assembly()->render();
    }

    /**
     * Prepare field data for output
     * @param  array  $fields
     */
    protected function prepareFields(array $fields): void
    {
        foreach ($fields as $field) {
            isset($this->data[$field->getName()]) ? $field->setData($this->data[$field->getName()]) : '';
            isset($this->errors[$field->getName()]) ? $field->setError($this->errors[$field->getName()]) : '';
        }
    }
}
