#!/usr/bin/env bash

cd /app
composer install --prefer-dist --no-interaction

cd /app/queue

echo "Waiting for RabbitMQ service..."
./wait-for-rabbitmq.php

echo "Starting queue..."
until ./queue.php; do
    sleep 1
done
