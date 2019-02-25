<?php

namespace Lencse\Queue\Job;

use Lencse\Queue\Queue\Queue;

final class CreateJob
{
    /**
     * @var IdGenerator
     */
    private $idGenerator;

    /**
     * @var Queue
     */
    private $queue;

    public function __construct(IdGenerator $idGenerator, Queue $queue) {
        $this->idGenerator = $idGenerator;
        $this->queue = $queue;
    }

    public function __invoke(): Job
    {
        $job =Job::create($this->idGenerator);
        $this->queue->saveJob($job);

        return $job;
    }
}
