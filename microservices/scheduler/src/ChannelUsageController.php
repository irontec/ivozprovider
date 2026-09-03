<?php

use Ivoz\Core\Domain\RegisterCommandTrait;
use Ivoz\Core\Domain\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Domain\Service\ChannelUsage\CollectChannelUsage;
use Ivoz\Provider\Domain\Service\ChannelUsage\PurgeOldChannelUsage;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class ChannelUsageController
{
    use RegisterCommandTrait;

    public function __construct(
        private CollectChannelUsage $collectChannelUsage,
        private PurgeOldChannelUsage $purgeOldChannelUsage,
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

        // Retention runs after collection and never blocks it: a purge failure must not
        // cost us the buckets we have just collected.
        try {
            $this->purgeOldChannelUsage->execute();
        } catch (\Exception $e) {
            $this->logger->error(
                'ChannelUsage purge failed: ' . $e->getMessage()
            );
        }

        return new Response("ChannelUsage collection done!\n", 200);
    }
}
