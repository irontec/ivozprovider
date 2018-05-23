<?php

namespace Ivoz\Cgr\Domain\Service\RatingPlan;

use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class UpdatedRatingPlanNotificator implements RatingPlanLifecycleEventHandlerInterface
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

    public function execute(RatingPlanInterface $entity)
    {
        $wasDeleted = is_null($entity->getId());
        if (!$wasDeleted) {
            return;
        }

        $this->client->scheduleFullReload();
    }
}