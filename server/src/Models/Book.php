<?php

namespace App\Models;

use App\Core\DatabaseInterface;
use App\Models\Product;
use Exception;

class Book extends Product
{
    private $weight;

    public function __construct(
        DatabaseInterface $db,
        $id = null,
        $name = '',
        $price = 0.0,
        $sku = '',
        $weight = 0
    ) {
        parent::__construct($db, $id, $name, $price, $sku);
        $this->setWeight($weight);
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($value)
    {
        $this->weight = $value;
    }

    public function store()
    {
        try {
            $this->db->beginTransaction();

            $lastInsertId = $this->db->insert("INSERT INTO products (sku, name, price, type_id) VALUES (?,?,?, (SELECT id FROM product_types WHERE type_name = 'book'))", [
                $this->getSku(),
                $this->getName(),
                $this->getPrice(),
            ]);

            $this->db->insert("INSERT INTO books (product_id, weight) VALUES (?,?)", [
                $lastInsertId,
                $this->getWeight(),
            ]);
            $this->db->commit();

            return $lastInsertId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
