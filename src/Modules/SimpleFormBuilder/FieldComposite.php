<?php

namespace App\Modules\SimpleFormBuilder;

abstract class FieldComposite extends FormElement
{
    /**
     * @var FormElement[]
     */
    protected $fields = [];

    /**
     * Add Form element
     * @param FormElement $field
     */
    public function add(FormElement $field): void
    {
        $name                = $field->getName();
        $this->fields[$name] = $field;
    }

    /**
     * Remove Form element
     * @param  FormElement $component [description]
     */
    public function remove(FormElement $component): void
    {
        $this->fields = array_filter($this->fields, function ($child) use ($component) {
            return $child != $component;
        });
    }

    /**
     * Accept an array of data and set values ​​for specific form elements
     * @param array $data
     */
    public function setData($data): void
    {
        foreach ($this->fields as $name => $field) {
            if (isset($data[$name])) {
                $field->setData($data[$name]);
            }
        }
    }

    /**
     * Get the value of a specific form element from the data array
     * @return [type] [description]
     */
    public function getData(): array
    {
        $data = [];

        foreach ($this->fields as $name => $field) {
            $data[$name] = $field->getData();
        }

        return $data;
    }

    /**
     * Container render
     * @return string
     */
    public function render(): string
    {
        $output = "";

        foreach ($this->fields as $name => $field) {
            $output .= $field->render();
        }

        return $output;
    }
}
