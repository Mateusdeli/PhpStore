<?php

namespace App\WebStore\Config\Container;

use App\WebStore\Classes\Functions;
use App\WebStore\Classes\User;
use App\WebStore\Classes\UserAuth;
use DI\ContainerBuilder;

class Container implements ContainerProvider
{

    private ContainerBuilder $container;

    public function build()
    {
        $this->container = new ContainerBuilder();
        $this->container->addDefinitions($this->definitions());
        return $this->container->build();
    }

    private function definitions(): array
    {
        return [ ];
    }
}
