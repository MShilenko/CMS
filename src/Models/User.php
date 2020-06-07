<?php

namespace App\Models;

use \Exception;

class User extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\StringPreparation;

    public const REG_VALIDATE = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|password',
    ];
    public const AUTH_VALIDATE = [
        'email' => 'required|email',
        'password' => 'required',
    ];
    public const ROLE_ADMIN = 1;
    public const ROLE_REDACTOR = 2;
    public const ROLE_USER = 3;

    protected $fillable = ['name', 'email', 'password'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Add new user
     * @param array $request
     */
    public function add(array $request)
    {
        if ($this->userExists($request['email'])) {
            throw new Exception(MSG_FIELD_NOT_UNIQUE_EMAIL);
        }

        $this->create($this->prepare($request))->roles()->attach(self::ROLE_USER);
        $this->auth($request);
    }

    /**
     * Verify data for authorization and authorization user
     * @param array $request
     */
    public function auth(array $request)
    {
        if (!$this->userExists($request['email'])) {
            throw new Exception(MSG_FIELD_USER_NOT_FOUND);
        }

        if (!$this->passworVerified($request)) {
            throw new Exception(MSG_FIELD_NOT_MATCH_PASSWORD);
        }

        $this->setSessionData($request);
        header('Location: /');
        exit;

        return true;
    }

    /**
     * Prepare request to save to the database
     * @param  array  $request
     * @return array
     */
    protected function prepare(array $request): array
    {
        foreach ($request as $key => $value) {
            $request[$key] = $this->clean($value);
        }

        $request['password'] = $this->password($request['password']);

        return $request;
    }

    /**
     * Verified password
     * @param  array  $request
     * @return boolean
     */
    protected function passworVerified(array $request): bool
    {
        $hash = $this->where('email', '=', $request['email'])->pluck('password')->first();

        return password_verify($request['password'], $hash);
    }

    /**
     * Check if user exists
     * @param  string $email
     * @return boolean
     */
    public function userExists(string $email): bool
    {
        return $this->where('email', '=', $email)->exists();
    }

    /**
     * Add session variables and cookies for the user
     * @param array $request
     */
    protected function setSessionData(array $request)
    {
        $_SESSION['userId'] = $this->where('email', '=', $request['email'])->pluck('id')->first();
        setcookie("login", $request['email'], time() + 60 * 60 * 24 * 30, '/');
    }

    /**
     * Check if the user is subscribed
     * @return boolean
     */
    public function subscribed(): bool
    {
        return (new Subscribe())->emailExists($this->email);
    }

    /**
     * Check if there are administrator rights
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return (bool) $this->roles()->find(self::ROLE_ADMIN);
    }

    /**
     * Check if there are redactor rights
     * @return boolean
     */
    public function isRedactor(): bool
    {
        return (bool) $this->roles()->find(self::ROLE_REDACTOR);
    }

    /**
     * Logout user
     * @return void
     */
    public static function logout()
    {
        unset($_SESSION['userId']);
        header('Location: /');
        exit;
    }
}