<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class UpdatedTpDestinationNotificator implements TpDestinationLifecycleEventHandlerInterface
{
    private $client;

    public function __construct(RedisClient $client)
    {
        $this->client = $client;
    }

    public function execute(TpDestinationInterface $entity)
    {
        $this->client->scheduleFullReload();
    }
}