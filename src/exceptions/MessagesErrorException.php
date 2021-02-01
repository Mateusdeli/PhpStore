<?php

namespace App\WebStore\Exceptions;

use Exception;
use Throwable;

class MessagesErrorException extends Exception
{
    private array $messages = [];

    public function __construct(array $messages = NULL, string $message = NULL, int $code = 0, Throwable $previous = null ) {
        parent::__construct($message, $code, $previous);
        $this->messages[] = $messages;
    }

    public function getAllErrorsMessage(): array
    {
        return $this->messages;
    }
}