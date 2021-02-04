<?php

namespace App\WebStore\Helpers;

use App\WebStore\Classes\Database\Database;

class AuthHelper
{
    private Database $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public static function ClienteLogado(): bool
    {
        return isset($_SESSION['cliente']);
    }

}