<?php

namespace App\WebStore\Models\Builders;

use App\WebStore\Models\Cliente;

class ClienteBuilder
{

    private Cliente $cliente;

    public function __construct() {
        $this->cliente = new Cliente();
    }

    public function build(): Cliente
    {
        return $this->cliente;
    }
    
    public function hasEmail(string $email)
    {
        $this->cliente->setEmail($email);
        return $this;
    }

    public function hasPassword(string $password)
    {
        $this->cliente->setPassword($password);
        return $this;
    }

    public function hasNomeCompleto(string $nomeCompleto)
    {
        $this->cliente->setNomeCompleto($nomeCompleto);
        return $this;
    }

    public function hasEndereco(string $endereco)
    {
        $this->cliente->setEndereco($endereco);
        return $this;
    }

    public function hasCidade(string $cidade)
    {
        $this->cliente->setCidade($cidade);
        return $this;
    }

    public function hasTelefone(string $telefone)
    {
        $this->cliente->setTelefone($telefone);
        return $this;
    }

    public function hasPurl(string $purl)
    {
        $this->cliente->setPurl($purl);
        return $this;
    }

}