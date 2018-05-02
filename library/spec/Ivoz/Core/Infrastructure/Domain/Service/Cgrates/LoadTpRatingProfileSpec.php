<?php

namespace spec\Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\AbstractApiBasedService;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\LoadTpRatingProfile;
use Ivoz\Core\Infrastructure\Service\JsonRpc\FakeClient;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;
use Graze\GuzzleHttp\JsonRpc\Message\Response;

class LoadTpRatingProfileSpec extends ObjectBehavior
{
    /**
     * @var ClientInterface
     */
    protected $jsonRpcClient;

    /**
     * @var FakeClient
     */
    protected $fakeClient;

    /**
     * @var RedisClient
     */
    protected $redisClient;

    function let(
        ClientInterface $jsonRpcClient,
        RedisClient $redisClient
    ) {
        $this->jsonRpcClient = $jsonRpcClient;
        $this->fakeClient = new FakeClient();
        $this->redisClient = $redisClient;

        $this->beConstructedWith(
            $this->jsonRpcClient,
            $this->redisClient
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LoadTpRatingProfile::class);
    }

    function it_schedules_full_reload_if_company_entity_is_not_new(
        TpRatingProfileInterface $tpRatingProfile
    ) {
        $tpRatingProfile
            ->hasChanged('id')
            ->willReturn(false);

        $this
            ->redisClient
            ->scheduleFullReload()
            ->shouldBeCalled();

        $this->execute($tpRatingProfile);
    }

    function it_checks_whether_full_reload_is_already_set_and_updates_the_timestamp_if_so(
        TpRatingProfileInterface $tpRatingProfile
    ) {
        $tpRatingProfile
            ->hasChanged('id')
            ->willReturn(true);

        $this
            ->redisClient
            ->isFullReloadScheduled()
            ->shouldBeCalled()
            ->willReturn(true);

        $this
            ->redisClient
            ->scheduleFullReload()
            ->shouldBeCalled();

        $this->execute($tpRatingProfile);
    }

    function it_checks_whether_rating_plan_is_loaded_in_memory(
        TpRatingProfileInterface $tpRatingProfile
    ) {
        $tpRatingProfile
            ->getRatingPlanTag()
            ->willReturn('SomeTag');

        $tpRatingProfile
            ->hasChanged('id')
            ->willReturn(true);

        $this
            ->redisClient
            ->isFullReloadScheduled()
            ->shouldBeCalled()
            ->willReturn(false);

        $this
            ->redisClient
            ->isFullReloadScheduled()
            ->shouldBeCalled()
            ->willReturn(false);

        $this
            ->redisClient
            ->exists(
                AbstractApiBasedService::RATING_PLAN_PREFIX
                . 'SomeTag'
            )
            ->shouldBeCalled()
            ->willReturn(false);

        $this->execute($tpRatingProfile);
    }

    function it_calls_setRatingProfile_api_method(
        TpRatingProfileInterface $tpRatingProfile
    ) {
        $tpRatingProfile
            ->hasChanged('id')
            ->willReturn(true);

        $tpRatingProfile
            ->getRatingPlanTag()
            ->willReturn('SomeTag');

        $tpRatingProfile
            ->getActivationTime()
            ->willReturn(
                new \DateTime(
                    '2018-01-01 10:00:00',
                    new \DateTimeZone('utc')
                )
            );

        $tpRatingProfile
            ->getTenant()
            ->willReturn('b1');

        $tpRatingProfile
            ->getSubject()
            ->willReturn('c1');

        $this
            ->redisClient
            ->isFullReloadScheduled()
            ->shouldBeCalled()
            ->willReturn(false);

        $this
            ->redisClient
            ->isFullReloadScheduled()
            ->shouldBeCalled()
            ->willReturn(false);

        $this
            ->redisClient
            ->exists(
                AbstractApiBasedService::RATING_PLAN_PREFIX
                . 'SomeTag'
            )
            ->shouldBeCalled()
            ->willReturn(true);

        $expectedPayload = [
            'TPid' => '',
            'LoadId' => '',
            'Direction' => '*out',
            'Tenant' => 'b1',
            'Category' => 'call',
            'Subject' => 'c1',
            'RatingPlanActivations' => [
                [
                    'ActivationTime' => '2018-01-01T10:00:00Z',
                    'RatingPlanId' => 'SomeTag',
                    'FallbackSubjects' => '',
                    'CdrStatQueueIds' => ''
                ]
            ]
        ];

        $requestArguments = [
            1,
            'ApierV1.SetRatingProfile',
            [$expectedPayload]
        ];

        $requestObject = $this->fakeClient->request(...$requestArguments);
        $this
            ->jsonRpcClient
            ->request(...$requestArguments)
            ->shouldBeCalled()
            ->willReturn($requestObject);

        $this
            ->jsonRpcClient
            ->send($requestObject)
            ->shouldBeCalled()
            ->willReturn(
                new Response(200, [], '{"error": null}')
            );

        $this->execute($tpRatingProfile);
    }
}
