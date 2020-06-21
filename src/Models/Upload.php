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
     * @param string $tmpImage
     * @param string $image
     * @return Upload
     */
    public function add(string $tmpImage, string $image): Upload 
    {
        move_uploaded_file($tmpImage, APP_DIR . UPLOADS_DIR . '/' . $image);
        $this->name = $image;

        $this->save();

        return $this;
    }
}
