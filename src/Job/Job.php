<?php

namespace Lencse\Queue\Job;

final class Job
{
    /**
     * @var int
     */
    private $id;

    private function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }

    public static function create(IdGenerator $idGenerator): self
    {
        return new self($idGenerator->generate());
    }

    public static function fromId(int $id): self
    {
        return new self($id);
    }
}
