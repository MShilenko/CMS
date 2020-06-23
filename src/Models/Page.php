<?php

namespace App\Models;

use \Exception;

class Page extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\ModelHelpers;
    use \App\Traits\StringPreparation;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    public const EDIT_VALIDATE = [
        'title' => 'required',
        'slug' => 'required',
        'text' => 'required',
    ]; 

    protected $dates = ['deleted_at'];

    /**
     * Edit page
     * @param  array  $request
     * @return string
     */
    public function edit(array $request)
    {
        $slug = $this->clean($request['slug']);
        if ($this->slug !== $slug && $this->fieldExists('slug', $slug)) {
            throw new Exception(SLUG_EXISTS);
        }

        $this->title = $this->clean($request['title']);
        $this->slug = $this->clean($request['slug']);
        $this->text = $request['text'];

        $this->save();

        return PAGE_EDIT_SUCCESS;
    }

    /**
     * Add new page
     * @param  array  $request
     * @return string
     */
    public function add(array $request)
    {
        $slug = $this->clean($request['slug']);
        if ($this->fieldExists('slug', $slug)) {
            throw new Exception(SLUG_EXISTS);
        }

        $this->title = $this->clean($request['title']);
        $this->slug = $this->clean($request['slug']);
        $this->text = $request['text'];

        $this->save();

        return ADD_PAGE_SUCCESS;
    }
}
