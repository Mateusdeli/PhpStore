<?php

namespace App\WebStore\Classes\Events\Observers\CreateAccount;

use App\WebStore\Classes\Database\Database;
use App\WebStore\Classes\Events\Observers\ObserverInterface;
use App\WebStore\Models\Cliente;

class CreateAccountSaveDbObserver implements ObserverInterface
{

    private Cliente $cliente;
    private Database $database;

    public function __construct(Cliente $cliente, Database $database) {
        $this->cliente = $cliente;
        $this->database = $database;
    }

    public function update(): void
    {
        $this->salvarClienteBancoDados($this->cliente);
    }

    private function salvarClienteBancoDados(Cliente $cliente)
    {
        $queryNovoCliente = "INSERT INTO `tb_clientes` (email, pass, fullname, endereco, cidade, telefone, purl) VALUES (:e, :pass, :f, :en, :c, :t, :purl)";
        
        $params = array(
            ":e" => $cliente->getEmail(),
            ":pass" => $cliente->getPassword(),
            ":f" => $cliente->getNomeCompleto(),
            ":en" => $cliente->getEndereco(),
            ":c" => $cliente->getCidade(),
            ":t" => $cliente->getTelefone(),
            ":purl" => $cliente->getPurl()
        );

        $this->database->insert($queryNovoCliente, $params);
    }
}