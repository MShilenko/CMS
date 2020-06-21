<?php

namespace App\Models;

use \Exception;

class Article extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\StringPreparation;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    public const EDIT_VALIDATE = [
        'title' => 'required',
        'slug' => 'required',
        'text' => 'required',
        'image' => 'image',
    ];

    protected $dates = ['deleted_at'];

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
     * @return boolean
     */
    public function hasComments(): bool
    {
        return $this->comments()->exists();
    }

    /**
     * Edit article
     * @param  array  $request [description]
     * @return string
     */
    public function edit(array $request)
    {
        $slug = $this->clean($request['slug']);
        if ($this->slug !== $slug && $this->slugExists($slug)) {
            throw new Exception(SLUG_EXISTS);
        }

        $this->addImage($request);
        $this->title = $this->clean($request['title']);
        $this->slug = $this->clean($request['slug']);
        $this->text = $request['text'];
        $this->user_id = $_SESSION['userId'];

        $this->save();

        return ARTICLE_EDIT_SUCCESS;
    }

    /**
     * Check if slug exists
     * @param  string $slug
     * @return boolean
     */
    public function slugExists(string $slug): bool
    {
        return $this->where('slug', $slug)->exists();
    }

    /**
     * Add image
     * @param array $request
     * @return void
     */
    public function addImage(array $request): void
    {
        if (isset($request['image']) && !empty($request['image'])) {
            $upload = new Upload();
            $upload->add($request['image'], $request['imageName']);

            $this->image()->associate($upload);
        }
    }
}
