<?php

namespace Lencse\Queue\Job;

final class JobData
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
}
