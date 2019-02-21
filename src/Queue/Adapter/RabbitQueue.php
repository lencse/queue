<?php

namespace Lencse\Queue\Queue\Adapter;

use Lencse\Queue\Job\JobData;
use Lencse\Queue\Queue\Queue;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitQueue implements Queue
{
    /**
     * @var AMQPChannel
     */
    private $channel;

    public function __construct(string $host, int $port, string $user, string $password)
    {
        $conn = new AMQPStreamConnection($host, $port, $user, $password);
        $this->channel = $conn->channel();
        $this->channel->queue_declare('job', false, false, false, false);
    }


    public function saveJob(JobData $jobData): void
    {
        $this->channel->basic_publish(new AMQPMessage(serialize($jobData)), '', 'job');
    }
}