<?php

namespace App\WebStore\Helpers;

class HttpHelper
{
    public static function ChecarRequisicaoTipoPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] != "POST";
    }
}