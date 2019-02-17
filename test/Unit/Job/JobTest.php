<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\Job;
use Lencse\Queue\Job\JobData;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    public function testCreate(): void
    {
        $job = Job::create(new class implements IdGenerator {
            public function generate(): int
            {
                return 1;
            }
        });
        $this->assertEquals(1, $job->id());
    }

    public function testFromUd(): void
    {
        $job = Job::fromData(new JobData(1));
        $this->assertEquals(1, $job->id());
    }
}
