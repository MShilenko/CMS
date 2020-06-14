<?php

namespace App\Modules\SimpleFormBuilder;

class Textarea extends FormElement
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
        $textarea      = '';
        $attributes = $this->getAttributes();

        $textarea = "<label for=\"{$this->name}\">{$this->title}</label>\n" .
            "<textarea name=\"{$this->name}\" $attributes>{$this->data}</textarea>\n";

        if (isset($this->error)) {
            $textarea .= "<div class=\"alert alert-danger mt-2\" role=\"alert\">{$this->error}</div>\n";
        }

        return $textarea;
    }
}
