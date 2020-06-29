<?php

namespace App\Modules\SimpleFormBuilder;

class Select extends FieldComposite
{
    public function __construct(string $name, string $title, array $attributes = [])
    {
        parent::__construct($name, $title, $attributes);
    }

    /**
     * Render div block
     * @return string
     */
    public function render(): string
    {
        $attributes = $this->getAttributes();
        $output     = parent::render();

        return "<label for='$this->name'>$this->title</label>"
            . "<select title='$this->title' name='$this->name'$attributes>\n$output</div>\n";
    }
}
