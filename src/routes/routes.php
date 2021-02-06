<?php

use App\WebStore\Config\Container as ConfigContainer;

$routes = [
    'home' => 'Home@index',
    'store' => 'Store@index',
    'cart' => 'Cart@index',

    'login_form' => 'Auth@login_form',
    'login' => 'Auth@login',
    'create_account_form' => 'Auth@create',
    'create_account' => 'Auth@store',
    'confirmar_email' => 'Auth@confirmar_email'
];

$main_route = 'home';

if (isset($_GET['a'])) {
    if (!array_key_exists($_GET['a'], $routes)) {
        $main_route = 'home';
    }
    else {
        $main_route = $_GET['a'];
    }
}

$class_and_action_route = explode('@', $routes[$main_route]);

$controller_class = ucfirst($class_and_action_route[0]) . "Controller";
$method_class = $class_and_action_route[1];

$namespaceClass = "App\\WebStore\\Controllers\\".$controller_class;

$container = (new ConfigContainer())->buildContainer();

$class = $container->get($namespaceClass);
$class->$method_class();

