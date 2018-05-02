<?php

namespace spec\Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\RemoveTpRatingProfile;
use Ivoz\Core\Infrastructure\Service\JsonRpc\FakeClient;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;
use Graze\GuzzleHttp\JsonRpc\Message\Response;

class RemoveTpRatingProfileSpec extends ObjectBehavior
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
        $this->shouldHaveType(RemoveTpRatingProfile::class);
    }

    function it_schedules_full_reload_if_company_was_not_removed(
        TpRatingProfileInterface $tpRatingProfile,
        CompanyInterface $company
    ) {
        $tpRatingProfile
            ->getCompany()
            ->willReturn($company);

        $company
            ->getId()
            ->willReturn(1);

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
            ->getCompany()
            ->willReturn(null);

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
            ->getCompany()
            ->willReturn(null);

        $tpRatingProfile
            ->getRatingPlanTag()
            ->willReturn('b1rp1');

        $this
            ->redisClient
            ->isFullReloadScheduled()
            ->shouldBeCalled()
            ->willReturn(false);

        $this
            ->redisClient
            ->exists(
                RemoveTpRatingProfile::RATING_PLAN_PREFIX
                . 'b1rp1'
            )
        ->willReturn(false);

        $this->execute($tpRatingProfile);
    }

    function it_calls_removeRatingProfile_api_method(
        TpRatingProfileInterface $tpRatingProfile
    ) {
        $tpRatingProfile
            ->getCompany()
            ->willReturn(null);

        $tpRatingProfile
            ->getRatingPlanTag()
            ->willReturn('b1rp1');

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
            ->exists(
                RemoveTpRatingProfile::RATING_PLAN_PREFIX
                . 'b1rp1'
            )
            ->willReturn(true);

        $expectedPayload = [
            [
                'Direction' => '*out',
                'Tenant' => 'b1',
                'Category' => 'call',
                'Subject' => 'c1'
            ]
        ];

        $requestArguments = [
            1,
            'ApierV1.RemoveRatingProfile',
            $expectedPayload
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
