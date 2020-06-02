<?php

namespace App\Traits;

trait SessionAndCookie
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Add session variables and cookies for the user
     * @param array $request
     */
    protected function setUserSessionData(array $request)
    {
        $_SESSION['userId'] = $this->where('email', '=', $request['email'])->pluck('id')->first();
        setcookie("login", $request['email'], time() + 60 * 60 * 24 * 30, '/');
    }
}
