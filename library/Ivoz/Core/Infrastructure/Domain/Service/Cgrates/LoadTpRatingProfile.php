<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\LoadTpRatingProfileInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

class LoadTpRatingProfile extends AbstractApiBasedService implements LoadTpRatingProfileInterface
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
     * @see RatingProfileServiceInterface::setRatingProfile()
     * @inheritdoc
     */
    public function execute(TpRatingProfileInterface $tpRatingProfile)
    {
        $isNotNew = !($tpRatingProfile->hasChanged('id'));
        if ($isNotNew) {
            $this->scheduleFullReload();
            return;
        }

        if ($this->isFullReloadScheduled()) {
            // Update timestamp
            $this->scheduleFullReload();
            return;
        }

        $ratingPlanLoaded = $this->isRatingPlanLoadedInMemory(
            $tpRatingProfile
        );

        if (!$ratingPlanLoaded) {
            // Inconsistent or incomplete rating profile
            return;
        }

        $activationTime = $tpRatingProfile
            ->getActivationTime()
            ->format('Y-m-d\TH:i:s\Z');

        $payload = [
            'TPid' => '',
            'LoadId' => '',
            'Direction' => '*out',
            'Tenant' => $tpRatingProfile->getTenant(),
            'Category' => 'call',
            'Subject' => $tpRatingProfile->getSubject(),
            'RatingPlanActivations' => [
                [
                    'ActivationTime' => $activationTime,
                    'RatingPlanId' => $tpRatingProfile->getRatingPlanTag(),
                    'FallbackSubjects' => '',
                    'CdrStatQueueIds' => ''
                ]
            ]
        ];

        $this->sendRequest('ApierV1.SetRatingProfile', $payload);
    }
}