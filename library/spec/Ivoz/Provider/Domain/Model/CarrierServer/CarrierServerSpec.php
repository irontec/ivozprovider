<?php

namespace spec\Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class CarrierServerSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var CarrierServerDto
     */
    protected $dto;

    function let(
        BrandInterface $brand,
        CarrierInterface $carrier
    ) {
        $this->dto = $dto = new CarrierServerDto();
        $dto->setAuthNeeded('yes');

        $carrier
            ->getId()
            ->willReturn(1);

        $carrier
            ->getBrand()
            ->willReturn($brand);

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject(),
                'carrier' => $carrier->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CarrierServer::class);
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

    function it_throws_exception_on_empty_carrier()
    {
        $dto = clone $this->dto;
        $this->hydrate(
            $dto,
            ['carrier' => null]
        );

        $exception = new \Exception('Unknown Carrier');
        $this
            ->shouldThrow($exception)
            ->during(
                'updateFromDto',
                [$dto, new \spec\DtoToEntityFakeTransformer()]
            );
    }

    function it_throws_exception_on_empty_carrier_brand(
        CarrierInterface $anotherCarrier
    ) {
        $dto = clone $this->dto;
        $this->hydrate(
            $dto,
            ['carrier' => $anotherCarrier->getWrappedObject()]
        );

        $exception = new \Exception('Unknown Brand');
        ;
        $this
            ->shouldThrow($exception)
            ->during(
                'updateFromDto',
                [$dto, new \spec\DtoToEntityFakeTransformer()]
            );
    }

    function it_sets_brand_when_not_new_and_changed_carrierId(
        CarrierInterface $newCarrier,
        BrandInterface $brand
    ) {
        $dto = clone $this->dto;

        $newCarrier
            ->getBrand()
            ->willReturn($brand);

        $this->hydrate(
            $dto,
            ['carrier' => $newCarrier->getWrappedObject()]
        );

        $this->hydrate(
            $this->getWrappedObject(),
            ['id' => 1]
        );

        $this
            ->getBrand()
            ->shouldBe($brand);
    }

    function it_resets_auth_values_when_no_auth_needed()
    {
        $dto = clone $this->dto;
        $dto
            ->setAuthNeeded('no')
            ->setAuthUser('user')
            ->setAuthPassword('password');

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );

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
