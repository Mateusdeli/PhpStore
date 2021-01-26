<?php

namespace App\WebStore\Controllers;

use App\WebStore\Classes\Store;

class StoreController
{
    public function index()
    {
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'store/index',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
}
