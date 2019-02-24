<?php

namespace Lencse\Queue\Logging;

interface MessageStore
{
    /**
     * @return Message[]
     */
    public function getMessages(): array;
}
