<?php

namespace App\WebStore\Utils\Libs\Email;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Throwable;

class PhpMailerAdapter implements EmailSenderInterface
{

    private PHPMailer $phpMailer;
    private string $from;
    private string $host;
    private bool $html;
    private int $port;
    private string $username;
    private string $password;
    private array $emailAddress = [];
    private string $subject = '';
    private string $cc;
    private string $bcc;
    private string $body;
    private array $attachments = [];

    public function __construct(PHPMailer $phpMailer) {
        $this->phpMailer = $phpMailer;
    }

    public function configuration(string $from, string $host, int $port, string $username, string $password, bool $html = false): self
    {
        $this->CharSet = PHPMailer::CHARSET_UTF8;
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

            if ($_ENV['APP_DEBUG'] === "true") {
                $this->phpMailer->SMTPDebug = SMTP::DEBUG_SERVER;
            }
                              // Enable verbose debug output
            $this->phpMailer->isSMTP();                                            // Send using SMTP
            $this->phpMailer->Host       = $this->host;                    // Set the SMTP server to send through
            $this->phpMailer->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->phpMailer->Username   = $this->username;;                     // SMTP username
            $this->phpMailer->Password   = $this->password;;                               // SMTP password
            $this->phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->phpMailer->Port       = $this->port;

            if (empty($fromName) || is_null($fromName)) {
                $this->phpMailer->setFrom($this->from, $_ENV['APP_NAME']);
            }
            else {
                $this->phpMailer->setFrom($this->from, $fromName);
            }

            foreach ($this->emailAddress as $email) {
                $this->phpMailer->addAddress($email);
            }

            if (isset($this->cc) && !empty($this->cc)) {
                $this->phpMailer->addCC($this->cc);
            }

            if (isset($this->bcc) && !empty($this->bcc)) {
                $this->phpMailer->addBCC($this->bcc);
            }

            foreach ($this->attachments as $attachment) {
                $this->phpMailer->addAttachment($this->attachment);
            }

            if ($this->html) {
                $this->phpMailer->isHTML($this->html);
            }
            
            $this->phpMailer->Subject = $this->subject;
            $this->phpMailer->Body = $this->body;

            $this->phpMailer->send();
            return true;
        } 
        catch (Throwable $ex)
        {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}