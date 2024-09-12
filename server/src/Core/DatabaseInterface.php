<?php

namespace App\Core;

interface DatabaseInterface
{
    public function select($statement = "", $params = []);
    public function insert($statement = "", $params = []);
    public function delete($statement = "", $params = []);
    public function beginTransaction();
    public function commit();
    public function rollBack();
}
