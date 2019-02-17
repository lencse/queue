<?php

namespace Lencse\Queue\Web\Http;

interface Response
{
    public function headers(): array;

    public function content(): string;
}