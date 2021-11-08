<?php

namespace Controller;

use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Service\Carrier\SyncBalances as SyncCarrierBalances;
use Ivoz\Provider\Domain\Service\Company\SyncBalances;
use Symfony\Component\HttpFoundation\Response;

class Sync
{
    use RegisterCommandTrait;

    /** @var DomainEventPublisher */
    protected $eventPublisher;
    /** @var RequestId */
    protected $requestId;

    protected $syncBalances;
    protected $syncCarrierBalances;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        SyncBalances $syncBalances,
        SyncCarrierBalances $syncCarrierBalances
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->syncBalances = $syncBalances;
        $this->syncCarrierBalances = $syncCarrierBalances;
    }

    public function index(): Response
    {
        $this->registerCommand('sync');

        $this
            ->syncBalances
            ->updateAll();

        $this
            ->syncCarrierBalances
            ->updateAll();

        return new Response("Company and carrier balances updated successfully!\n");
    }
}
