<?php

namespace Lencse\Queue\Adapter\Notification;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Mail\Mail;
use Lencse\Queue\Mail\Mailer;
use Lencse\Queue\Notification\Notifier;

final class EmailNotifier implements Notifier
{
    /**
     * @var string
     */
    private $from;
    /**
     * @var string
     */
    private $to;
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(string $from, string $to, Mailer $mailer)
    {
        $this->from = $from;
        $this->to = $to;
        $this->mailer = $mailer;
    }

    public function notifyAboutFailedJob(Job $job): void
    {
        $this->mailer->send(new Mail(
            $this->from,
            $this->to,
            sprintf('Queue report: Job#%d', $job->id()),
            sprintf('Job#%d failed permanently', $job->id())
        ));
    }
}
