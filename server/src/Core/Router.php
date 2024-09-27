<?php

namespace App\Core;

class Router
{
    protected $routes = [
        "GET" => [],
        "POST" => [],
        "DELETE" => [],
    ];

    public function get($uri, $controllerAction)
    {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri, $controllerAction)
    {
        $this->routes['POST'][$uri] = $controllerAction;
    }
    public function delete($uri, $controllerAction)
    {
        $this->routes['DELETE'][$uri] = $controllerAction;
    }

    public function resolve(Request $request)
    {
        $method = $request->getMethod();
        $uri = $request->getUri();
        $controllerAction = $this->routes[$method][$uri] ?? null;

        if (!$controllerAction) {
            http_response_code(404);
            echo json_encode([
                'error' => 'Route not found'
            ]);
            exit;
        }

        list($controllerName, $method) = explode('@', $controllerAction);

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            echo json_encode([
                'error' => 'Method not found'
            ]);
            exit;
        }
        return call_user_func_array([$controller, $method], [$request]);
    }
}
