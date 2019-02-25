<?php

namespace Lencse\Queue\Mail;

interface Mailer
{
    public function send(Mail $mail): void;
}
