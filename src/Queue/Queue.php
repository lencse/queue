<?php

namespace Lencse\Queue\Queue;

use Lencse\Queue\Job\JobData;

interface Queue
{
    public function saveJob(JobData $jobData): void;
}
