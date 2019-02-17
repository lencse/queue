#!/usr/bin/env bash

docker-compose up -d
docker-compose run php composer install --prefer-dist --no-interaction
