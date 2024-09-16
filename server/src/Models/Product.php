<?php

namespace App\Models;

use App\Core\DatabaseInterface;

abstract class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $sku;
    protected $db;

    public function __construct(DatabaseInterface $db, $id = null, $name = '', $price = 0.0, $sku = '')
    {
        $this->db = $db;
        $this->setId($id);
        $this->setName($name);
        $this->setPrice($price);
        $this->setSku($sku);
    }

    public function getTypeName()
    {
        return strtolower((new \ReflectionClass($this))->getShortName());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($value)
    {
        $this->price = $value;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($value)
    {
        $this->sku = $value;
    }

    abstract public function store();

    abstract public function show();
}
