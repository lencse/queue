<?php

namespace Lencse\Queue\Job;

final class SuccessOrFail
{
    /**
     * @var RandomResult
     */
    private $randomResult;

    public function __construct(RandomResult $randomResult)
    {
        $this->randomResult = $randomResult;
    }

    public function action(
        Job $job,
        JobHandler $successHandler,
        JobHandler $failHandler,
        JobHandler $permanentFailHandler
    ): void {
        if ($this->randomResult->success()) {
            $successHandler->handle($job);
        } elseif ($job->tries() < 2) {
            $failHandler->handle($job);
        } else {
            $permanentFailHandler->handle($job);
        }
    }
}
