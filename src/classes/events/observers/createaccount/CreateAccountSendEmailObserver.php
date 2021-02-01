<?php

namespace App\WebStore\Classes\Events\Observers\CreateAccount;

use App\WebStore\Classes\Events\Observers\ObserverInterface;

class CreateAccountSendEmailObserver implements ObserverInterface
{
    private $subject;
    private $email_to;

    public function __construct($subject, $email_to) {
        $this->subject = $subject;
        $this->email_to = $email_to;
    }

    public function update(): void
    {
        var_dump("Email enviado!");
    }
}