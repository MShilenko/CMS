<?php

namespace App\Modules\SimpleFormBuilder;

use App\Interfaces\Renderable;

abstract class FormElement implements Renderable
{
    protected $name;
    protected $title;
    protected $data;
    protected $attributes;
    protected $error;

    public function __construct(string $name, string $title, array $attributes = [])
    {
        $this->name       = $name;
        $this->title      = $title;
        $this->attributes = $attributes;
    }

    /**
     * Get the name of the block
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set errors value for the form fields
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * Set the value for the form field
     * @param $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * Get the value for the form field
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Convert the array into an attribute string
     * @param  array  $attributes
     * @return string
     */
    public function attributesToString(array $attributes): string
    {
        $result = '';

        foreach ($attributes as $key => $value) {
            $result .= " $key='$value'";
        }

        return $result;
    }

    /**
     * Return string of attributes
     * @return string
     */
    public function getAttributes(): string
    {
        return isset($this->attributes) ? $this->attributesToString($this->attributes) : '';
    }

    /**
     * Display the result of rendering
     * @return string
     */
    abstract public function render(): string;
}
