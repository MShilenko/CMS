<?php

namespace App\Models;

class Setting extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\StringPreparation;

    public const VALIDATE = [
        'posts_count' => 'required|int',
    ];
    public const GENERAL_SETTINGS = 1;

    public $timestamps = false;

    /**
     * Get the value of the field we need
     * @param  string $optionName
     */
    public static function getGeneralOption(string $optionName) 
    {
       return self::find(self::GENERAL_SETTINGS)->$optionName;
    }

    /**
     * Edit settings
     * @param array $request
     * @return string
     */
    public function edit(array $request): string 
    {
        $this->posts_count = $this->clean($request['posts_count']);

        $this->save();

        return SETTINGS_SUCCESS;
    }
}
