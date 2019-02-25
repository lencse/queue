<?php

namespace App;

use Lencse\Queue\DependencyInjection\Adapter\AurynContainer;
use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\RandomIdGenerator;
use Lencse\Queue\Job\RandomResult;
use Lencse\Queue\Job\RealRandomResult;
use Lencse\Queue\Logging\Logger;
use Lencse\Queue\Logging\MessageStore;
use Lencse\Queue\Logging\MongoLogger;
use Lencse\Queue\Logging\MongoMessageStore;
use Lencse\Queue\Mail\Mailer;
use Lencse\Queue\Mail\MailgunMailer;
use Lencse\Queue\Notification\EmailNotifier;
use Lencse\Queue\Notification\Notifier;
use Lencse\Queue\Queue\Adapter\RabbitQueue;
use Lencse\Queue\Queue\Adapter\RabbitSetup;
use Lencse\Queue\Queue\Queue;
use Lencse\Queue\Web\Http\RequestSource;
use Lencse\Queue\Web\Http\ResponseRenderer;
use Lencse\Queue\Web\Http\SimpleResponseRenderer;
use Lencse\Queue\Web\Http\SuperGlobalsRequestSource;
use Lencse\Queue\Web\Routing\Router;
use MongoDB\Driver\Manager;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$config = require 'config.php';

$dic = new AurynContainer();

$dic->alias(IdGenerator::class, RandomIdGenerator::class);
$dic->setup(RandomIdGenerator::class, $config['id-generator']);

$dic->alias(RequestSource::class, SuperGlobalsRequestSource::class);
$dic->setup(SuperGlobalsRequestSource::class, ['serverArr' => $_SERVER]);

$dic->alias(ResponseRenderer::class, SimpleResponseRenderer::class);

$dic->setup(Router::class, ['routes' => require 'routes.php']);

$dic->alias(Queue::class, RabbitQueue::class);

$dic->setup(AMQPStreamConnection::class, $config['rabbitmq']);

$dic->setup(RabbitSetup::class, $config['rabbitmq']);

$dic->setup(Manager::class, ['uri' => $config['mongo']['url']]);

$dic->alias(Logger::class, MongoLogger::class);
$dic->setup(MongoLogger::class, ['collection' => $config['mongo']['collection']]);

$dic->alias(MessageStore::class, MongoMessageStore::class);
$dic->setup(MongoMessageStore::class, ['collection' => $config['mongo']['collection']]);

$dic->alias(Notifier::class, EmailNotifier::class);
$dic->setup(EmailNotifier::class, $config['notification-mail']);

$dic->alias(Mailer::class, MailgunMailer::class);
$dic->setup(MailgunMailer::class, $config['mailgun']);

$dic->alias(RandomResult::class, RealRandomResult::class);
$dic->setup(RealRandomResult::class, $config['random']);

return $dic;
