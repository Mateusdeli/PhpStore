<?php

namespace App\WebStore\Classes\Database;

use PDO;

interface DatabaseConnection
{
    public function connection(string $host, string $database, string $user, string $password, string $charset): PDO;
}