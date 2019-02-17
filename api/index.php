<?php

namespace App;

use Lencse\Queue\Application\Application;
use Lencse\Queue\DependencyInjection\Container;
use Lencse\Queue\Web\Application\WebApplication;

require_once '../bootstrap.php';

/** @var Container $dic */
$dic = require '../config/dic.php';

/** @var Application $app */
$app = $dic->get(WebApplication::class);
$app->run();
