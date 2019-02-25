<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Job\JobFailHandler;
use Lencse\Queue\Job\JobPermanentFailHandler;
use Lencse\Queue\Job\JobSuccesHandler;
use Lencse\Queue\Job\ProcessJob;
use Lencse\Queue\Job\RandomResult;
use Lencse\Queue\Job\SuccessOrFail;
use Lencse\Queue\Logging\Logger;
use Lencse\Queue\Notification\Notifier;
use Lencse\Queue\Queue\Queue;
use PHPUnit\Framework\TestCase;

class ProcessJobTest extends TestCase
{
    public function testProcess(): void
    {
        $randomResult = new class implements RandomResult
        {
            /**
             * @var bool
             */
            public $result = false;

            public function success(): bool
            {
                return $this->result;
            }
        };
        $logger = new class implements Logger
        {
            /**
             * @var string
             */
            public $msg = '';

            public function log(string $msg): void
            {
                $this->msg = $msg;
            }
        };
        $queue = new class implements Queue
        {
            /**
             * @var Job
             */
            public $job;

            public function saveJob(Job $job): void
            {
                $this->job = $job;
            }
        };
        $notifier = new class implements Notifier
        {
            /**
             * @var Job
             */
            public $job;

            public function notifyAboutFailedJob(Job $job): void
            {
                $this->job = $job;
            }
        };
        $process = new ProcessJob(
            new SuccessOrFail($randomResult),
            new JobSuccesHandler($logger),
            new JobFailHandler($logger, $queue),
            new JobPermanentFailHandler($logger, $notifier)
        );
        $process(new Job(0, 0));
        $this->assertEquals('Job#0 failed (1), retrying', $logger->msg);
        $this->assertEquals(1, $queue->job->tries());

        $process(new Job(0, 1));
        $this->assertEquals('Job#0 failed (2), retrying', $logger->msg);
        $this->assertEquals(2, $queue->job->tries());

        $process(new Job(0, 2));
        $this->assertEquals('Job#0 failed permanently', $logger->msg);
        $this->assertEquals(new Job(0, 2), $notifier->job);

        $randomResult->result = true;
        $process(new Job(1, 0));
        $this->assertEquals('Job#1 processed', $logger->msg);
    }
}
