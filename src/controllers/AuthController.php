<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Store;

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

    public function create()
    {
        
    }
}
