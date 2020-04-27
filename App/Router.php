<?php

namespace App;

class Router
{
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
                $this->render($view);
            }
        }
    }

    /**
     * Check what came as a template and display
     * @param  $view
     */
    protected function render($view)
    {
        echo is_callable($view) ? $this->renderCallback($view) : $this->renderMethod($view);
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
        $path = explode('@', $view);
        return $path();
    }
}
