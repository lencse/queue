<?php

namespace Lencse\Queue\Job\Handler;

use Lencse\Queue\Job\Job;

interface JobHandler
{
    public function handle(Job $job): void;
}
