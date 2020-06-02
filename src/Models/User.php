<?php

namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\StringPreparation;
    use \App\Traits\SessionAndCookie;

    public const REG_VALIDATE = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|password',
    ];
    public const AUTH_VALIDATE = [
        'email' => 'required|email',
        'password' => 'required',
    ];
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
    public function add(array $request): void
    {
        if ($this->userExists($request['email'])) {
            throw new \Exception(MSG_FIELD_NOT_UNIQUE_EMAIL);
        }

        $this->create($this->prepare($request))->roles()->attach(self::ROLE_USER);
    }

    /**
     * Verify data for authorization and authorization user
     * @param array $request
     */
    public function auth(array $request)
    {
        if (!$this->userExists($request['email'])) {
            throw new \Exception(MSG_FIELD_USER_NOT_FOUND);
        }

        if (!$this->passworVerified($request)) {
            throw new \Exception(MSG_FIELD_NOT_MATCH_PASSWORD);
        }

        $this->setUserSessionData($request);

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
}
