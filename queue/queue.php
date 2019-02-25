#!/usr/bin/env php
<?php

namespace App;

use Lencse\Queue\Application\Application;
use Lencse\Queue\DependencyInjection\Container;
use Lencse\Queue\Queue\QueueApplication;

require_once '../bootstrap.php';

/** @var Container $dic */
$dic = require '../config/dic.php';

/** @var Application $app */
$app = $dic->get(QueueApplication::class);
$app->run();
