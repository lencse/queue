<?php

namespace Lencse\Queue\Logging;

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;

class MongoLogger implements Logger
{
    public function log(string $msg): void
    {
        $manager = new Manager('mongodb://mongodb:27017/queue');
        $bulk = new BulkWrite();
        $bulk->insert([
            'msg' => $msg,
            'timestamp' => microtime(true),
        ]);
        $manager->executeBulkWrite('queue.logs', $bulk);
    }
}
