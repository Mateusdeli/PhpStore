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
            return false;
        }

        $this->closeConnection();
        
    }

    private function closeConnection()
    {
        $this->connection = null;
    }
}
