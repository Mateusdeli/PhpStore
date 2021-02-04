<?php

namespace App\WebStore\Classes\Database;

use PDO;

class DatabaseFactory
{

    public static function createConnection(DatabaseConnection $databaseConnection): PDO
    {
        $host = $_ENV['DB_HOST'];
        $database = $_ENV['DB_DATABASE'];
        $charset = $_ENV['DB_CHARSET'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        switch ($databaseConnection) {
            case $databaseConnection instanceof MysqlConnection:
                return (new MysqlConnection)->connection($host, $database, $user, $password, $charset);
        }
    }

}
