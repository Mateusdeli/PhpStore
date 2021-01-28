<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Store;
use App\WebStore\Controllers\Services\AuthServices;

class AuthController
{

    private AuthServices $authServices;

    public function __construct() {
        $this->authServices = new AuthServices();
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

        if (Store::ClienteLogado()) {
          return $this->index();
        }

        if (Store::ChecarRequisicaoTipoPost()) {
            return $this->index();
        }
    }
}
