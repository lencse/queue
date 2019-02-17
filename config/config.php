<?php

namespace App;

use Lencse\Queue\Job\CreateJob;
use Lencse\Queue\Web\Http\HttpMethod;
use Lencse\Queue\Web\Json\JobEncoder;
use Lencse\Queue\Web\Routing\Handler;
use Lencse\Queue\Web\Routing\Path;
use Lencse\Queue\Web\Routing\Route;

return [
    'id-generator' => [
        'min' => (int) env('JOB_ID_MIN_VALUE'),
        'max' => (int) env('JOB_ID_MAX_VALUE'),
    ],
    'routes' => [
        new Route(HttpMethod::post(), new Path('/api/job'), new Handler(CreateJob::class, JobEncoder::class)),
    ]
];
