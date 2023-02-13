<?php

use Ivoz\Core\Domain\RegisterCommandTrait;
use Ivoz\Core\Domain\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Service\BillableCallHistoric\ImportFromBillableCalls;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class BillableCallHistoricController
{
    use RegisterCommandTrait;

    public function __construct(
        private ImportFromBillableCalls $importFromBillableCalls,
        private LoggerInterface $logger,
        DomainEventPublisher $eventPublisher,
        RequestId $requestId
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function indexAction(): Response
    {
        try {
            $this->registerCommand('Scheduler', 'billableCallHistoric');
            $affectedRows = $this->importFromBillableCalls->execute();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response(
            "BillableCallHistoric rotation done! " . $affectedRows . " rows rotated\n",
            200
        );
    }
}
