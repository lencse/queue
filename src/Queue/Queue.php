<?php

namespace Lencse\Queue\Queue;

use Lencse\Queue\Job\Job;

interface Queue
{
    public function saveJob(Job $job): void;
}
