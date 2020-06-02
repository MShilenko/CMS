<?php

namespace App\Middleware\Validation;

class PasswordValidationMiddleware extends ValidationMiddleware
{
    /**
     * Check the field for compliance with the rule
     * @param  string $field
     * @param  array  $params
     */
    public function check(string $field, array $request)
    {
        if ($field !== $request['passwordConfirm']) {
            throw new \Exception(MSG_FIELD_PASSWORD_NOT_CONFIRM);
        }

        if ($this->hasForbiddenSymbols($field)) {
            throw new \Exception(MSG_FIELD_HAS_FORBIDDEN_SYMBOLS);
        }

        return parent::check($field, $request);
    }

    /**
     * Check the line for the presence of prohibited characters
     * @param  string  $field
     * @return boolean
     */
    protected function hasForbiddenSymbols(string $field): bool
    {
        $forbiddenSimbols = ['<', '>', '\\', '/', '.', ','];
        return (bool) array_intersect(str_split($field), $forbiddenSimbols);
    }
}
