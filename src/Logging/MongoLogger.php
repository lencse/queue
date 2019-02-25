<?php

namespace Lencse\Queue\Logging;

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;

final class MongoLogger implements Logger
{
    /**
     * @var Manager
     */
    private $mongo;
    /**
     * @var string
     */
    private $collection;

    public function __construct(Manager $mongo, string $collection)
    {
        $this->mongo = $mongo;
        $this->collection = $collection;
    }

    public function log(string $msg): void
    {
        $bulk = new BulkWrite();
        $bulk->insert([
            'msg' => $msg,
            'timestamp' => microtime(true),
        ]);
        $this->mongo->executeBulkWrite($this->collection, $bulk);
    }
}
