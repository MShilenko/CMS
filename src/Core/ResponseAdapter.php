<?php

namespace App\Core;

class ResponseAdapter
{
    private $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * Convert data to json
     * @return string
     */
    public function json(): string
    {
        return json_encode($this->response, JSON_UNESCAPED_UNICODE);
    }
}
