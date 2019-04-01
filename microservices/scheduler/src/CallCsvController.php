<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\CallCsvReport\CreateByScheduler;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerRepository;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RegisterCommandTrait;
use Ivoz\Core\Application\RequestId;

class CallCsvController
{
    use RegisterCommandTrait;

    private $eventPublisher;
    private $requestId;
    private $callCsvReport;
    private $callCsvSchedulerRepository;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        CreateByScheduler $callCsvReportCreator,
        CallCsvSchedulerRepository $callCsvSchedulerRepository
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->callCsvReport = $callCsvReportCreator;
        $this->callCsvSchedulerRepository = $callCsvSchedulerRepository;
    }

    public function indexAction()
    {
        $errors = [];
        $this->registerCommand('Scheduler', 'callCsv');
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
