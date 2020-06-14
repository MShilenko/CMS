<?php

namespace App\Models;

class Article extends \Illuminate\Database\Eloquent\Model
{
    public function image()
    {
        return $this->belongsTo('App\Models\Upload', 'upload_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

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

    /**
     * Check if the article has comments
     * @return boolean [description]
     */
    public function hasComments(): bool
    {
        return $this->comments()->exists();
    }
}
