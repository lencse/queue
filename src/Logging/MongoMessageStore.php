<?php

namespace Lencse\Queue\Logging;

use DateTimeImmutable;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

final class MongoMessageStore implements MessageStore
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

    public function getMessages(): array
    {
        $query = new Query([], ['sort' => ['time' => -1]]);
        $cursor = $this->mongo->executeQuery($this->collection, $query);
        $result = [];
        foreach ($cursor as $doc) {
            /** @var DateTimeImmutable $ts */
            $ts = DateTimeImmutable::createFromFormat('U.u', $doc->timestamp);
            $result[] = new Message($doc->msg, $ts);
        }

        return $result;
    }
}
