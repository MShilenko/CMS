<?php

namespace App\Classes;

class Controller
{
    public function index()
    {
        return new View('index', ['title' => 'Index Page']);
    }

    public function about()
    {
        return new View('company.about', ['title' => 'About company']);
    }
}
