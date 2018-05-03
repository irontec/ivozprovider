<?php

namespace Ivoz\Cgr\Domain\Service\DestinationRate;

use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class UpdatedDestinationRateNotificator implements DestinationRateLifecycleEventHandlerInterface
{
    private $client;

    public function __construct(RedisClient $client)
    {
        $this->client = $client;
    }

    public function execute(DestinationRateInterface $entity)
    {
        $wasDeleted = is_null($entity->getId());
        if (!$wasDeleted) {
            return;
        }

        $this->client->scheduleFullReload();
    }
}