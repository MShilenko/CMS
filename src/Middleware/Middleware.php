<?php

namespace App\Middleware;

abstract class Middleware
{
    /**
     * Connect the object to the next in the chain
     * @param  Middleware $next
     * @return Middleware
     */
    abstract public function linkWith(Middleware $next): Middleware;
}
