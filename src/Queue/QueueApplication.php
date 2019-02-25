<?php

namespace Lencse\Queue\Queue;

use Lencse\Queue\Application\Application;
use Lencse\Queue\Job\Job;
use Lencse\Queue\Job\ProcessJob;
use Lencse\Queue\Queue\Adapter\RabbitSetup;
use PhpAmqpLib\Message\AMQPMessage;

final class QueueApplication implements Application
{
    /**
     * @var ProcessJob
     */
    private $processJob;

    /**
     * @var RabbitSetup
     */
    private $rabbitSetup;

    public function __construct(ProcessJob $processJob, RabbitSetup $rabbitSetup)
    {
        $this->processJob = $processJob;
        $this->rabbitSetup = $rabbitSetup;
    }

    public function run(): void
    {
        $channel = $this->rabbitSetup->rabbitMq()->channel();

        $channel->queue_declare($this->rabbitSetup->queueName(), false, false, false, false);

        $process = $this->processJob;

        $callback = function (AMQPMessage $msg) use ($process) {
            $process(unserialize($msg->body, [Job::class]));
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $channel->basic_consume($this->rabbitSetup->queueName(), '', false, false, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
