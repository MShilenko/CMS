<?php

namespace App\Middleware\Validation;

use \App\Middleware\Middleware;

class ValidationMiddleware extends Middleware
{
    /**
     * @var Middleware
     */
    private $next = null;

    /**
     * Connect the object to the next in the chain
     * @param  ValidationMiddleware $next
     * @return ValidationMiddleware
     */
    public function linkWith(Middleware $next): Middleware
    {
        if ($this->next === null) {
            return $this->next = $next;
        } 

        return $this->next->linkWith($next);     
    }   
    
    /**
     * Check the field for compliance with the rule
     * @param  string $field
     * @param  array  $params
     */
    public function check(string $field, array $request)
    {
        if (!$this->next) {
            return true;
        }

        return $this->next->check($field, $request);
    }
}
