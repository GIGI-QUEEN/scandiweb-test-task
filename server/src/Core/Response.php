<?php

namespace App\Core;

class Response
{
    const NOT_FOUND = 404;
    const INTERNAL_SERVER_ERROR = 500;
    const OK = 200;

    public static function send($response, $code = self::OK)
    {
        http_response_code($code);
        echo json_encode($response, $code);
    }
}
