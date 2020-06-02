<?php

namespace App\Modules\SimpleFormBuilder;

class Input extends FormElement
{
    private $type;

    public function __construct(string $name, string $type, string $title, array $attributes = [])
    {
        parent::__construct($name, $title, $attributes);
        $this->type = $type;
    }

    /**
     * Form element render
     * @return string
     */
    public function render(): string
    {
        $input      = '';
        $attributes = $this->getAttributes();

        $input = "<label for=\"{$this->name}\">{$this->title}</label>\n" .
            "<input name=\"{$this->name}\" type=\"{$this->type}\" value=\"{$this->data}\"$attributes>\n";

        if (isset($this->error)) {
            $input .= "<div class=\"alert alert-danger mt-2\" role=\"alert\">{$this->error}</div>\n";
        }

        return $input;
    }
}
