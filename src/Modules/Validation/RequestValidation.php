<?php

namespace App\Modules\Validation;

use \App\Interfaces\Validated;
use \App\Middleware\Validation\ValidationMiddleware;
use \Exception;

class RequestValidation implements Validated
{
    public $errors = [];
    protected $middleware;
    protected $request  = [];
    protected $validate = [];

    public function __construct(array $request, array $validate)
    {
        $this->request  = $request;
        $this->validate = $validate;
    }

    /**
     * Initialize middlewares
     * @param Middleware $middleware
     */
    public function setMiddleware(ValidationMiddleware $middleware): void
    {
        $this->middleware = $middleware;
    }

    /**
     * Check the values ​​for compliance with the passed rules
     * @return  boolean
     */
    public function validate(): bool
    {
        foreach ($this->rulesToArray() as $field => $rules) {
            try {
                $this->prepareMiddlewares($rules);
                $this->middleware->check($this->request[$field], $this->request);
            } catch (Exception $e) {
                $this->errors[$field] = $e->getMessage();
            }
        }
        
        return empty($this->errors);
    }

    /**
     * Prepare middlewares and put together in a chain
     * @param  array  $rules
     */
    protected function prepareMiddlewares(array $rules)
    {
        $middlewares = new \stdClass();

        foreach ($rules as $rule) {
            $class = '\App\Middleware\Validation\\' . ucfirst($rule) . 'ValidationMiddleware';
            if (class_exists($class)) {
                $middlewares instanceof ValidationMiddleware ? $middlewares->linkWith(new $class) : $middlewares = new $class;
            }
        }

        $this->setMiddleware($middlewares);
    }

    /**
     * Collect an array of rules
     * @return array
     */
    protected function rulesToArray(): array
    {
        $rules = [];

        foreach ($this->validate as $field => $rule) {
            $rules[$field] = explode('|', $rule);
        }

        return $rules;
    }
}
