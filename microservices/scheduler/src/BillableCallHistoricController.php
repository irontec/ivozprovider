<?php

use Ivoz\Core\Application\RegisterCommandTrait;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Service\BillableCallHistoric\ImportFromBillableCalls;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class BillableCallHistoricController
{
    use RegisterCommandTrait;

    private $importFromBillableCalls;
    private $eventPublisher;
    private $requestId;
    private $logger;

    public function __construct(
        ImportFromBillableCalls $importFromBillableCalls,
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        LoggerInterface $logger
    ) {
        $this->importFromBillableCalls = $importFromBillableCalls;
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->logger = $logger;
    }

    public function indexAction()
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
