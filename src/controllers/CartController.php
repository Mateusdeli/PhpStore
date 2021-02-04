<?php

namespace App\WebStore\Controllers;

use App\WebStore\Helpers\LayoutHelper;

class CartController
{
    public function index()
    {
        LayoutHelper::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
}
