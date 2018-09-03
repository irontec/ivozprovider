<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\RemoveTpRatingProfileInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class RemoveTpRatingProfile extends AbstractApiBasedService implements RemoveTpRatingProfileInterface
{
    /**
     * TpAccountActionService constructor.
     * @param ClientInterface $client
     * @param RedisClient $redisClient
     */
    public function __construct(
        ClientInterface $jsonRpcClient,
        RedisClient $redisClient
    ) {
        parent::__construct(...func_get_args());
    }

    /**
     * @see RatingProfileServiceInterface::removeRatingProfile()
     * @inheritdoc
     */
    public function execute(TpRatingProfileInterface $tpRatingProfile)
    {
        $ratingProfile = $tpRatingProfile->getRatingProfile();
        $ratingProfileWasRemoved = is_null($ratingProfile) || is_null($ratingProfile->getId());

        if (!$ratingProfileWasRemoved) {
            $this->redisClient->scheduleFullReload();
            return;
        }

        if ($this->isFullReloadScheduled()) {
            // Update timestamp
            $this->redisClient->scheduleFullReload();
            return;
        }

        $ratingPlanLoaded = $this->isRatingPlanLoadedInMemory(
            $tpRatingProfile
        );

        if (!$ratingPlanLoaded) {
            // Inconsistent or incomplete rating profile
            return;
        }

        $payload = [
            'Direction' => '*out',
            'Tenant' => $tpRatingProfile->getTenant(),
            'Category' => 'call',
            'Subject' => $tpRatingProfile->getSubject()
        ];

        $this->sendRequest('ApierV1.RemoveRatingProfile', $payload);
    }
}
