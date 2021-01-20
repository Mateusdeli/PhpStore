<?php

namespace App\WebStore\Classes\Database;

use PDO;
use PDOException;

class Database
{

    private PDO $connection;

    public function openConnection(): PDO
    {

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        $this->connection = DatabaseFactory::createConnection(new MysqlConnection());
        return $this->connection;
    }

    public function select(string $query, array $params): array
    {
        $this->openConnection();

        try {

            $statement = $this->connection->prepare($query);

            if (!empty($params)) {
                $statement->execute($params);
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }
        catch (PDOException $e) {
            return false;
        }
        finally
        {
            $this->closeConnection();
        }
        
    }

    public function closeConnection()
    {
        $this->connection = null;
    }
}
