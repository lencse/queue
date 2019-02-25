<?php

namespace App;

return [
    'id-generator' => [
        'min' => (int) env('JOB_ID_MIN_VALUE'),
        'max' => (int) env('JOB_ID_MAX_VALUE'),
    ],
    'random' => [
        'successFailureRatio' => env('SUCCESS_FAILURE_RATIO'),
    ],
    'rabbitmq' => [
        'host' => env('RABBITMQ_HOST'),
        'port' => env('RABBITMQ_PORT'),
        'user' => env('RABBITMQ_USER'),
        'password' => env('RABBITMQ_PASSWORD'),
    ],
    'notification-mail' => [
        'from' => env('NOTIFICATION_MAIL_FROM'),
        'to' => env('NOTIFICATION_MAIL_TO'),
    ],
    'mailgun' => [
        'apiKey' => env('MAILGUN_API_KEY'),
        'apiUrl' => env('MAILGUN_API_URL'),
        'domain' => env('MAILGUN_API_DOMAIN'),
    ],
    'mongo' => [
        'url' => env('MONGO_URL'),
        'collection' => env('MONGO_COLLECTION'),
    ],
];
