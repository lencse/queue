<?php

namespace Lencse\Queue\Mail;

use Mailgun\Mailgun;

final class MailgunMailer implements Mailer
{
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var string
     */
    private $apiUrl;
    /**
     * @var string
     */
    private $domain;

    public function __construct(string $apiKey, string $apiUrl, string $domain)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        $this->domain = $domain;
    }

    public function send(Mail $mail): void
    {
        $mailgun = Mailgun::create($this->apiKey, $this->apiUrl);
        $mailgun->messages()->send($this->domain, [
            'from' => $mail->from(),
            'to' => $mail->to(),
            'subject' => $mail->subject(),
            'text' => $mail->body(),
        ]);
    }
}
