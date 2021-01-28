<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Store;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class AuthController
{
    public function index()
    {
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
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
        echo $_GET['text_email'];
    }
}
