<?php

namespace Ivoz\Provider\Domain\Service\DestinationRateGroup;

use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

class UpdatedDestinationRateGroupNotificator implements DestinationRateGroupLifecycleEventHandlerInterface
{
    /**
     * @var RedisClient
     */
    private $client;

    /**
     * UpdatedDestinationRateGroupNotificator constructor.
     * @param RedisClient $client
     */
    public function __construct(RedisClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 20
        ];
    }

    /**
     * @param DestinationRateGroupInterface $entity
     */
    public function execute(DestinationRateGroupInterface $entity)
    {
        $wasDeleted = is_null($entity->getId());
        if (!$wasDeleted) {
            return;
        }

        $this->client->scheduleFullReload();
    }
}