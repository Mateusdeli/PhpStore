<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Store;

class HomeController
{

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
}
