<?php

namespace App\Traits;

trait MethodReflectionInfo
{
    /**
     * Check if the method is static
     * @param  string   $class
     * @param  string   $method
     * @return boolean
     */
    public static function isStaticMethod(string $class, string $method): bool
    {
        $method = new \ReflectionMethod($class, $method);

        return $method->isStatic();
    }
}
