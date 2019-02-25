<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\RandomIdGenerator;
use PHPUnit\Framework\TestCase;

class RandomIdGeneratorTest extends TestCase
{
    public function testGenerate(): void
    {
        $generator = new RandomIdGenerator(1, 5);
        for ($i = 0; $i < 100; $i++) {
            $id = $generator->generate();
            $this->assertGreaterThanOrEqual(1, $id);
            $this->assertLessThanOrEqual(5, $id);
        }
    }
}
