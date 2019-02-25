#!/usr/bin/env php
<?php

namespace App;

use Lencse\Queue\Application\Application;
use Lencse\Queue\DependencyInjection\Container;
use Lencse\Queue\Job\Job;
use Lencse\Queue\Job\ProcessJob;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once '../bootstrap.php';

/** @var Container $dic */
$dic = require '../config/dic.php';

$conn = new AMQPStreamConnection(env('RABBITMQ_HOST'), (int) env('RABBITMQ_PORT'), env('RABBITMQ_USER'), env('RABBITMQ_PASSWORD'));
$channel = $conn->channel();

$channel->queue_declare('job', false, false, false, false);

/** @var ProcessJob $process */
$process = $dic->get(ProcessJob::class);

$callback = function (AMQPMessage $msg) use ($process) {
    $process(unserialize($msg->body, [Job::class]));
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_consume('job', '', false, false, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}
