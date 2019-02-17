<?php

namespace Lencse\Queue\Web\Http;

interface RequestSource
{
    public function create(): Request;
}
