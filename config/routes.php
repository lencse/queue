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
        new Route(
            HttpMethod::post(),
            new Path('/api/job'),
            new Handler(CreateJob::class, JobEncoder::class)
        ),
        new Route(
            HttpMethod::get(),
            new Path('/api/log-messages'),
            new Handler(GetMessages::class, MessageArrayEncoder::class)
        ),
];
