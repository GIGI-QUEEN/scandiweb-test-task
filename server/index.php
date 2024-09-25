<?php

/* use App\Controllers\HealthCheckController;
use App\Controllers\ProductsController;
use App\Core\Database; */

use App\Core\App;
use App\Core\Container;
use App\Core\Database;
use App\Core\Helpers;
use App\Core\Request;
use App\Core\Router;

const BASE_PATH = __DIR__ . "/";

require BASE_PATH . '/vendor/autoload.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *, Authorization');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header('Content-type: json/application');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

$container = new Container();

$container->bind('App\Core\Database', function () {
    /*  $config = [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'scandiweb',
        'charset' => 'utf8mb4',
    ]; */
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
