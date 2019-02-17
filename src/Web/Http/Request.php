<?php

namespace Lencse\Queue\Web\Http;

final class Request
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    public function __construct(string $uri, string $method)
    {
        $this->uri = $uri;
        $this->method = $method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function method(): string
    {
        return $this->method;
    }
}
