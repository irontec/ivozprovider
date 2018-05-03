<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class UpdatedTpRateNotificator implements TpRateLifecycleEventHandlerInterface
{
    private $client;

    public function __construct(RedisClient $client)
    {
        $this->client = $client;
    }

    public function execute(TpRateInterface $entity)
    {
        $this->client->scheduleFullReload();
    }
}