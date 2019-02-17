<?php

namespace Lencse\Queue\Web\Json;

use Lencse\Queue\Job\JobData;

final class JobEncoder
{
    public function __invoke(JobData $data): string
    {
        $result = json_encode([
            'id' => $data->id()
        ]);
        return $result ?: '';
    }
}
