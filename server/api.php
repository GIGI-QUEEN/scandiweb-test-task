<?php

use App\Controllers\ProductsController;
use App\Core\Router;

$router = new Router();

$router->get('products', ProductsController::class . '@index');
$router->get('product', ProductsController::class . '@show');
$router->delete('products/delete', ProductsController::class . '@delete');
$router->post('product/create', ProductsController::class . '@create');

return $router;
