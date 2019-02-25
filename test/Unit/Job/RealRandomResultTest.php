<?php

namespace Test\Unit\Job;

use Lencse\Queue\Job\RealRandomResult;
use PHPUnit\Framework\TestCase;

class RealRandomResultTest extends TestCase
{
    public function testSuccess(): void
    {
        $random = new RealRandomResult('1:0');
        for ($i = 0; $i < 100; $i++) {
            $this->assertTrue($random->success());
        }
    }

    public function testFailure(): void
    {
        $random = new RealRandomResult('0:1');
        for ($i = 0; $i < 100; $i++) {
            $this->assertFalse($random->success());
        }
    }
}
