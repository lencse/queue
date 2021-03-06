<?php

namespace Lencse\Queue\Adapter\Id;

use Lencse\Queue\Id\IdGenerator;

final class RandomIdGenerator implements IdGenerator
{
    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function generate(): int
    {
        return random_int($this->min, $this->max);
    }
}
