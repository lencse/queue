<?php

namespace Lencse\Queue\Job;

final class SuccessOrFail
{
    public function action(
        Job $job,
        JobHandler $successHandler,
        JobHandler $failHandler,
        JobHandler $permanentFailHandler
    ): void {
        if (1 === random_int(1, 4)) {
            $successHandler->handle($job);
        } elseif ($job->tries() < 2) {
            $failHandler->handle($job);
        } else {
            $permanentFailHandler->handle($job);
        }
    }
}
