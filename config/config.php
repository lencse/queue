<?php

namespace App;

use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Logging\GetMessages;
use Lencse\Queue\Web\Http\HttpMethod;
use Lencse\Queue\Web\Json\JobEncoder;
use Lencse\Queue\Web\Json\MessageArrayEncoder;
use Lencse\Queue\Web\Routing\Handler;
use Lencse\Queue\Web\Routing\Path;
use Lencse\Queue\Web\Routing\Route;

return [
    'id-generator' => [
        'min' => (int) env('JOB_ID_MIN_VALUE'),
        'max' => (int) env('JOB_ID_MAX_VALUE'),
    ],
    'rabbitmq' => [
        'host' => env('RABBITMQ_HOST'),
        'port' => env('RABBITMQ_PORT'),
        'user' => env('RABBITMQ_USER'),
        'password' => env('RABBITMQ_PASSWORD'),
    ],
    'routes' => [
        new Route(HttpMethod::post(), new Path('/api/job'), new Handler(CreateJob::class, JobEncoder::class)),
        new Route(HttpMethod::get(), new Path('/api/log-messages'), new Handler(GetMessages::class, MessageArrayEncoder::class)),
    ],
];
