<?php

namespace Lencse\Queue\Web\Http;

final class Response
{
    /**
     * @var string[]
     */
    private $headers;

    /**
     * @var string
     */
    private $content;

    public function __construct(array $headers, string $content)
    {
        $this->headers = $headers;
        $this->content = $content;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function content(): string
    {
        return $this->content;
    }
}
