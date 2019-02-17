<?php

require_once 'vendor/autoload.php';

function env(string $key, string $default = ''): string
{
    return $_ENV[$key] ?? $default;
}

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = \Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
}
