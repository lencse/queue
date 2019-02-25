<?php

namespace Lencse\Queue\Job;

final class Job
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $tries;

    public function __construct(int $id, int $tries)
    {
        $this->id = $id;
        $this->tries = $tries;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function tries(): int
    {
        return $this->tries;
    }

    public function incrementTries(): self
    {
        return new self($this->id(), $this->tries() + 1);
    }

    public static function create(IdGenerator $idGenerator): self
    {
        return new self($idGenerator->generate(), 0);
    }
}
