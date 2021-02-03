<?php

// abrir a sessao
use Dotenv\Dotenv;

session_start();

//autoload
require_once(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

//routes
require_once(__DIR__ . '/../src/routes/routes.php');



