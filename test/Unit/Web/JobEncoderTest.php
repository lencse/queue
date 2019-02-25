<?php

namespace Test\Unit\Web;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Web\Json\JobEncoder;
use PHPUnit\Framework\TestCase;

class JobEncoderTest extends TestCase
{
    public function testEncode()
    {
        $encoder = new JobEncoder();
        $this->assertEquals('{"id":0}', $encoder(new Job(0, 0)));
    }
}
