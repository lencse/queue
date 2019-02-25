<?php

namespace Lencse\Queue\Job\Handler;

use Lencse\Queue\Job\Handler\JobHandler;
use Lencse\Queue\Job\Job;
use Lencse\Queue\Logging\Logger;

final class SuccesHandler implements JobHandler
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
