<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Events\CreateAccountEvent;
use App\WebStore\Classes\Events\Observers\CreateAccount\CreateAccountSaveDbObserver;
use App\WebStore\Classes\Events\Observers\CreateAccount\CreateAccountSendEmailObserver;
use App\WebStore\Classes\Store;
use App\WebStore\Exceptions\MessagesErrorException;
use App\WebStore\Models\Cliente;
use App\WebStore\Services\AuthServices;
use App\WebStore\Utils\Libs\Email\PhpMailerAdapter;
use App\WebStore\Utils\Libs\FormValidator\FormValidator;
use PHPMailer\PHPMailer\PHPMailer;
use Throwable;

class AuthController
{
    private AuthServices $authServices;
    private FormValidator $formValidator;

    public function __construct(AuthServices $authServices, FormValidator $formValidator) {
        $this->authServices = $authServices;
        $this->formValidator = $formValidator;
    }

    public function index()
    {
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home/index',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    public function login()
    {
       
    }

    public function create()
    {

        $cliente = new Cliente();
        $cliente->setNomeCompleto("Mateus Deliberali");

        if (Store::ClienteLogado()) {
            return $this->index();
        }

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'auth/create_account',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    public function store()
    {

        try {
            if (Store::ClienteLogado()) {
                return $this->index();
            }

            if (Store::ChecarRequisicaoTipoPost()) {
                return $this->index();
            }
    
            $this->formValidator->validateEmail($_POST['text_email'], true);
            $this->formValidator->validatePassword($_POST['text_senha_1'], true);
            
            if (count($this->formValidator->getErrorsMessage()) > 0) {
                throw new MessagesErrorException($this->formValidator->getErrorsMessage());
            }

            $this->authServices->createAccount(
                $_POST['text_email'], 
                $_POST['text_senha_1'], 
                $_POST['text_senha_2'],
                $_POST['text_nome_completo'],
                $_POST['text_endereco'],
                $_POST['text_cidade'],
                $_POST['text_telefone']);

            $datasViewCreateAccount = [
                'conta_criada' => 'Conta cadastrada com sucesso!'
            ];

            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'auth/create_account',
                'layouts/footer',
                'layouts/html_footer',
            ], $datasViewCreateAccount);

        } 
        catch(MessagesErrorException $ex) {
            Store::setSessionErrorMessage("error", $ex->getAllErrorsMessage());
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'auth/create_account',
                'layouts/footer',
                'layouts/html_footer',
            ]);
        }
        catch(Throwable $ex) {
            Store::setSessionErrorMessage("error", $ex->getMessage());
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'auth/create_account',
                'layouts/footer',
                'layouts/html_footer',
            ]);
        }
    }

    public function confirmar_email()
    {
        echo $_GET['token'];
    }
}
