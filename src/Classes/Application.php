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
     * @return view
     */
    public function run()
    {
        try {
            $dispatch = $this->router->dispatch();

            if ($dispatch instanceof Renderable) {
                return $dispatch->render();
            }

            echo $dispatch;
        } catch (\Exception $e) {
            $this->renderException($e);
        }
    }

    /**
     * handle the exception and print
     * @param  \Exception $e
     * @return view
     */
    public function renderException(\Exception $e)
    {
        if ($e instanceof Renderable) {
            return $e->render();
        }

        http_response_code($e->getCode() ?? INTERNAL_SERVER_ERROR);
        return 'Ошибка: ' . $e->getMessage();
    }
}
