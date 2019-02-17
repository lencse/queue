<?php

namespace Lencse\Queue\Web\Routing;

class Handler
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $encoder;

    public function __construct(string $action, string $encoder)
    {
        $this->action = $action;
        $this->encoder = $encoder;
    }

    public function action(): string
    {
        return $this->action;
    }

    public function encoder(): string
    {
        return $this->encoder;
    }
}
