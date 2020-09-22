<?php

namespace Controller;

use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Services\ResetDailyUsageCounters;
use Symfony\Component\HttpFoundation\Response;

class ResetCounter
{
    use RegisterCommandTrait;

    /** @var DomainEventPublisher */
    protected $eventPublisher;
    /** @var RequestId */
    protected $requestId;

    protected $resetDailyUsageCounters;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        ResetDailyUsageCounters $resetDailyUsageCounters

    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->resetDailyUsageCounters = $resetDailyUsageCounters;
    }

    public function index()
    {
        $this->registerCommand('reset-counter');

        $this
            ->resetDailyUsageCounters
            ->execute();

        return new Response("Company daily usage counters reset successfully!\n");
    }

}
