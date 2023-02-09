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

    public function __construct(
        private CreateByScheduler $callCsvReport,
        private CallCsvSchedulerRepository $callCsvSchedulerRepository,
        DomainEventPublisher $eventPublisher,
        RequestId $requestId
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function indexAction(): Response
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
