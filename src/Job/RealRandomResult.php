<?php

namespace Lencse\Queue\Job;

final class RealRandomResult implements RandomResult
{
    /**
     * @var int
     */
    private $successProbability;

    /**
     * @var int
     */
    private $failureProbability;

    public function __construct(string $successFailureRatio)
    {
        [$s1, $s2] = explode(':', $successFailureRatio);
        $this->successProbability = (int) $s1;
        $this->failureProbability = (int) $s2;
    }

    public function success(): bool
    {
        return random_int(1, $this->successProbability + $this->failureProbability) <= $this->successProbability;
    }
}
