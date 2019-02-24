<?php

namespace Lencse\Queue\Job;

final class JobDataMapper
{
    public function jobToData(Job $job): JobData
    {
        return new JobData($job->id(), $job->tries());
    }
}
