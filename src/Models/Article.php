<?php

namespace App\Models;

use App\Observers;
use \Exception;

class Article extends \Illuminate\Database\Eloquent\Model implements \SplSubject
{
    use \App\Traits\ModelHelpers;
    use \App\Traits\StringPreparation;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    public const EDIT_VALIDATE = [
        'title' => 'required',
        'slug' => 'required',
        'text' => 'required',
        'image' => 'image',
    ];
    public const DEFAULT_IMAGE_ID = 1;

    protected $dates = ['deleted_at'];
    private $observers;

    // Observer pattern methods
    public function __construct()
    {
        parent::__construct();
        $this->observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    // /Observer pattern methods

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
     * Check if the article has comments
     * @return boolean
     */
    public function hasComments(): bool
    {
        return $this->comments()->exists();
    }

    /**
     * Edit article
     * @param  array  $request
     * @return string
     */
    public function edit(array $request)
    {
        $slug = $this->clean($request['slug']);
        if ($this->slug !== $slug && $this->fieldExists('slug', $slug)) {
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
     * Add new article
     * @param  array  $request
     * @return string
     */
    public function add(array $request)
    {
        $slug = $this->clean($request['slug']);
        if ($this->fieldExists('slug', $slug)) {
            throw new Exception(SLUG_EXISTS);
        }

        $this->addImage($request);
        $this->title = $this->clean($request['title']);
        $this->slug = $this->clean($request['slug']);
        $this->text = $request['text'];
        $this->user_id = $_SESSION['userId'];

        $this->save();
        $this->notify();

        return ARTICLE_ADD_SUCCESS;
    }

    /**
     * Add image
     * @param array $request
     * @return void
     */
    public function addImage(array $request): void
    {
        if (empty($this->upload_id)) {
            $this->upload_id = self::DEFAULT_IMAGE_ID;
        }

        if (isset($request['image']) && !empty($request['image'])) {
            $upload = new Upload();
            $upload->add($request['image'], $request['imageName']);

            $this->image()->associate($upload);
        }
    }
}
