<?php

// abrir a sessao
session_start();

//autoload
require_once(__DIR__ . '/../vendor/autoload.php');

//carregar o arquivo config.php
require_once(__DIR__ . '/../config.php');

//routes
require_once(__DIR__ . '/../src/routes/routes.php');