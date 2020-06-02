<?php

namespace App\Traits;

trait StringPreparation
{
    /**
     * Escape the string
     * @param  string $string
     * @return string
     */
    public function clean(string $string): string
    {
        $string = htmlentities($string, ENT_QUOTES, "UTF-8");
        $string = htmlspecialchars($string, ENT_QUOTES);

        return $string;
    }

    /**
     * Create a password hash
     * @param  string $password [description]
     * @return string
     */
    public function password(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
