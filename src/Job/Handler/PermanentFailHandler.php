<?php

namespace Lencse\Queue\Job\Handler;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Logging\Logger;
use Lencse\Queue\Notification\Notifier;

final class PermanentFailHandler implements JobHandler
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Notifier
     */
    private $notifier;

    public function __construct(Logger $logger, Notifier $notifier)
    {
        $this->logger = $logger;
        $this->notifier = $notifier;
    }

    public function handle(Job $job): void
    {
        $this->notifier->notifyAboutFailedJob($job);
        $this->logger->log(sprintf('Job#%d failed permanently', $job->id()));
    }
}
