<?php

namespace Lencse\Queue\Job;

use Lencse\Queue\Logging\Logger;
use Lencse\Queue\Notification\Notifier;
use Lencse\Queue\Queue\Queue;

final class JobPermanentFailHandler implements JobHandler
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
