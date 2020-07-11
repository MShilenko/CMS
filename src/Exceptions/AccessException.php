<?php

namespace App\Exceptions;

use App\Interfaces\Renderable;

class AccessException extends HttpException implements Renderable
{
    /**
     * Connect the template and transfer data to it
     * @return self
     */
    public function render()
    {
        http_response_code(FORBIDDEN);
        require VIEW_DIR . '/403.php';
        return $this;
    }
}
