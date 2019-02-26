<?php

namespace Lencse\Queue\Job\Processing;

use Lencse\Queue\Job\Handler\JobHandler;
use Lencse\Queue\Job\Job;
use Lencse\Queue\Random\RandomResult;

final class SuccessOrFail
{
    /**
     * @var RandomResult
     */
    private $randomResult;
    /**
     * @var int
     */
    private $maxTries;

    public function __construct(RandomResult $randomResult, int $maxTries)
    {
        $this->randomResult = $randomResult;
        $this->maxTries = $maxTries;
    }

    public function action(
        Job $job,
        JobHandler $successHandler,
        JobHandler $failHandler,
        JobHandler $permanentFailHandler
    ): void {
        if ($this->randomResult->success()) {
            $successHandler->handle($job);
        } elseif ($job->tries() < $this->maxTries - 1) {
            $failHandler->handle($job);
        } else {
            $permanentFailHandler->handle($job);
        }
    }
}
