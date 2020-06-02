<?php

namespace App\Core;

use \App\Exceptions\NotFoundException;
use \App\Modules\AccessControl\Access;

class Router
{
    protected $routers = [];

    /**
     * Registration route with GET request
     * @param  string $route
     * @param  $callback
     */
    public function get(string $route, $callback)
    {
        $this->routers[] = new Route('GET', $route, $callback);
    }

    /**
     * Registration route with POST request
     * @param  string $route
     * @param  $callback
     */
    public function post(string $route, $callback)
    {
        $this->routers[] = new Route('POST', $route, $callback);
    }

    /**
     * Define a route and execute callback
     */
    public function dispatch()
    {
        foreach ($this->routers as $route) {
            if ($route->match($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
                (new Access($route->getCallback()))->check();
                return $this->render($route);
            }
        }

        throw new NotFoundException('Страница не найдена', 404);
    }

    /**
     * Check what came as a template and display
     * @param  Route $route
     */
    protected function render(Route $route)
    {
        return $route->run(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }

}
