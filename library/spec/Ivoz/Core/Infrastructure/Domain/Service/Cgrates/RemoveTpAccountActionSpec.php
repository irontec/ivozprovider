<?php

namespace spec\Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\RemoveTpAccountAction;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client as RedisClient;
use Ivoz\Core\Infrastructure\Service\JsonRpc\FakeClient;
use Graze\GuzzleHttp\JsonRpc\Message\Response;

class RemoveTpAccountActionSpec extends ObjectBehavior
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
        $this->shouldHaveType(RemoveTpAccountAction::class);
    }

    function it_does_nothing_if_company_exists(
        TpAccountActionInterface $accountAction,
        CompanyInterface $company
    ) {
        $accountAction
            ->getCompany()
            ->willReturn($company);

        $company
            ->getId()
            ->willReturn(1);

        $this
            ->jsonRpcClient
            ->request()
            ->shouldNotbeCalled();
    }

    function it_sends_remove_account_request(
        TpAccountActionInterface $accountAction
    ) {
        $accountAction
            ->getCompany()
            ->willReturn(null);

        $accountAction
            ->getTenant()
            ->willReturn('b1');

        $accountAction
            ->getAccount()
            ->willReturn('c1');

        $expectedPayload = [
            [
                "Tenant" => 'b1',
                "Account" => 'c1',
                "ReloadScheduler" => false
            ]
        ];

        $requestArguments = [
            1,
            'ApierV1.RemoveAccount',
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

        $this
            ->execute($accountAction);
    }
}
