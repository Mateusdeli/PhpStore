<?php

namespace App\WebStore\Services;

use App\WebStore\Models\Builders\ClienteBuilder;

class AuthServices
{
    public function createAccount(string $email)
    {
        $clienteBuilder = new ClienteBuilder();
        $clienteBuilder->hasEmail($email);
        var_dump($clienteBuilder->build());
    }
}
