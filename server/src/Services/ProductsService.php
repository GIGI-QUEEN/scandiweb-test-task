<?php

namespace App\Services;

use App\Core\DatabaseInterface;
use App\Core\Helpers;
use App\Factories\ProductFactory;
use Exception;

class ProductsService
{

    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getProducts()
    {
        try {
            $productsData = $this->db->select("
            SELECT
                p.id AS product_id,
                p.sku,
                p.name,
                p.price,
                pt.type_name AS type,
                b.weight AS weight,
                d.size AS size,
                f.height AS height,
                f.width AS width,
                f.length AS length
            FROM products p
                JOIN product_types pt ON p.type_id = pt.id
                LEFT JOIN books b ON p.id = b.product_id
                LEFT JOIN dvds d ON p.id = d.product_id
                LEFT JOIN furnitures f ON p.id = f.product_id
    ");
            // Helpers::dd($products[0]);
            $products = [];
            foreach ($productsData as $product) {
                //Helpers::dd($product);

                // print_r($product['product_type'] . '\\');
                $prod = ProductFactory::createProduct($this->db, $product);
                //Helpers::dd($prod);
                //$prod->getTypeV2();
                $products[] = $prod->show();
                //print_r($product);
                //Helpers::dd($val);
            }
            //die();
            // Helpers::dd($products[7]);
            return $products;
        } catch (Exception $e) {
            throw new Exception('Failed to load products: ' . $e->getMessage());
        }
    }

    public function storeProduct($data)
    {
        try {
            $product = ProductFactory::createProduct($this->db, $data);
            //Helpers::dd($product);
            $product->store();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }



    public function deleteProducts($ids)
    {
        try {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));

            $sql = "DELETE FROM products WHERE id IN ($placeholders)";

            $this->db->delete($sql, $ids);
        } catch (Exception $e) {
            throw new Exception("Failed to delete product: " . $e->getMessage());
        }
    }
}
