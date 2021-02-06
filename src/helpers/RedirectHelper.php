<?php

namespace App\WebStore\Helpers;

class RedirectHelper
{
    public static function RedirectRoot()
    {
        header("Location: " . $_ENV['APP_HOST']);
    }

    public static function Redirect($route = '')
    {
        header("Location: {$_ENV['APP_HOST']}?a={$route}");
    }
}