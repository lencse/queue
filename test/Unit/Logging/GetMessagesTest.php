<?php

namespace Test\Unit\Logging;

use Lencse\Queue\Logging\GetMessages;
use Lencse\Queue\Logging\Message;
use Lencse\Queue\Logging\MessageStore;
use PHPUnit\Framework\TestCase;

class GetMessagesTest extends TestCase
{
    public function testGetMessages(): void
    {
        $getMessages = new GetMessages(new class implements MessageStore {
            public function getMessages(): array
            {
                return [
                    new Message('msg', \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00')),
                ];
            }
        });
        /** @var Message $msg */
        $msg = $getMessages()[0];
        $this->assertEquals('msg', $msg->msg());
        $this->assertEquals(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00'), $msg->time());
    }

}
