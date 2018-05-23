<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class UpdatedTpRatingPlanNotificator implements TpRatingPlanLifecycleEventHandlerInterface
{
    private $client;

    public function __construct(RedisClient $client)
    {
        $this->client = $client;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(TpRatingPlanInterface $entity)
    {
        $this->client->scheduleFullReload();
    }
}