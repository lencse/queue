<?php

namespace Lencse\Queue\Job;

class ProcessJob
{
    /**
     * @var SuccessOrFail
     */

    private $successOrFail;

    /**
     * @var JobSuccesHandler
     */

    private $successHandler;
    /**
     * @var JobFailHandler
     */

    private $failHandler;
    /**
     * @var JobPermanentFailHandler
     */
    private $permanentFailHandler;

    public function __construct(
        SuccessOrFail $successOrFail,
        JobSuccesHandler$successHandler,
        JobFailHandler $failHandler,
        JobPermanentFailHandler $permanentFailHandler
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
