<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\CallCsvReport\CreateByScheduler;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerRepository;

class CallCsvController
{
    /**
     * @var CreateByScheduler
     */
    private $callCsvReport;

    /**
     * @var CallCsvSchedulerRepository
     */
    private $callCsvSchedulerRepository;

    public function __construct(
        CreateByScheduler $callCsvReportCreator,
        CallCsvSchedulerRepository $callCsvSchedulerRepository
    ) {
        $this->callCsvReport = $callCsvReportCreator;
        $this->callCsvSchedulerRepository = $callCsvSchedulerRepository;
    }

    public function indexAction()
    {
        $errors = [];
        $callCsvSchedulers = $this->callCsvSchedulerRepository->getPendingSchedulers();

        foreach ($callCsvSchedulers as $callCsvScheduler) {
            try {
                $this->callCsvReport->execute($callCsvScheduler);
            } catch (\Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        if (count($errors)) {
            return new Response(
                implode("\n", $errors),
                500
            );
        }

        return new Response("Done!\n", 200);
    }
}
