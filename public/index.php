<?php

// abrir a sessao

use App\WebStore\Config\Container\Container;
use App\WebStore\Controllers\AuthController;
use App\WebStore\Controllers\Services\AuthServices;
use DI\ContainerBuilder;

session_start();

//autoload
require_once(__DIR__ . '/../vendor/autoload.php');

//routes
require_once(__DIR__ . '/../src/routes/routes.php');



