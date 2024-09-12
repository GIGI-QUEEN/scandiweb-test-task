<?php

namespace App\Models;

use App\Core\DatabaseInterface;
use App\Models\Product;
use Exception;

class DVD extends Product
{
    private $size = 0;

    public function __construct(
        DatabaseInterface $db,
        $id = null,
        $name = '',
        $price = 0.0,
        $sku = '',
        $size = 0
    ) {
        parent::__construct($db, $id, $name, $price, $sku);
        $this->setSize($size);
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($value)
    {
        $this->size = $value;
    }

    public function store()
    {
        try {
            $this->db->beginTransaction();

            $lastInsertId = $this->db->insert("INSERT INTO products (sku, name, price, type_id) VALUES (?,?,?, (SELECT id FROM product_types WHERE type_name = 'dvd'))", [
                $this->getSku(),
                $this->getName(),
                $this->getPrice(),
            ]);

            $this->db->insert("INSERT INTO dvds (product_id, size) VALUES (?,?)", [
                $lastInsertId,
                $this->getSize(),
            ]);
            $this->db->commit();

            return $lastInsertId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
