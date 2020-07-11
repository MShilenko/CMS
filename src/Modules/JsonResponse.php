<?php

namespace App\Modules;

use App\Interfaces\Renderable;

class JsonResponse implements Renderable
{
    protected $args;

    public function __construct(array $args = [])
    {
        $this->args = $args;
    }

    public function render()
    {
        echo json_encode($this->args, JSON_UNESCAPED_UNICODE);
    }
}