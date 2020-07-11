<?php

namespace App\Core;

use App\Controller\AdminController;

abstract class Controller
{
    protected const ADMIN = 1;
    protected const REDACTOR = 2;
    protected const USER = 3;

    /**
     * Role Behaviors
     * @return array
     */
    public static function behaviors()
    {
        return [
            AdminController::class => [
                'users' => [self::ADMIN],
                'editUser' => [self::ADMIN],
                'addUser' => [self::ADMIN],
                'addUserPost' => [self::ADMIN],
                'subscribes' => [self::ADMIN],
                'deleteSubscribe' => [self::ADMIN],
                'settings' => [self::ADMIN],
                'edifSettings' => [self::ADMIN],
                'index' => [self::ADMIN, self::REDACTOR],
                'allArticles' => [self::ADMIN, self::REDACTOR],
                'article' => [self::ADMIN, self::REDACTOR],
                'editArticle' => [self::ADMIN, self::REDACTOR],
                'addArticle' => [self::ADMIN, self::REDACTOR],
                'addArticlePost' => [self::ADMIN, self::REDACTOR],
                'comments' => [self::ADMIN, self::REDACTOR],
                'toggleComment' => [self::ADMIN, self::REDACTOR],
                'comment' => [self::ADMIN, self::REDACTOR],
                'editComment' => [self::ADMIN, self::REDACTOR],
                'pages' => [self::ADMIN, self::REDACTOR],
                'togglePage' => [self::ADMIN, self::REDACTOR],
                'page' => [self::ADMIN, self::REDACTOR],
                'editPage' => [self::ADMIN, self::REDACTOR],
                'addPage' => [self::ADMIN, self::REDACTOR],
                'addPagePost' => [self::ADMIN, self::REDACTOR],
            ],
        ];
    }
}
