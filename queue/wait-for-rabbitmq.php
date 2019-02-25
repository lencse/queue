#!/usr/bin/env php
<?php

require_once '../bootstrap.php';

do {
   $r = @fsockopen(env('RABBITMQ_HOST'), (int) env('RABBITMQ_PORT'));
} while (!is_resource($r));
