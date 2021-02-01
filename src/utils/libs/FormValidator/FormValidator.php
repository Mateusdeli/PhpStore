<?php

namespace App\WebStore\Utils\Libs\FormValidator;

interface FormValidator
{
    public function validateEmail(string $value, bool $isRequired = false): bool;
    public function validatePassword(string $value, bool $isRequired = false): bool;
    public function getErrorsMessage(): array;
}