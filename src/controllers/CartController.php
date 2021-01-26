<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Store;

class CartController
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
}
