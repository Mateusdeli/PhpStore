<?php

namespace App\WebStore\Utils\Libs\Email;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Throwable;

class SwiftMailerAdapter implements EmailSenderInterface
{

    private string $from;
    private string $host;
    private int $port;
    private bool $html;
    private string $username;
    private string $password;
    private array $emailAddress = [];
    private string $subject = '';
    private string $cc;
    private string $bcc;
    private string $body;
    private array $attachments = [];

    public function configuration(string $from, string $host, int $port, string $username, string $password, bool $html = false): self
    {
        $this->host = $host;
        $this->from = $from;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->html = $html;
        return $this;
    }

    public function addEmailAddress(array $emailAddress): self
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function addSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
    
    public function addCC(string $cc): self
    {
        $this->cc = $cc;
        return $this;
    }

    public function addBCC(string $bcc): self
    {
        $this->bcc = $bcc;
        return $this;
    }

    public function addBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function addAttachments(array $attachments): self
    {
        $this->attachments = $attachments;
        return $this;
    }

    public function send(?string $fromName = null): bool
    {
        try {
            $transport = (new Swift_SmtpTransport($this->host, $this->port))
                ->setUsername($this->username)
                ->setPassword($this->password);

            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message($this->subject, $this->body))
                ->setFrom([$this->from => $fromName])
                ->setTo($this->emailAddress);

            if ($this->html) {
                $message->setContentType('text/html');
            }

            if (isset($this->cc) && !empty($this->cc)) {
                $message->setCc([$this->cc]);
            }

            if (isset($this->bcc) && !empty($this->bcc)) {
                $message->setBcc([$this->bcc]);
            }

            if (!is_null($this->attachments)) {
                foreach ($this->attachments as $attachment) {
                    $message->attach(Swift_Attachment::fromPath($attachment));
                }
            }

            $mailer->send($message);
            return true;
        }
        catch (Throwable $ex)
        {
            //var_dump($ex->getTraceAsString());
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
        
    }

}