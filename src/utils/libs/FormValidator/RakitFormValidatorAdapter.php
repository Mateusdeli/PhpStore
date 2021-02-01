<?php

namespace App\WebStore\Utils\Libs\FormValidator;

use Rakit\Validation\Validator;

class RakitFormValidatorAdapter implements FormValidator
{
    private Validator $validator;
    private array $errors = [];

    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    public function validateEmail(string $value, bool $isRequired = false): bool
    {
        $msgRequired = "O campo email é obrigatorio";
        $msg = "Email fornecido não é válido";

        $validateEmail = $this->validator->validate([$value], ['email']);
        $validateRequired = $this->validator->validate([$value], ['required']);

        if ($isRequired) {
            if ($validateRequired->fails()) {
                $this->errors[] = $msgRequired;
                return false;
            }
        }

        if ($validateEmail->fails()) {
            $this->errors[] = $msg;
            return false;
        }
        return true;
    }

    public function validatePassword(string $value, bool $isRequired = false): bool
    {

        $msgRequired = "A senha é obrigatoria";
        $msg = "A senha deve ter no minimo 6 caracteres";
        $minPasswordChars = 6;

        $validatePassword = $this->validator->validate([$value], ["min:{$minPasswordChars}"]);
        $validateRequired = $this->validator->validate([$value], ['required']);

        if ($isRequired) {
            if ($validateRequired->fails()) {
                $this->errors[] = $msgRequired;
                return false;
            }
        }

        if ($validatePassword->fails()) {
            $this->errors[] = $msg;
            return false;
        }
        return true;
    }

    public function getErrorsMessage(): array
    {
        return $this->errors ?? [];
    }

}