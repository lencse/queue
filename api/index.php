<?php

namespace App;

use Lencse\Queue\Application\Application;
use Lencse\Queue\DependencyInjection\Adapter\AurynContainer;
use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Job\IdGenerator;
use Lencse\Queue\Job\RandomIdGenerator;
use Lencse\Queue\Web\Application\WebApplication;
use Lencse\Queue\Web\Http\HttpMethod;
use Lencse\Queue\Web\Http\RequestSource;
use Lencse\Queue\Web\Http\ResponseRenderer;
use Lencse\Queue\Web\Http\SimpleResponseRenderer;
use Lencse\Queue\Web\Http\SuperGlobalsRequestSource;
use Lencse\Queue\Web\Json\JobEncoder;
use Lencse\Queue\Web\Routing\Handler;
use Lencse\Queue\Web\Routing\Path;
use Lencse\Queue\Web\Routing\Route;
use Lencse\Queue\Web\Routing\Router;

require_once '../bootstrap.php';

$dic = new AurynContainer();
$dic->alias(IdGenerator::class, RandomIdGenerator::class);
$dic->setup(RandomIdGenerator::class, ['min' => 1, 'max' => 9999]);
$dic->alias(RequestSource::class, SuperGlobalsRequestSource::class);
$dic->setup(SuperGlobalsRequestSource::class, ['serverArr' => $_SERVER]);
$dic->alias(ResponseRenderer::class, SimpleResponseRenderer::class);

$dic->setup(Router::class, ['routes' => [
    new Route(HttpMethod::post(), new Path('/api/job'), new Handler(CreateJob::class, JobEncoder::class)),
]]);

$dic->factory(
    CreateJob::class,
    function () use ($dic) {
        return CreateJob::create($dic->get(IdGenerator::class));
    }
);

/** @var Application $app */
$app = $dic->get(WebApplication::class);
$app->run();
