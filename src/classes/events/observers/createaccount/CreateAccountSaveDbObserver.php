<?php

namespace App\WebStore\Classes\Events\Observers\CreateAccount;

use App\WebStore\Classes\Events\Observers\ObserverInterface;
use App\WebStore\Models\Cliente;

class CreateAccountSaveDbObserver implements ObserverInterface
{

    private Cliente $cliente;

    public function __construct(Cliente $cliente) {
        $this->cliente = $cliente;
    }

    public function update(): void
    {
        $nome = $this->cliente->getNomeCompleto();
        var_dump("{$nome} salvo na db!");
    }
}