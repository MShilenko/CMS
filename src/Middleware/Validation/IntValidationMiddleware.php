<?php

namespace App\Middleware\Validation;

use \Exception;

class IntValidationMiddleware extends ValidationMiddleware
{
    /**
     * Check the field for compliance with the rule
     * @param  string $field
     * @param  array  $params
     */
    public function check(string $field, array $request)
    {
        if (!is_numeric($field)) {
            throw new Exception(MSG_FIELD_NOT_INT);
        }

        return parent::check($field, $request);
    }
}