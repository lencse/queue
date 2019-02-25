<?php

namespace Lencse\Queue\Job;

use Lencse\Queue\Logging\Logger;
use Lencse\Queue\Notification\Notifier;
use Lencse\Queue\Queue\Queue;

class ProcessJob
{
    /**
     * @var Queue
     */
    private $queue;

    /**
     * @var Logger
     */

    private $logger;
    /**
     * @var Notifier
     */
    private $notifier;

    public function __construct(Queue $queue, Logger $logger, Notifier $notifier)
    {
        $this->queue = $queue;
        $this->logger = $logger;
        $this->notifier = $notifier;
    }

    public function __invoke(Job $job)
    {
        if (1 === random_int(1, 4)) {
            $this->logger->log(sprintf('Job#%d processed', $job->id()));
        } elseif ($job->tries() < 2) {
            $this->logger->log(sprintf('Job#%d failed (%d), retrying', $job->id(), $job->tries() + 1));
            $this->queue->saveJob($job->incrementTries());
        } else {
            $this->notifier->notifyAboutFailedJob($job);
            $this->logger->log(sprintf('Job#%d failed permanently', $job->id()));
        }
    }
}
