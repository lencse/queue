<?php

namespace Lencse\Queue\Job;

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

    private function __construct(IdGenerator $idGenerator, JobDataMapper $dataMapper)
    {
        $this->idGenerator = $idGenerator;
        $this->dataMapper = $dataMapper;
    }

    public static function create(IdGenerator $idGenerator): self
    {
        return new self($idGenerator, new JobDataMapper());
    }

    public function __invoke(): JobData
    {
        return $this->dataMapper->jobToData(Job::create($this->idGenerator));
    }
}
