<?php

namespace Lencse\Queue\Web\Http;

final class JsonResponse implements Response
{
    /**
     * @var string
     */
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function headers(): array
    {
        return [
            'HTTP/1.1 200 OK',
            'Content-Type: application/json; charset=utf-8',
        ];
    }

    public function content(): string
    {
        return $this->content;
    }
}
