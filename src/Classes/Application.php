<?php

namespace App\Classes;

use \App\Interfaces\Renderable;

class Application
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Print the result of routing
     * @return $view
     */
    public function run()
    {
        $dispatch = $this->router->dispatch();

        if (is_subclass_of($dispatch, Renderable::class)) {
            return $dispatch->render();
        }

        echo $dispatch;
    }
}
