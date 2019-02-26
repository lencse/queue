<?php

namespace Lencse\Queue\Adapter\Queue;

use Lencse\Queue\Job\Job;
use Lencse\Queue\Queue\Queue;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitQueue implements Queue
{
    /**
     * @var RabbitSetup
     */
    private $rabbitSetup;

    public function __construct(RabbitSetup $rabbitSetup)
    {
        $this->rabbitSetup = $rabbitSetup;
    }

    public function saveJob(Job $job): void
    {
        $channel = $this->rabbitSetup->rabbitMq()->channel();
        $channel->queue_declare($this->rabbitSetup->queueName(), false, false, false, false);
        $channel->basic_publish(new AMQPMessage(serialize($job)), '', $this->rabbitSetup->queueName());
    }
}
