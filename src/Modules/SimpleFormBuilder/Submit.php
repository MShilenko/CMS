<?php

namespace App\Modules\SimpleFormBuilder;

class Submit extends FormElement
{
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
        $attributes = $this->getAttributes();

        return "<input type=\"submit\" name=\"{$this->title}\" value=\"{$this->name}\"$attributes>\n";
    }
}
