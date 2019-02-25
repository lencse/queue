<?php

namespace Test\Unit\Web;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Logging\Message;
use Lencse\Queue\Web\Json\JobEncoder;
use Lencse\Queue\Web\Json\MessageArrayEncoder;
use PHPUnit\Framework\TestCase;

class MessageArrayEncoderTest extends TestCase
{
    public function testEncode()
    {
        $encoder = new MessageArrayEncoder();
        $this->assertEquals('[{"msg":"","time":"946684800.000000"}]', $encoder([
            new Message('', \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00'))
        ]));
    }
}
