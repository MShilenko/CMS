<?php

namespace App\Forms;

use \App\Interfaces\Renderable;
use \App\Modules\SimpleFormBuilder\AlertDiv;
use \App\Modules\SimpleFormBuilder\FieldComposite;
use \App\Modules\SimpleFormBuilder\FormElement;
use \App\Modules\Validation\RequestValidation;
use \Illuminate\Database\Eloquent\Model;

abstract class BaseForm implements Renderable
{
    public $errors = [];
    protected $action;
    protected $error;
    protected $data = [];
    protected $validateRules = [];
    protected $params = [];
    protected $model;

    public function __construct(array $data = [], array $validateRules = [], string $action = '')
    {
        $this->data = $data;
        $this->action = !empty($action) ? $action : $_SERVER['REQUEST_URI'];
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

    /**
     * Get errors array
     * @return boolean
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Check for errors exists
     * @return boolean
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Assign a personal error block
     * @param string $error
     */
    public function setError(string $error)
    {
        $this->error = $error;
    }

    /**
     * Add a general message block
     * @param string $success
     * @return  FieldComposite
     */
    protected function setAlertBlock(string $success): FieldComposite
    {
        $alertClass = isset($this->error) ? 'alert-danger' : 'alert-success';
        return new AlertDiv('alert', $this->error ?? $success, ['class' => 'col-lg-12 alert mt-2 ' . $alertClass]);
    }

    /**
     * Set the model
     * @param Model $model
     * @return void
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    /**
     * Set additional parameters
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }
}
