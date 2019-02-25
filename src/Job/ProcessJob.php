<?php

namespace Lencse\Queue\Job;

use Lencse\Queue\Job\Handler\FailHandler;
use Lencse\Queue\Job\Handler\PermanentFailHandler;
use Lencse\Queue\Job\Handler\SuccesHandler;
use Lencse\Queue\Job\Processing\SuccessOrFail;

final class ProcessJob
{
    /**
     * @var SuccessOrFail
     */
    private $successOrFail;

    /**
     * @var SuccesHandler
     */
    private $successHandler;
    /**
     * @var FailHandler
     */
    private $failHandler;
    /**
     * @var PermanentFailHandler
     */
    private $permanentFailHandler;

    public function __construct(
        SuccessOrFail $successOrFail,
        SuccesHandler $successHandler,
        FailHandler $failHandler,
        PermanentFailHandler $permanentFailHandler
    ) {
        $this->successOrFail = $successOrFail;
        $this->successHandler = $successHandler;
        $this->failHandler = $failHandler;
        $this->permanentFailHandler = $permanentFailHandler;
    }

    public function __invoke(Job $job)
    {
        $this->successOrFail->action(
            $job,
            $this->successHandler,
            $this->failHandler,
            $this->permanentFailHandler
        );
    }
}
