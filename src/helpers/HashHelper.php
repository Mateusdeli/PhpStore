<?php

namespace App\WebStore\Helpers;

class HashHelper
{

    public static function gerarHashAleatorio(int $num_caracteres = 12): string
    {
        $chars = "abcdefg@#hijklmn%opqrstuvxyzABCDEF@GHIJKLijklmnopqrMNOP5QRSTUVXYZSTU1$2345";
        return substr(str_shuffle($chars), 0, $num_caracteres);
    }

}