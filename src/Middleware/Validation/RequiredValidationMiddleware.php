<?php

namespace App\Middleware\Validation;

use \Exception;

class RequiredValidationMiddleware extends ValidationMiddleware
{
    /**
     * Check the field for compliance with the rule
     * @param  string $field
     * @param  array  $params
     */
    public function check(string $field, array $request)
    {
        if (empty($field)) {
            throw new Exception(MSG_FIELD_EMPTY);
        }

        return parent::check($field, $request);
    }
}
