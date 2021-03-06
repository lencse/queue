<?php

namespace Lencse\Queue\Job\Handler;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Logging\Logger;
use Lencse\Queue\Queue\Queue;

final class FailHandler implements JobHandler
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Queue
     */
    private $queue;

    public function __construct(Logger $logger, Queue $queue)
    {
        $this->logger = $logger;
        $this->queue = $queue;
    }

    public function handle(Job $job): void
    {
        $this->logger->log(sprintf('Job#%d failed (%d), retrying', $job->id(), $job->tries() + 1));
        $this->queue->saveJob($job->incrementTries());
    }
}
