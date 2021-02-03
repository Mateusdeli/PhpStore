<?php

namespace App\WebStore\Utils\Libs\Email;

interface EmailSenderInterface
{
    public function configuration(string $from, string $host, int $port, string $username, string $password, bool $html = false): self;
    public function addEmailAddress(array $emailAddress): self;
    public function addSubject(string $subject): self;
    public function addCC(string $cc): self;
    public function addBCC(string $bcc): self;
    public function addBody(string $body): self;
    public function addAttachments(array $attachments): self;
    public function send(?string $fromName = null): bool;
}