<?php

namespace App\WebStore\Services;

use App\WebStore\Classes\Database\Database;
use App\WebStore\Classes\Events\CreateAccountEvent;
use App\WebStore\Classes\Events\Observers\CreateAccount\CreateAccountSaveDbObserver;
use App\WebStore\Classes\Events\Observers\CreateAccount\CreateAccountSendEmailObserver;
use App\WebStore\Helpers\HashHelper;
use App\WebStore\Models\Builders\ClienteBuilder;
use App\WebStore\Models\Cliente;
use App\WebStore\Utils\Libs\Email\EmailSenderInterface;
use Exception;
use Throwable;

class AuthServices
{
    private Database $database;
    private EmailSenderInterface $mail;

    public function __construct(Database $database, EmailSenderInterface $mail) {
        $this->database = $database;
        $this->mail = $mail;
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
        $messageSenhasNaoConferem = "A senha fornecida não correspondem!";
        $messageEmailExistente = "Este email já está cadastrado!";

        if (!$this->verificarSenhaCorresponde($senha, $confirmarSenha)) {
            throw new Exception($messageSenhasNaoConferem);
        }

        if ($this->checarEmailJaExiste($email)) {
            throw new Exception($messageEmailExistente);
        }

        $cliente = $this->criarCliente($email, $senha, $nomeCompleto, $endereco, $cidade, $telefone);

        // evento que salva no banco e mandar email de confirmacao
        (new CreateAccountEvent())
        ->Attach(new CreateAccountSaveDbObserver($cliente, $this->database))
        ->Attach(new CreateAccountSendEmailObserver($this->enviarEmailLinkConfirmacao([$cliente->getEmail()], $cliente->getPurl())))
        ->Notify();
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
        $link = "http://localhost:8000/?a=confirmar_email&token=";
        return "{$link}{$purlHash}";
    }

    private function enviarEmailLinkConfirmacao(array $emails, string $pushHash): EmailSenderInterface
    {
        
        $from = $_ENV['FROM'];
        $host = $_ENV['HOST'];
        $port = $_ENV['PORT'];
        $username = $_ENV['USERNAME'];
        $pass = $_ENV['PASSWORD'];

        $this->mail->configuration($from, $host, $port, $username, $pass, true);
        $this->mail->addBody('Confirme sua conta clicando neste link: ' . "<a href={$this->gerarLinkConfirmacaoEmail($pushHash)}>{$this->gerarLinkConfirmacaoEmail($pushHash)}<a/>")
        ->addSubject('Assunto Teste')
        ->addEmailAddress($emails);
        return $this->mail;
    }
}
