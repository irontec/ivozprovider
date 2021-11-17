<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\RatesImporterJobInterface;
use Psr\Log\LoggerInterface;

class RatesImporter implements RatesImporterJobInterface
{
    /** @var array<array-key, string|int> */
    private $params = [];

    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param array<array-key, string|int> $params
     */
    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function send(): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $redisClient->rPush(
                self::CHANNEL,
                \json_encode($this->params, JSON_THROW_ON_ERROR)
            );

            $redisClient->close();
        } catch (\Exception $e) {
            $this
                ->logger
                ->error(
                    $e->getMessage()
                );
        }
    }
}
