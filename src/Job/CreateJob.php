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
     * @var JobDataMapper
     */
    private $dataMapper;

    /**
     * @var Queue
     */
    private $queue;

    private function __construct(
        IdGenerator $idGenerator,
        JobDataMapper $dataMapper,
        Queue $queue
    ) {
        $this->idGenerator = $idGenerator;
        $this->dataMapper = $dataMapper;
        $this->queue = $queue;
    }

    public static function create(IdGenerator $idGenerator, Queue $queue): self
    {
        return new self($idGenerator, new JobDataMapper(), $queue);
    }

    public function __invoke(): JobData
    {
        $jobData = $this->dataMapper->jobToData(Job::create($this->idGenerator));
        $this->queue->saveJob($jobData);

        return $jobData;
    }
}
