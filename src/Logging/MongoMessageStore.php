<?php

namespace Lencse\Queue\Logging;

use DateTimeImmutable;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

class MongoMessageStore implements MessageStore
{
    public function getMessages(): array
    {
        $manager = new Manager('mongodb://mongodb:27017/queue');
        $query = new Query([], ['sort' => ['time' => -1]]);
        $cursor = $manager->executeQuery('queue.logs', $query);
        $result = [];
        foreach ($cursor as $doc) {
            /** @var DateTimeImmutable $ts */
            $ts = DateTimeImmutable::createFromFormat('U.u', $doc->timestamp);
            $result[] = new Message($doc->msg, $ts);
        }

        return $result;
    }

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
