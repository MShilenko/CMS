<?php

namespace App\Traits;

use \Illuminate\Database\Eloquent\Model;

trait ModelHelpers
{
    /**
     * Check if field on the table
     * @param  string $fieldName
     * @param  $fieldValue
     * @return boolean
     */
    public function fieldExists(string $fieldName, $fieldValue): bool
    {
        return $this->withTrashed()->where($fieldName, $fieldValue)->exists();
    }
}