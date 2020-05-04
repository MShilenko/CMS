<?php

namespace App\Exceptions;

use \App\Interfaces\Renderable;

class NotFoundException extends HttpException implements Renderable
{
    /**
     * Connect the template and transfer data to it
     * @return self
     */
    public function render()
    {
        http_response_code(NOT_FOUND);
        require VIEW_DIR . '/404.php';
        return $this;
    }
}
