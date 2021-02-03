<?php

namespace App\WebStore\Classes\Events\Observers\CreateAccount;

use App\WebStore\Classes\Events\Observers\ObserverInterface;
use App\WebStore\Utils\Libs\Email\EmailSenderInterface;

class CreateAccountSendEmailObserver implements ObserverInterface
{

    private EmailSenderInterface $emailSenderInterface;

    public function __construct(EmailSenderInterface $emailSenderInterface) {
        $this->emailSenderInterface = $emailSenderInterface;
    }

    public function update(): void
    {
        $this->emailSenderInterface->send();
    }
}