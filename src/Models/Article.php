<?php

namespace App\Models;

class Article extends \Illuminate\Database\Eloquent\Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get a list of articles for the main page
     * @return object
     */
    public static function front(): object
    {
        return self::orderBy('created_at', 'desc')->get();
    }
}
