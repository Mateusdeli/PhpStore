<?php

namespace App\WebStore\Classes\Database;

use PDO;

class DatabaseFactory
{
    private static string $host = MYSQL_HOST;
    private static string $database = MYSQL_DATABASE;
    private static string $user = MYSQL_USER;
    private static string $password = MYSQL_PASSWORD;
    private static string $charset = MYSQL_CHARSET;

    public static function createConnection(DatabaseConnection $databaseConnection): PDO
    {
        switch ($databaseConnection) {
            case $databaseConnection instanceof MysqlConnection:
                return (new MysqlConnection)->connection(self::$host, self::$database, self::$user, self::$password, self::$charset);
        }
    }

}
