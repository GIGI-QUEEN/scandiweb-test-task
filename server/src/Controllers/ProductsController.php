<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Database;
use App\Core\Logger;
use App\Core\Request;
use App\Core\Response;
use App\Services\ProductsService;
use Exception;

class ProductsController
{
    private $db;
    private $logger;
    public function __construct()
    {
        $this->db = App::resolve(Database::class);
        $this->logger = new Logger(__DIR__ . '/../../request_logs.txt', Logger::LEVEL_INFO, false, true);
    }

    public function index()
    {

        try {
            $productService = new ProductsService($this->db);
            $products = $productService->getProducts();


            Response::send($products);
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage(),
            ];
            Response::send($response, Response::INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Request $request)
    {
        try {
            $toDelete = $request->getBody()['toDelete'];

            $productService = new ProductsService($this->db);
            $productService->deleteProducts($toDelete);
            $response = ['message' => 'Products successfuly deleted'];
            echo json_encode($response);
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage()
            ];
            Response::send($response, Response::INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $request)
    {
        try {
            $data = $request->getBody();
            $productService = new ProductsService($this->db);
            $productService->storeProduct($data);
            $response = ['message' => 'Product successfuly added'];
            echo json_encode($response);
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage()
            ];
            Response::send($response, Response::INTERNAL_SERVER_ERROR);
        }
    }
}
