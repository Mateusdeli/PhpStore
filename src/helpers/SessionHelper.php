<?php

namespace App\WebStore\Helpers;

class SessionHelper
{
    public static function setSessionErrorMessage(string $errorName = "error", $message)
    {
        $_SESSION[$errorName] = $message;
    }
}