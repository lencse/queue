<?php

namespace Lencse\Queue\Web\Http;

final class SimpleResponseRenderer implements ResponseRenderer
{
    public function render(JsonResponse $response): void
    {
        foreach ($response->headers() as $header) {
            header($header);
        }
        echo $response->content();
    }
}
