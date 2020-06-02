<?php

namespace App\Core;

use \App\Interfaces\Renderable;

class View implements Renderable
{
    protected $view;
    protected $data;

    public function __construct(string $view, array $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Connect the template and transfer data to it
     */
    public function render()
    {
        extract($this->data, EXTR_PREFIX_SAME, 'alt');
        require VIEW_DIR . '/' . str_replace(VIEW_SEPARATOR, '/', $this->view) . '.php';
    }
}
