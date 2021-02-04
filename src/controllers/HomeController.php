<?php

namespace App\WebStore\Controllers;

use App\WebStore\Helpers\LayoutHelper;

class HomeController
{

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
}
