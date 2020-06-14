<?php

namespace App\Models;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \App\Traits\StringPreparation;

    public const VALIDATE = [
        'comment' => 'required',
    ];
    public const COMMENT_ACTIVE = 1;

    protected $fillable = ['comment'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Add a new comment
     * @param array   $request
     * @param User    $user
     * @param Article $article
     * @return string
     */
    public function add(array $request, User $user, Article $article)
    {
        $this->comment = $this->clean($request['comment']);
        $this->user_id = $user->id;
        $this->article_id = $article->id;
        $this->activation($user);

        $this->save();

        return COMMENT_SUCCESS;
    }

    /**
     * If the user has enough rights, we will activate the comment
     * @param  User $user
     * @return void
     */
    private function activation(User $user)
    {
        if ($user->isAdmin() || $user->isRedactor()) {
            $this->active = self::COMMENT_ACTIVE;
        }
    }

        /**
     * Check whether the user has the right to view the comment
     * @param  User     $user
     * @return boolean
     */
    public function hasRightToView(User $user) 
    {
        return $user->isAdmin() || $user->isRedactor() || $user->id === $this->user->id;
    }
}
