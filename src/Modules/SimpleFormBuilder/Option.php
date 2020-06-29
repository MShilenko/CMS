<?php

namespace App\Modules\SimpleFormBuilder;

class Option extends FormElement
{
    private $type;

    public function __construct(string $name, string $title, array $attributes = [])
    {
        parent::__construct($name, $title, $attributes);
    }

    /**
     * Form element render
     * @return string
     */
    public function render(): string
    {
        $option = '';
        $attributes = $this->getAttributes();

        $option = "<option value=\"{$this->data}\"$attributes>{$this->title}</option>\n";

        return $option;
    }
}
