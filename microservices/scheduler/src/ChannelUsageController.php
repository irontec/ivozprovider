<?php

use Ivoz\Core\Domain\RegisterCommandTrait;
use Ivoz\Core\Domain\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Service\ChannelUsage\CollectChannelUsage;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class ChannelUsageController
{
    use RegisterCommandTrait;

    public function __construct(
        private CollectChannelUsage $collectChannelUsage,
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
            $this->registerCommand('Scheduler', 'channelUsage');
            $this->collectChannelUsage->execute();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("ChannelUsage collection done!\n", 200);
    }
}
