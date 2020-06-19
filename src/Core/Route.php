<?php

namespace App\Core;

use \App\Traits\MethodReflectionInfo;

class Route
{
    use MethodReflectionInfo;

    private $method;
    private $path;
    private $callback;

    public function __construct(string $method, string $path, $callback)
    {
        $this->method   = $method;
        $this->path     = $path;
        $this->callback = $callback;
    }

    /**
     * Preparing and returning the path
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get HTTP method
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get callback
     */
    public function getCallback(): string
    {
        return $this->callback;
    }

    /**
     * Check if the route fits the request
     * @param  string $method
     * @param  string $uri
     * @return bool
     */
    public function match(string $method, string $uri): bool
    {
        if ($this->method === $method) {
            if (!strpos($this->path, '*') && !strpos($this->path, '\\')) {
                return $this->path === $uri;
            }

            return preg_match('/^' . $this->preparePath($this->getPath()) . '$/', $uri);
        }

        return false;
    }

    /**
     * Convert callback to an executable function
     * @param  $callback
     */
    private function prepareCallback($callback)
    {
        return is_callable($callback) ? $callback : $this->prepareMethod($callback);
    }

    /**
     * Return the result of the method
     * @param  string $callback
     */
    private function prepareMethod(string $callback)
    {
        $result = [];
        $path   = explode('@', $callback);

        $result = $this->isStaticMethod($path[0], $path[1]) ? $path : [new $path[0], $path[1]];

        return $result;
    }

    /**
     * Run callback and return the result
     * @param  string $uri
     */
    public function run(string $uri)
    {
        preg_match('/^' . $this->preparePath($this->getPath()) . '$/', $uri, $params);

        if ($this->method == 'POST') {
            $params[] = $_POST;
            $params[] = $_FILES ?? '';
        }

        return call_user_func_array($this->prepareCallback($this->callback), array_slice($params, 1));
    }

    /**
     * Prepare a line of a path for check
     * @param  string $path
     * @return string
     */
    public function preparePath(string $path): string
    {
        return str_replace(['*', '/'], ['(\w+)', '\/'], $path);
    }
}
