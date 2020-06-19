<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasOne('App\Model\User');
    }

    /**
     * Add file
     * @param array $request
     * @return Upload
     */
    public function add(array $request): Upload 
    {
        move_uploaded_file($request['avatar'], APP_DIR . UPLOADS_DIR . '/' . $request['imageName']);
        $this->name = $request['imageName'];

        $this->save();

        return $this;
    }
}
