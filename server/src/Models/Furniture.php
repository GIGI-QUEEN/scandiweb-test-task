<?php

namespace App\Models;

use App\Core\DatabaseInterface;
use Exception;

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function __construct(
        DatabaseInterface $db,
        $id = null,
        $name = '',
        $price = 0.0,
        $sku = '',
        $height = 0,
        $width = 0,
        $length = 0,
    ) {
        parent::__construct($db, $id, $name, $price, $sku);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLength($length);
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($value)
    {
        $this->height = $value;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($value)
    {
        $this->width = $value;
    }
    public function getLength()
    {
        return $this->length;
    }

    public function setLength($value)
    {
        $this->length = $value;
    }

    public function store()
    {
        try {
            $this->db->beginTransaction();

            $lastInsertId = $this->db->insert("INSERT INTO products (sku, name, price, type_id) VALUES (?,?,?, (SELECT id FROM product_types WHERE type_name = 'furniture'))", [
                $this->getSku(),
                $this->getName(),
                $this->getPrice(),
            ]);

            $this->db->insert("INSERT INTO furnitures (product_id, height, width, length) VALUES (?,?,?,?)", [
                $lastInsertId,
                $this->getHeight(),
                $this->getWidth(),
                $this->getLength(),
            ]);
            $this->db->commit();

            return $lastInsertId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
