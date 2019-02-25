<?php

namespace App;

use Lencse\Queue\DependencyInjection\Adapter\AurynContainer;
use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\RandomIdGenerator;
use Lencse\Queue\Logging\ConsoleLogger;
use Lencse\Queue\Logging\Logger;
use Lencse\Queue\Logging\MessageStore;
use Lencse\Queue\Logging\MongoLogger;
use Lencse\Queue\Logging\MongoMessageStore;
use Lencse\Queue\Mail\Mailer;
use Lencse\Queue\Mail\MailgunMailer;
use Lencse\Queue\Notification\EmailNotifier;
use Lencse\Queue\Notification\Notifier;
use Lencse\Queue\Queue\Adapter\RabbitQueue;
use Lencse\Queue\Queue\Queue;
use Lencse\Queue\Web\Http\RequestSource;
use Lencse\Queue\Web\Http\ResponseRenderer;
use Lencse\Queue\Web\Http\SimpleResponseRenderer;
use Lencse\Queue\Web\Http\SuperGlobalsRequestSource;
use Lencse\Queue\Web\Routing\Router;

$config = require 'config.php';

$dic = new AurynContainer();

$dic->alias(IdGenerator::class, RandomIdGenerator::class);
$dic->setup(RandomIdGenerator::class, $config['id-generator']);

$dic->alias(RequestSource::class, SuperGlobalsRequestSource::class);
$dic->setup(SuperGlobalsRequestSource::class, ['serverArr' => $_SERVER]);

$dic->alias(ResponseRenderer::class, SimpleResponseRenderer::class);

$dic->setup(Router::class, ['routes' => $config['routes']]);

$dic->alias(Queue::class, RabbitQueue::class);
$dic->setup(RabbitQueue::class, $config['rabbitmq']);

$dic->alias(Logger::class, MongoLogger::class);

$dic->alias(MessageStore::class, MongoMessageStore::class);

$dic->alias(Notifier::class, EmailNotifier::class);
$dic->setup(EmailNotifier::class, $config['notification-mail']);

$dic->alias(Mailer::class, MailgunMailer::class);
$dic->setup(MailgunMailer::class, $config['mailgun']);

$dic->factory(
    CreateJob::class,
    function () use ($dic) {
        return CreateJob::create($dic->get(IdGenerator::class), $dic->get(Queue::class));
    }
);

return $dic;
