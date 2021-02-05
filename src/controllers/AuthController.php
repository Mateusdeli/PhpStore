<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Events\CreateAccountEvent;
use App\WebStore\Classes\Events\Observers\CreateAccount\CreateAccountSaveDbObserver;
use App\WebStore\Classes\Events\Observers\CreateAccount\CreateAccountSendEmailObserver;
use App\WebStore\Classes\Store;
use App\WebStore\Exceptions\MessagesErrorException;
use App\WebStore\Helpers\AuthHelper;
use App\WebStore\Helpers\HttpHelper;
use App\WebStore\Helpers\LayoutHelper;
use App\WebStore\Helpers\SessionHelper;
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
        LayoutHelper::Layout([
            'layouts/html_header',
            'layouts/header',
            'home/index',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    public function login()
    {
       echo "LOGIN";
    }

    public function create()
    {

        $cliente = new Cliente();
        $cliente->setNomeCompleto("Mateus Deliberali");

        if (AuthHelper::ClienteLogado()) {
            return $this->index();
        }

        LayoutHelper::Layout([
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
            if (AuthHelper::ClienteLogado()) {
                return $this->index();
            }

            if (HttpHelper::ChecarRequisicaoTipoPost()) {
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

            LayoutHelper::Layout([
                'layouts/html_header',
                'layouts/header',
                'auth/create_account',
                'layouts/footer',
                'layouts/html_footer',
            ], $datasViewCreateAccount);

        } 
        catch(MessagesErrorException $ex) {
            SessionHelper::setSessionErrorMessage("error", $ex->getAllErrorsMessage());
            LayoutHelper::Layout([
                'layouts/html_header',
                'layouts/header',
                'auth/create_account',
                'layouts/footer',
                'layouts/html_footer',
            ]);
        }
        catch(Throwable $ex) {
            SessionHelper::setSessionErrorMessage("error", $ex->getMessage());
            LayoutHelper::Layout([
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
        $token = $_GET['token'];
        $tokenLength = 40;
        $mensagemErro =  "Este token não existe";
        $mensagem_success = "Conta validada com sucesso";

        if (AuthHelper::ClienteLogado()) {
            return $this->index();
        }

        if (!isset($token) || empty($token)) {
            SessionHelper::setSessionErrorMessage("error", $mensagemErro);
            return $this->index();
        }

        if (strlen($token) !== $tokenLength) {
            return $this->index();
        }
        
        if ($this->authServices->confirmarLinkEmail($token)) {
            LayoutHelper::Layout([
                'layouts/html_header',
                'layouts/header',
                'auth/email_verificado',
                'layouts/footer',
                'layouts/html_footer',
            ], ["mensagem_success" => $mensagem_success]);
            return;
        }

        return $this->index();
    }
}
