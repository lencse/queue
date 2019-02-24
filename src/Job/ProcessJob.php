<?php

namespace Lencse\Queue\Job;

use Lencse\Queue\Queue\Queue;

class ProcessJob
{
    /**
     * @var Queue
     */
    private $queue;
    /**
     * @var JobDataMapper
     */
    private $jobDataMapper;

    public function __construct(Queue $queue, JobDataMapper $jobDataMapper)
    {
        $this->queue = $queue;
        $this->jobDataMapper = $jobDataMapper;
    }

    public function __invoke(JobData $jobData)
    {
        $job = Job::fromData($jobData);
        var_dump($job);
//        printf('%d:%d', $job->id(), $job->tries());
        if (1 === random_int(1, 4)) {
        } else {
            $this->queue->saveJob($this->jobDataMapper->jobToData($job->incrementTries()));
        }
    }
}
