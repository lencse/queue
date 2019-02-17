<?php

namespace Lencse\Queue\Web\Http;

interface ResponseRenderer
{
    public function render(JsonResponse $response): void;
}
