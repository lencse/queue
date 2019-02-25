<?php

namespace Lencse\Queue\Job;

use Lencse\Queue\Logging\Logger;

final class JobSuccesHandler implements JobHandler
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Job $job): void
    {
        $this->logger->log(sprintf('Job#%d processed', $job->id()));
    }
}
