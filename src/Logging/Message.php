<?php

namespace Lencse\Queue\Logging;

use DateTimeInterface;

final class Message
{
    /**
     * @var string
     */
    private $msg;
    /**
     * @var DateTimeInterface
     */
    private $time;

    public function __construct(string $msg, DateTimeInterface $time)
    {
        $this->msg = $msg;
        $this->time = $time;
    }

    public function msg(): string
    {
        return $this->msg;
    }

    public function time(): DateTimeInterface
    {
        return $this->time;
    }
}
