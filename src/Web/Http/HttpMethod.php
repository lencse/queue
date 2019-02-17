<?php

namespace Lencse\Queue\Web\Http;

final class HttpMethod
{
    /**
     * @var string
     */
    private $method;

    private function __construct(string $method)
    {
        $this->method = $method;
    }

    public static function get(): self
    {
        return new self('GET');
    }

    public static function post(): self
    {
        return new self('POST');
    }

    public function match(string $method): bool
    {
        return $method === $this->method;
    }
}
