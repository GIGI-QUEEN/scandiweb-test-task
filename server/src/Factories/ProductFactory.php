<?php

namespace App\Factories;

use App\Models\Book;
use App\Models\DVD;
use App\Core\DatabaseInterface;
use App\Models\Furniture;

class ProductFactory
{

    public static function createProduct(DatabaseInterface $db, $data)
    {
        $name = $data['name'];
        $price = $data['price'];
        $sku = $data['sku'];
        $type = $data['type'];
        switch ($type) {
            case 'dvd':
                return new DVD($db, null, $name, $price, $sku, $data['size']);
            case 'book':
                return new Book($db, null, $name, $price, $sku, $data['weight']);
            case 'furniture':
                return new Furniture($db, null, $name, $price, $sku, $data['height'], $data['width'], $data['length']);
        }
    }
}
