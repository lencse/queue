<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\JobData;
use Lencse\Queue\Queue\Queue;
use PHPUnit\Framework\TestCase;

class CreateJobTest extends TestCase
{
    public function testCreate(): void
    {
        $queue = new class implements Queue {
            /**
             * @var JobData
             */
            private $jobData;

            public function saveJob(JobData $jobData): void
            {
                $this->jobData = $jobData;
            }

            public function jobData(): JobData
            {
                return $this->jobData;
            }
        };
        $createJob = CreateJob::create(
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
        $this->assertEquals(new JobData(1), $queue->jobData());
    }
}
