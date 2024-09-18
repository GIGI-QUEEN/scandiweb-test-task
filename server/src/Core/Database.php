<?php

namespace App\Core;

use Exception;
use PDO;

class Database implements DatabaseInterface
{
    private $connection;

    public function __construct($config)
    {
        try {
            $username = $config['username'] ?? 'root';
            $password = $config['password'] ?? '';
            $dsn = 'mysql:' . http_build_query($config, '', ';');
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function executeStatement($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function select($statement = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($statement, $params);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function insert($statement = "", $params = [])
    {
        try {
            $this->executeStatement($statement, $params);
            return $this->connection->lastInsertId();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete($statement = "", $params = [])
    {
        try {
            $this->executeStatement($statement, $params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollBack()
    {
        $this->connection->rollBack();
    }
}
