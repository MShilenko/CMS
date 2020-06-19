<?php

namespace App\Middleware\Validation;

use \Exception;

class ImageValidationMiddleware extends ValidationMiddleware
{
    /**
     * Check the field for compliance with the rule
     * @param  string $field
     * @param  array  $params
     */
    public function check(string $field, array $request)
    {
        if (!empty($field)) {
            if (!$this->isCorrectType($field)) {
                throw new Exception(INCORRECT_IMAGE_TYPE);
            }

            if (!$this->isCorrectSize($field)) {
                throw new Exception(INCORRECT_IMAGE_SIZE);
            }
        }

        return parent::check($field, $request);
    }

    /**
     * Сheck file type
     * @param  string $field
     * @return boolean
     */
    public function isCorrectType(string $field): bool
    {
        return in_array(mime_content_type($field), ALLOWED_IMAGE_TYPES);
    }

    /**
     * Check file size
     * @param  int $field
     * @return boolean
     */
    public function isCorrectSize(string $field): bool
    {
        return filesize($field) <= ALLOWED_IMAGE_SIZE;
    }
}
