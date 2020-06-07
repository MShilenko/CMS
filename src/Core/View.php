<?php

namespace App\Core;

use \App\Interfaces\Renderable;
use \App\Models\User;

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
     * Create a user object if it is logged in
     * @return void
     */
    private function userData()
    {
        if (hasUserSession()) {
            $this->data['user'] = User::findOrFail($_SESSION['userId']);
        }
    }

    /**
     * Connect the template and transfer data to it
     */
    public function render()
    {
        $this->userData();
        extract($this->data, EXTR_PREFIX_SAME, 'alt');
        require VIEW_DIR . '/' . str_replace(VIEW_SEPARATOR, '/', $this->view) . '.php';
    }
}
