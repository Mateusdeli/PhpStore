<?php

namespace App\WebStore\Classes;

use Exception;

class Store
{
    public static function Layout(array $structures, array $data = null)
    {
        if (!is_array($structures)) {
            throw new Exception('Array de estrutura inválida');
        }

        if (!empty($data) && is_array($data)) {
            extract($data);
        }

        foreach ($structures as $structure) {
            include("../src/views/$structure.php");
        }
    }

    public static function ClienteLogado(): bool
    {
        return isset($_SESSION['cliente']);
    }

    public static function ChecarRequisicaoTipoPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] != "POST";
    }

    public static function setSessionErrorMessage(string $errorName = "error", $message)
    {
        $_SESSION[$errorName] = $message;
    }

}
