<?php

namespace Lencse\Queue\Job;

interface JobHandler
{
    public function handle(Job $job): void;
}
