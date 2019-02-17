<?php

namespace App;

use Lencse\Queue\DependencyInjection\Adapter\AurynContainer;
use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\RandomIdGenerator;
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

$dic->factory(
    CreateJob::class,
    function () use ($dic) {
        return CreateJob::create($dic->get(IdGenerator::class));
    }
);

return $dic;