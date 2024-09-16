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

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *, Authorization');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header('Content-type: json/application');
//Helpers::dd($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

$container = new Container();

$container->bind('App\Core\Database', function () {
    $config = [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'scandiweb',
        'charset' => 'utf8mb4'
    ];

    return new Database($config);
});

App::setContainer($container);

$router = require Helpers::base_path('api.php');

$request = new Request();

$router->resolve($request);

/* $router = new Router();
$routes = require Helpers::base_path('routes.php');


$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} */
//dd($_SERVER);
//dd(parse_url($_SERVER['REQUEST_URI']));

/* $path = parse_url($_SERVER['REQUEST_URI'])['path'];

if ($_SERVER['REQUEST_URI'] === '/healthcheck' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new HealthCheckController();
    $controller->handle();
} 

if ($path === '/products' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ProductsController();
    $controller->handle();
} */



/* $config = require('../config.php');

$db = new Database($config);

var_dump() */
