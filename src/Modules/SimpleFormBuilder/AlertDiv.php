<?php

namespace App\Modules\SimpleFormBuilder;

class AlertDiv extends FieldComposite
{
    public function __construct(string $name, string $title, array $attributes = [])
    {
        parent::__construct($name, $title, $attributes);
    }

    /**
     * Render alert div block
     * @return string
     */
    public function render(): string
    {
        $attributes = $this->getAttributes();
        $output     = $this->title;

        return "<div title='$this->name'$attributes>\n$output</div>\n";
    }
}
