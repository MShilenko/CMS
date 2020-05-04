<?php

namespace App\Classes;

use \App\Traits\MethodReflectionInfo;
use \App\Exceptions\NotFoundException;

class Router
{
    use MethodReflectionInfo;

    protected $routers;

    /**
     * Registration route with http request
     * @param  string $route
     * @param  $view
     */
    public function get(string $route, $view)
    {
        $this->routers[$route] = $view;
    }

    /**
     * Define a route and execute callback
     * @param  string   $route
     * @param  callable $view
     */
    public function dispatch()
    {
        foreach ($this->routers as $route => $view) {
            if ($route === parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
                return $this->render($view);
            }
        }

        throw new NotFoundException('Страница не найдена', 404);
    }

    /**
     * Check what came as a template and display
     * @param  $view
     */
    protected function render($view)
    {
        return is_callable($view) ? $this->renderCallback($view) : $this->renderMethod($view);
    }

    /**
     * Return the result of the callback function
     * @param  callable $view
     */
    protected function renderCallback(callable $view)
    {
        return call_user_func($view);
    }

    /**
     * Return the result of the method
     * @param  string $view
     */
    protected function renderMethod(string $view)
    {
        $result = [];
        $path   = explode('@', $view);

        $result = $this->isStaticMethod($path[0], $path[1]) ? $path : [new $path[0], $path[1]];

        return call_user_func($result);
    }
}
