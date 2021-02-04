<?php

namespace App\WebStore\Controllers;

use App\WebStore\Helpers\LayoutHelper;

class StoreController
{
    public function index()
    {
        LayoutHelper::Layout([
            'layouts/html_header',
            'layouts/header',
            'store/index',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
}
