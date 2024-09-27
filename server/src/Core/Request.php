<?php

namespace App\Core;

class Request
{
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        return trim(parse_url($uri, PHP_URL_PATH), '/');
    }

    public function getBody()
    {
        switch ($this->getMethod()) {
            case 'GET':
                return $_GET;
            default:
                return json_decode(file_get_contents('php://input'), true);
        }
    }

    public static function handleCORS()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *, Authorization');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Credentials: true');
        header('Content-type: json/application');
        self::handleOptionsRequest();
    }


    public static function handleOptionsRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }
}
