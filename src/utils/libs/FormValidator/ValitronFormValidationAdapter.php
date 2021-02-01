<?php

namespace App\WebStore\Utils\Libs\FormValidator;

use Valitron\Validator;

class ValitronFormValidationAdapter implements FormValidator
{
    private array $errors = [];
    private string $emailFieldName = 'text_email';
    private string $passwordFieldName = 'text_senha_1';

    public function validateEmail(string $value, bool $isRequired = false): bool
    {
        $msgRequired = 'O campo email é obrigatorio';
        $msg = 'Email fornecido não é válido';

        $validation = new Validator([$this->emailFieldName => $value]);

        if ($isRequired) {
            $validation->rule('required', $this->emailFieldName)->message($msgRequired);

            if (!$validation->validate()) {
                $this->errors[] = $validation->errors();
                return false;
            }
        }

        $validation->rule('email', $this->emailFieldName)->message($msg);

        if (!$validation->validate()) {
            $this->errors[] = $validation->errors();
            return false;
        }

        return true;
    }

    public function validatePassword(string $value, bool $isRequired = false): bool
    {
        $msgRequired = 'O campo senha é obrigatorio';
        $msg = 'Senha deve ter no minimo 6 caracteres';
        $minPasswordChars = 6;

        $validation = new Validator([$this->emailFieldName => $value]);

        if ($isRequired) {
            $validation->rule('required', $this->emailFieldName)->message($msgRequired);

            if (!$validation->validate()) {
                $this->errors[] = $validation->errors();
                return false;
            }
        }

        $validation->rule('lengthMin', $this->emailFieldName, $minPasswordChars)->message($msg);

        if (!$validation->validate()) {
            $this->errors[] = $validation->errors();
            return false;
        }

        return true;
    }

    public function getErrorsMessage(): array
    {
        return $this->errors ?? [];
    }
}