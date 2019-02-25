<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\Job;
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
        $this->assertEquals(0, $job->tries());
    }
}
