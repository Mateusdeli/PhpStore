<?php

namespace App\WebStore\Config;

use DI\Container as DIContainer;
use DI\ContainerBuilder;

class Container
{

    public function buildContainer(): DIContainer
    {
        $builder = new ContainerBuilder();
        return $builder->build();
    }

}