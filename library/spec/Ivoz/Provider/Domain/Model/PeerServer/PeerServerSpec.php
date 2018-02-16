<?php

namespace spec\Ivoz\Provider\Domain\Model\PeerServer;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServer;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class PeerServerSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var PeerServerDto
     */
    protected $dto;

    function let(
        BrandInterface $brand,
        PeeringContractInterface $peeringContract
    ) {
        $this->dto = $dto = new PeerServerDto();
        $dto->setAuthNeeded('yes');

        $peeringContract
            ->getId()
            ->willReturn(1);

        $peeringContract
            ->getBrand()
            ->willReturn($brand);

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject(),
                'peeringContract' => $peeringContract->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PeerServer::class);
    }

    function it_throws_exception_on_invalid_ip()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setIp', ['300.127.127.14']);

        $this
            ->shouldThrow('\Exception')
            ->during('setIp', ['aa:bb:cc:dd:ee:ff']);
    }

    function it_accepts_valid_ip()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['80.127.127.14']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['127.0.0.1']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['0.0.0.0']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['2001:db8:a0b:12f0::1']);
    }

    function it_throws_exception_on_invalid_params()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setParams', ['Something']);

        $this
            ->shouldThrow('\Exception')
            ->during('setParams', ['Something wrong']);

        $this
            ->shouldThrow('\Exception')
            ->during('setParams', [';']);
    }

    function it_accepts_valid_params()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setParams', [';somethingRight']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setParams', [null]);
    }

    function it_throws_exception_on_empty_peering_contract()
    {
        $dto = clone $this->dto;
        $this->hydrate(
            $dto,
            ['peeringContract' => null]
        );

        $exception = new \Exception('Unknown PeeringContract');
        $this
            ->shouldThrow($exception)
            ->during('updateFromDto', [$dto]);
    }

    function it_throws_exception_on_empty_peering_contract_brand(
        PeeringContractInterface $anotherPeeringContract
    ) {
        $dto = clone $this->dto;
        $this->hydrate(
            $dto,
            ['peeringContract' => $anotherPeeringContract->getWrappedObject()]
        );

        $exception = new \Exception('Unknown Brand');;
        $this
            ->shouldThrow($exception)
            ->during('updateFromDto', [$dto]);
    }

    function it_sets_brand_when_not_new_and_changed_peeringContractId(
        PeeringContractInterface $newPeeringContract,
        BrandInterface $brand
    ) {
        $dto = clone $this->dto;

        $newPeeringContract
            ->getBrand()
            ->willReturn($brand);

        $this->hydrate(
            $dto,
            ['peeringContract' => $newPeeringContract->getWrappedObject()]
        );

        $this->hydrate(
            $this->getWrappedObject(),
            ['id' => 1]
        );

        $this
            ->getbrand()
            ->shouldBe($brand);
    }

    function it_resets_auth_values_when_no_auth_needed()
    {
        $dto = clone $this->dto;
        $dto
            ->setAuthNeeded('no')
            ->setAuthUser('user')
            ->setAuthPassword('password');

        $this->updateFromDto($dto);

        $this
            ->getAuthUser()
            ->shouldBe(null);
        $this
            ->getAuthPassword()
            ->shouldBe(null);
    }

    function it_sets_proxy_values_by_sip_proxy()
    {
        $this
            ->dto
            ->setSipProxy('myhost.net:489');

        $this
            ->getHostname()
            ->shouldBe('myhost.net');

        $this
            ->getIp()
            ->shouldBe(null);

        $this
            ->getPort()
            ->shouldBe('489');
    }

    function it_sets_proxy_values_by_outbound_proxy()
    {
        $this
            ->dto
            ->setSipProxy('myhost.net')
            ->setOutboundProxy('127.2.3.4');

        $this
            ->getHostname()
            ->shouldBe('myhost.net');

        $this
            ->getIp()
            ->shouldBe('127.2.3.4');

        $this
            ->getPort()
            ->shouldBe(5060);
    }
}

