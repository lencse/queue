#!/usr/bin/env php
<?php

require_once '../bootstrap.php';

$config = require '../config/config.php';

do {
   $r = @fsockopen($config['rabbitmq']['RABBITMQ_HOST'], (int) $config['rabbitmq']['RABBITMQ_PORT']);
} while (!is_resource($r));
