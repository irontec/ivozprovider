<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromUnparsedTrunksCdr as BillableCallFromTrunksCdr;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;
use Psr\Log\LoggerInterface;

class BillableCallController
{
    use RegisterCommandTrait;

    private $billableCallFromTrunksCdr;
    private $eventPublisher;
    private $requestId;
    private $logger;

    public function __construct(
        BillableCallFromTrunksCdr $billableCallFromTrunksCdr,
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        LoggerInterface $logger
    ) {
        $this->billableCallFromTrunksCdr = $billableCallFromTrunksCdr;
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->logger = $logger;
    }

    public function indexAction()
    {
        try {
            $this->registerCommand('Scheduler', 'billableCall');
            $this->billableCallFromTrunksCdr->execute();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("BillableCall migration done!\n", 200);
    }
}
