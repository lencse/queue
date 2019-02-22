#!/usr/bin/env php
<?php

namespace App;

use Lencse\Queue\Application\Application;
use Lencse\Queue\DependencyInjection\Container;
use Lencse\Queue\Web\Application\WebApplication;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once '../bootstrap.php';

/** @var Container $dic */
$dic = require '../config/dic.php';

///** @var Application $app */
//$app = $dic->get(WebApplication::class);
//$app->run();


do {
   $r = @fsockopen(env('RABBITMQ_HOST'), (int) env('RABBITMQ_PORT'));
} while (!is_resource($r));

//while (!$conn) {
//    try {
$conn = new AMQPStreamConnection(env('RABBITMQ_HOST'), (int) env('RABBITMQ_PORT'), env('RABBITMQ_USER'), env('RABBITMQ_PASSWORD'));
//    } catch (\Throwable $e) {}
//}
$channel = $conn->channel();

$channel->queue_declare('job', false, false, false, false);

$callback = function (AMQPMessage $msg) {
    var_dump(unserialize($msg->body));
};

$channel->basic_consume('job', '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

var_dump('XXX');
