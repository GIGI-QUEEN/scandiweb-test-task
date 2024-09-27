<?php

use App\Core\App;
use App\Core\Container;
use App\Core\Database;
use App\Core\Helpers;
use App\Core\Request;

const BASE_PATH = __DIR__ . "/";

require BASE_PATH . '/vendor/autoload.php';

Request::handleCORS();

$container = new Container();

$container->bind('App\Core\Database', function () {
    $config = [
        'host' => 'db',
        'port' => 3306,
        'dbname' => 'scandiweb',
        'charset' => 'utf8mb4',
        'username' => 'user',
        'password' => 'user_password'
    ];

    return new Database($config);
});

App::setContainer($container);

$router = require Helpers::base_path('api.php');

$request = new Request();

$router->resolve($request);
