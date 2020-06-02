<?php

namespace App\Modules\SimpleFormBuilder;

class Form extends FieldComposite
{
    protected $method;
    protected $url;

    public function __construct(string $name, string $title, $method, string $url, array $attributes = [])
    {
        parent::__construct($name, $title, $attributes);
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * Render form block
     * @return string
     */
    public function render(): string
    {
        $attributes = $this->getAttributes();
        $output = parent::render();
        
        return "<form method=\"{$this->method}\" name=\"{$this->title}\" action=\"{$this->url}\"$attributes>\n$output</form>\n";
    }
}
