<?php

namespace Lencse\Queue\Queue\Adapter;

use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitSetup
{
    /**
     * @var AMQPStreamConnection
     */
    private $rabbitMq;

    /**
     * @var string
     */
    private $queueName;

    public function __construct(AMQPStreamConnection $rabbitMq, string $queueName)
    {
        $this->rabbitMq = $rabbitMq;
        $this->queueName = $queueName;
    }

    public function rabbitMq(): AMQPStreamConnection
    {
        return $this->rabbitMq;
    }

    public function queueName(): string
    {
        return $this->queueName;
    }
}
