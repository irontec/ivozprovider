<?php

namespace Worker;

use Ivoz\Ast\Domain\Job\AriDialplanReloadJobInterface;
use Ivoz\Ast\Infrastructure\Asterisk\ARI\ARIConnector;
use Ivoz\Core\Application\RegisterCommandTrait;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;

class AsteriskDialplan
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private ARIConnector $ariConnector,
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function reload(): Response
    {
        try {
            $this->registerCommand('Worker', 'asterisk::dialplanReload');

            $this->waitForChannelTrigger(
                AriDialplanReloadJobInterface::CHANNEL
            );

            $this
                ->ariConnector
                ->sendDialplanReloadRequest();
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        }

        return new Response('');
    }

    private function waitForChannelTrigger(string $channel): void
    {
        $redisMaster = $this
            ->redisMasterFactory
            ->create(
                $this->redisDb
            );

        try {
            $timeoutSeconds = 60 * 60;
            $redisMaster->blPop(
                [$channel],
                $timeoutSeconds
            );
        } catch (\RedisException $e) {
            $this->logger->error('Asterisk worker timeout: ' . $e->getMessage());
            exit(1);
        }
    }
}
