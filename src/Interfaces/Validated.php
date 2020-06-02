<?php

namespace App\Interfaces;

interface Validated
{
    /**
     * Check the values ​​for compliance with the passed rules
     * @return  boolean
     */
    public function validate(): bool;
}