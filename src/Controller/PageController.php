<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\View;
use \App\Models\Article;

class PageController extends Controller
{
    public function index()
    {
        return new View('index', ['articles' => Article::all()]);
    }

    public function about()
    {
        return new View('company.about', ['title' => 'About company']);
    }
}