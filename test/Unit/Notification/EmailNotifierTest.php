<?php

namespace Test\Unit\Notification;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Mail\Mail;
use Lencse\Queue\Mail\Mailer;
use Lencse\Queue\Notification\EmailNotifier;
use PHPUnit\Framework\TestCase;

class EmailNotifierTest extends TestCase
{
    public function testNotify()
    {
        $mailer = new class implements Mailer
        {
            /**
             * @var Mail
             */
            public $mail;

            public function send(Mail $mail): void
            {
                $this->mail = $mail;
            }
        };
        $notifier = new EmailNotifier('from@test.hu', 'to@test.hu', $mailer);
        $notifier->notifyAboutFailedJob(new Job(0, 0));
        /** @var Mail $mail */
        $mail = $mailer->mail;
        $this->assertEquals('from@test.hu', $mail->from());
        $this->assertEquals('to@test.hu', $mail->to());
        $this->assertEquals('Queue report: Job#0', $mail->subject());
        $this->assertEquals('Job#0 failed permanently', $mail->body());
    }
}
