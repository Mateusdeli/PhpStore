<?php

namespace App\WebStore\Classes\Database;

use Exception;
use PDO;
use PDOException;

class Database
{

    private PDO $connection;

    private function openConnection(): PDO
    {
        $this->connection = DatabaseFactory::createConnection(new MysqlConnection());
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $this->connection;
    }

    public function select(string $query, ?array $params = null): array
    {

        if (!preg_match("/^SELECT/i", $query)) {
            throw new Exception("A query sql fornecida não é do tipo SELECT");
        }

        $this->openConnection();

        try {

            $statement = $this->connection->prepare($query);

            if (!empty($params)) {
                $statement->execute($params);
                return $statement->fetchAll(PDO::FETCH_CLASS);
            }

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS);

        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

        $this->closeConnection();
        
    }

    public function insert(string $query, ?array $params = null)
    {

        if (!preg_match("/^INSERT/i", $query)) {
            throw new Exception("A query sql fornecida não é do tipo INSERT");
        }

        $this->openConnection();

        try {

            $statement = $this->connection->prepare($query);

            if (!empty($params)) {
                $statement->execute($params);
            }
            $statement->execute();
            return;
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

        $this->closeConnection();
        
    }

    public function update(string $query, ?array $params = null)
    {

        if (!preg_match("/^UPDATE/i", $query)) {
            throw new Exception("A query sql fornecida não é do tipo UPDATE");
        }

        $this->openConnection();

        try {

            $statement = $this->connection->prepare($query);

            if (!empty($params)) {
                $statement->execute($params);
            }
            $statement->execute();
            return;
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

        $this->closeConnection();
        
    }

    public function delete(string $query, ?array $params = null)
    {

        if (!preg_match("/^DELETE/i", $query)) {
            throw new Exception("A query sql fornecida não é do tipo DELETE");
        }

        $this->openConnection();

        try {

            $statement = $this->connection->prepare($query);

            if (!empty($params)) {
                $statement->execute($params);
            }
            $statement->execute();
            return;
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

        $this->closeConnection();
        
    }

    public function statement(string $query, ?array $params = null)
    {

        if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $query)) {
            throw new Exception("A query passada é inválida!");
        }

        $this->openConnection();

        try {

            $statement = $this->connection->prepare($query);

            if (!empty($params)) {
                $statement->execute($params);
            }
            $statement->execute();
            return;

        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

        $this->closeConnection();
        
    }

    private function closeConnection()
    {
        $this->connection = null;
    }
}
