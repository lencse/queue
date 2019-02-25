<?php

namespace Lencse\Queue\Job;

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
