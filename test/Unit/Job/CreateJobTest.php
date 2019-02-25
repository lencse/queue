<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\Job;
use Lencse\Queue\Queue\Queue;
use PHPUnit\Framework\TestCase;

class CreateJobTest extends TestCase
{
    public function testCreate(): void
    {
        $queue = new class implements Queue {
            /**
             * @var Job
             */
            private $job;

            public function saveJob(Job $job): void
            {
                $this->job = $job;
            }

            public function job(): Job
            {
                return $this->job;
            }
        };
        $createJob = new CreateJob(
            new class implements IdGenerator {
                public function generate(): int
                {
                    return 1;
                }
            },
            $queue
        );
        $result = $createJob();
        $this->assertEquals(1, $result->id());
        $this->assertEquals(new Job(1, 0), $queue->job());
    }
}
