<?php

namespace Lencse\Queue\Web\Json;

use Lencse\Queue\Job\Job;

final class JobEncoder
{
    public function __invoke(Job $job): string
    {
        $result = json_encode([
            'id' => $job->id(),
        ]);

        return $result ?: '';
    }
}
