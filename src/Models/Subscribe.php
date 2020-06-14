<?php

namespace App\Models;

use \Exception;

class Subscribe extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\StringPreparation;

    public const VALIDATE = [
        'email' => 'required|email',
    ];

    public $timestamps = false;
    protected $fillable = ['email'];

    /**
     * Add new subscriber
     * @param array $request
     * @return string
     */
    public function add(array $request): string
    {
        $request['email'] = $this->clean($request['email']);

        if ($this->emailExists($request['email'])) {
            throw new Exception(MSG_FIELD_SUBSCRIBE_HAS_EMAIL);
        }

        $this->create($request);

        return SUBSCRIBE_SUCCESS;
    }

    /**
     * Check if email exists
     * @param  string $email
     * @return boolean
     */
    public function emailExists(string $email): bool
    {
        return $this->where('email', '=', $email)->exists();
    }
}
