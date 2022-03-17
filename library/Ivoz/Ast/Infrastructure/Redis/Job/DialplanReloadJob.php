<?php

namespace Ivoz\Ast\Infrastructure\Redis\Job;

use Ivoz\Ast\Domain\Job\AriJobInterface;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Psr\Log\LoggerInterface;

class DialplanReloadJob implements AriJobInterface
{
    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger,
    ) {
    }

    public function send(): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $data = [];

            $redisClient->rPush(
                self::CHANNEL,
                \json_encode($data, JSON_THROW_ON_ERROR)
            );

            $redisClient->close();
        } catch (\Exception $e) {
            $this
                ->logger
                ->error(
                    $e->getMessage()
                );

            throw $e;
        }
    }
}
