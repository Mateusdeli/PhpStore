<?php

namespace App\WebStore\Helpers;

use Exception;

class LayoutHelper
{
    public static function Layout(array $structures, array $data = null)
    {
        if (!is_array($structures)) {
            throw new Exception('Array de estrutura inválida');
        }

        if (!empty($data) && is_array($data)) {
            extract($data);
        }

        foreach ($structures as $structure) {
            include("../src/views/$structure.php");
        }
    }
}