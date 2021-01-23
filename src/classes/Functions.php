<?php

namespace App\WebStore\Classes;

use Exception;

class Functions
{
    public function Layout(array $structures)
    {
        if (!is_array($structures)) {
            throw new Exception('Array de estrutura inválida');
        }

        

        foreach ($structures as $structure) {
            include("../src/views/$structure.php");
        }
    }
}
