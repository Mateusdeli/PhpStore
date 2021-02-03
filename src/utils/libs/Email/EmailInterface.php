<?php

namespace App\WebStore\Utils\Libs\Email;

interface EmailInterface
{
    public function send(string $to, string $subject): void;
}