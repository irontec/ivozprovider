<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;

abstract class AbstractApiBasedService
{
    const RATING_PLAN_PREFIX = 'rpl_';

    /**
     * @var ClientInterface
     */
    protected $jsonRpcClient;

    /**
     * @var RedisClient
     */
    protected $redisClient;

    public function __construct(
        ClientInterface $jsonRpcClient,
        RedisClient $redisClient
    ) {
        $this->jsonRpcClient = $jsonRpcClient;
        $this->redisClient = $redisClient;
    }

    protected function scheduleFullReload()
    {
        return $this->redisClient->scheduleFullReload();
    }

    protected function isFullReloadScheduled()
    {
        return $this->redisClient->isFullReloadScheduled();
    }

    /**
     * @param $payload
     * @throws \DomainException
     * @return void
     * @throws \DomainException
     */
    protected function sendRequest($method, array $payload)
    {
        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Request $request */
        $request = $this->jsonRpcClient
            ->request(
                1,
                $method,
                [$payload]
            );

        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $response */
        $response = $this->jsonRpcClient->send($request);
        $stringResponse = $response->getBody()->__toString();
        $objectResponse = json_decode($stringResponse);

        if ($objectResponse->error) {
            $errorMsg = sprintf(
                'CgRates API error response:  %s',
                $objectResponse->error
            );
            throw new \RuntimeException($errorMsg);
        }
    }

    /**
     * @param TpRatingProfileInterface $tpRatingProfile
     * @return bool
     */
    protected function isRatingPlanLoadedInMemory(TpRatingProfileInterface $tpRatingProfile): bool
    {
        return $this->redisClient->exists(
            self::RATING_PLAN_PREFIX
            . $tpRatingProfile->getRatingPlanTag()
        );
    }
}
