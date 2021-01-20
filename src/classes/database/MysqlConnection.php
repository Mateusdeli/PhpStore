<?php

namespace App\WebStore\Classes\Database;

use PDO;

class MysqlConnection implements DatabaseConnection
{
    public function connection(string $host, string $database, string $user, string $password, string $charset): PDO
    {
        return new PDO("mysql:host={$host};dbname={$database};charset={$charset}{$user}{$password}", array(PDO::ATTR_PERSISTENT => true));
    }
}
