<?php

namespace App\Core;

use \App\Controller\AdminController;

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
                'index' => [self::ADMIN, self::REDACTOR],
                'allArticles' => [self::ADMIN, self::REDACTOR],
                'article' => [self::ADMIN],
            ],
        ];
    }
}
