<?php

namespace Lencse\Queue\Notification;

use Lencse\Queue\Job\Job;

interface Notifier
{
    public function notifyAboutFailedJob(Job $job): void;
}
