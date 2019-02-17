<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Job\IdGenerator;
use PHPUnit\Framework\TestCase;

class CreateJobTest extends TestCase
{
    public function testCreate(): void
    {
        $createJob = CreateJob::create(new class implements IdGenerator {
            public function generate(): int
            {
                return 1;
            }
        });
        $result = $createJob();
        $this->assertEquals(1, $result->id());
    }
}
