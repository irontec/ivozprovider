<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\RecoderJobInterface;
use Psr\Log\LoggerInterface;

class Recoder implements RecoderJobInterface
{
    private $redisMasterFactory;
    private $redisDb;
    private $logger;

    private $id;
    private $entityName;

    public function __construct(
        RedisMasterFactory $redisMasterFactory,
        int $redisDb,
        LoggerInterface $logger
    ) {
        $this->redisMasterFactory = $redisMasterFactory;
        $this->redisDb = $redisDb;
        $this->logger = $logger;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setEntityName($entityName): self
    {
        $this->entityName = $entityName;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEntityName(): string
    {
        return $this->entityName;
    }

    public function send(): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $data = [
                'id' => $this->id,
                'entityName' => $this->entityName
            ];

            $redisClient->rPush(
                self::CHANNEL,
                \json_encode($data)
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
