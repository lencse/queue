<?php

namespace Lencse\Queue\Queue\Adapter;

use Lencse\Queue\Job\JobData;
use Lencse\Queue\Queue\Queue;

class RabbitQueue implements Queue
{
    public function saveJob(JobData $jobData): void
    {
        // TODO: Implement saveJob() method.
    }
}
