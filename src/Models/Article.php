<?php

namespace App\Models;

class Article extends \Illuminate\Database\Eloquent\Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
