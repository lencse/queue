<?php

namespace Lencse\Queue\Logging;

final class GetMessages
{
    /**
     * @var MessageStore
     */
    private $messageStore;

    public function __construct(MessageStore $messageStore)
    {
        $this->messageStore = $messageStore;
    }

    /**
     * @return Message[]
     */
    public function __invoke(): array
    {
        return $this->messageStore->getMessages();
    }
}
