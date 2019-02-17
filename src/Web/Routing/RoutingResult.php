<?php

namespace Lencse\Queue\Web\Routing;

final class RoutingResult
{
    /**
     * @var Handler
     */
    private $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function handler(): Handler
    {
        return $this->handler;
    }
}
