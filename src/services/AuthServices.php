<?php

namespace App\WebStore\Services;

use App\WebStore\Classes\Database\Database;
use App\WebStore\Classes\Store;
use App\WebStore\Helpers\HashHelper;
use App\WebStore\Models\Builders\ClienteBuilder;
use App\WebStore\Models\Cliente;
use App\WebStore\Utils\Libs\FormValidator\RakitFormValidator;
use Exception;

class AuthServices
{
    private Database $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function login(string $email, string $password) {
        
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

        $queryNovoCliente = "INSERT INTO `tb_clientes` (email, pass, fullname, endereco, cidade, telefone, purl) VALUES (:e, :pass, :f, :en, :c, :t, :purl)";
        $messageSenhasNaoConferem = "A senha fornecida não correspondem!";
        $messageEmailExistente = "Este email já está cadastrado!";

        if (!$this->verificarSenhaCorresponde($senha, $confirmarSenha)) {
            throw new Exception($messageSenhasNaoConferem);
        }

        if ($this->checarEmailJaExiste($email)) {
            throw new Exception($messageEmailExistente);
        }

        $cliente = $this->criarCliente($email, $senha, $nomeCompleto, $endereco, $cidade, $telefone);

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

    private function verificarSenhaCorresponde(string $senha, string $confirmarSenha): bool
    {
        return $senha === $confirmarSenha;
    }

    private function gerarHashSenha(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    private function checarEmailJaExiste(string $email): bool 
    {
        $querySelecionarEmail = "SELECT email FROM `tb_clientes` WHERE `email` = :email";
        $params = [
            ":email" => strtolower(trim($email))
        ];
        $resultEmails = $this->database->select($querySelecionarEmail, $params);
        return count($resultEmails) != 0;
    }

    private function criarCliente(string $email, string $senha, string $nomeCompleto, string $endereco, string $cidade, string $telefone): Cliente
    {
        $purlHash = HashHelper::gerarHashAleatorio(40);
        
        $clienteBuilder = new ClienteBuilder();
        return $clienteBuilder
            ->hasEmail(strtolower(trim($email)))
            ->hasPassword($this->gerarHashSenha($senha))
            ->hasNomeCompleto(trim($nomeCompleto))
            ->hasEndereco(trim($endereco))
            ->hasCidade(trim($cidade))
            ->hasTelefone(trim($telefone))
            ->hasPurl($purlHash)
            ->build();
    }

    private function gerarLinkConfirmacaoEmail(string $purlHash)
    {
        $link_purl = "http://localhost:8000/?a=confirmar_email&token={$purlHash}";
    }
}
