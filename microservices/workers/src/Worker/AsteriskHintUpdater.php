<?php

namespace Worker;

use Ivoz\Ast\Domain\Job\AriHintUpdateJobInterface;
use Ivoz\Ast\Infrastructure\Asterisk\ARI\ARIConnector;
use Ivoz\Core\Application\RegisterCommandTrait;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;

class AsteriskHintUpdater
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private ARIConnector $ariConnector,
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private int $redisTimeout,
        private LoggerInterface $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;

        ini_set('default_socket_timeout', (string) $redisTimeout);
    }

    public function send(): Response
    {
        try {
            $this->registerCommand('Worker', 'asterisk::hintUpdate');

            $job = $this->getJobPayload(
                AriHintUpdateJobInterface::CHANNEL
            );

            $this
                ->ariConnector
                ->sendHintUpdateRequest(
                    $job['deviceName'],
                    $job['deviceState'],
                );
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        }

        return new Response('');
    }

    /**
     * @param string $channel
     * @return array<array-key, string>
     */
    private function getJobPayload(string $channel): array
    {
        $redisMaster = $this
            ->redisMasterFactory
            ->create(
                $this->redisDb
            );

        try {
            $response = $redisMaster->blPop(
                [$channel],
                $this->redisTimeout
            );

            $data = end($response);

            /** @var array<array-key, string> $resp */
            $resp = \json_decode($data, true);
            return $resp;
        } catch (\RedisException $e) {
            $this->logger->error('Asterisk worker timeout: ' . $e->getMessage());
            exit(1);
        }
    }
}
