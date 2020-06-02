<?php

namespace App\Middleware\Validation;

class EmailValidationMiddleware extends ValidationMiddleware
{
    /**
     * Check the field for compliance with the rule
     * @param  string $field
     * @param  array  $params
     */
    public function check(string $field, array $request)
    {
        if (!stripos($field, '@')) {
            throw new \Exception(MSG_FIELD_INCORRECT_EMAIL);
        }

        return parent::check($field, $request);
    }
}
