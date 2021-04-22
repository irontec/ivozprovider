<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\InvoicerJobInterface;
use Psr\Log\LoggerInterface;

class Invoicer implements InvoicerJobInterface
{
    private $redisMasterFactory;
    private $redisDb;
    private $logger;
    private $id;

    public function __construct(
        RedisMasterFactory $redisMasterFactory,
        int $redisDb,
        LoggerInterface $logger
    ) {
        $this->redisMasterFactory = $redisMasterFactory;
        $this->redisDb = $redisDb;
        $this->logger = $logger;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function send(): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $redisClient->rPush(
                self::CHANNEL,
                $this->getId()
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
