<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
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

    public function execute(RatingPlanInterface $ratingPlan)
    {
        $wasDeleted = is_null($ratingPlan->getId());
        if (!$wasDeleted) {
            return;
        }

        $this->client->scheduleFullReload();
    }
}