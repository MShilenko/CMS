<?php

namespace App;

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
        $this->router->dispatch();
    }
}
