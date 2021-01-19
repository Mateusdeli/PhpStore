<?php

// abrir a sessao
session_start();

//autoload
require_once(__DIR__ . '/../vendor/autoload.php');

//carregar o arquivo config.php
require_once(__DIR__ . '/../config.php');

/* 
    carregar o arquivo de config.php
    carregar as classes do sistema
    carregar o sistema de rotas
*/
