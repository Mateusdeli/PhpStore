<?php

namespace App\WebStore\Services;

use App\WebStore\Classes\Database\Database;
use App\WebStore\Models\Builders\ClienteBuilder;
use Exception;

class AuthServices
{
    private Database $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function createAccount(
        string $email, 
        string $senha,
        string $confirmarSenha,
        string $nomeCompleto = null,
        string $endereco = null,
        string $cidade = null,
        string $telefone = null
        )
    {
        $key_purl = $email + $nomeCompleto;
        
        if (!$this->verificarSenhaCorresponde($senha, $confirmarSenha)) {
            throw new Exception("A senha fornecidade não correspondem");
        }

        $clienteBuilder = new ClienteBuilder();
        $cliente = $clienteBuilder
            ->hasEmail($email)
            ->hasPassword($this->gerarHashSenha($senha))
            ->hasNomeCompleto($nomeCompleto)
            ->hasEndereco($endereco)
            ->hasCidade($cidade)
            ->hasTelefone($telefone)
            ->hasPurl($this->gerarPurlCode($key_purl))
            ->build();

        $query = "INSERT INTO `tb_clientes` (email, pass, fullname, endereco, cidade, telefone, purl) VALUES (:e, :p, :f, :en, :c, :t, :p)";
        $params = array(
            ":e" => $cliente->getEmail(),
            ":p" => $cliente->getPassword(),
            ":f" => $cliente->getNomeCompleto(),
            ":en" => $cliente->getEndereco(),
            ":c" => $cliente->getCidade(),
            ":t" => $cliente->getTelefone(),
            ":p" => $cliente->getPurl()
        );
        
        $this->database->insert($query, $params);

    }

    private function verificarSenhaCorresponde(string $senha, string $confirmarSenha): bool
    {
        return $senha === $confirmarSenha;
    }

    private function gerarPurlCode($key_purl): string
    {
        return md5($key_purl);
    }

    private function gerarHashSenha(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }
}
