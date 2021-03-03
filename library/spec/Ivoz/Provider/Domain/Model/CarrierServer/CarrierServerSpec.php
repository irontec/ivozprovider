<?php

namespace spec\Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class CarrierServerSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var CarrierServerDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $brandDto = new BrandDto();
        $brand = $this->getInstance(Brand::class);

        $carrierDto = new CarrierDto();
        $carrier = $this->getterProphecy(
            $this->getTestDouble(Carrier::class, true),
            [
                'getId' => 1,
                'getBrand' => $brand,
            ],
            false
        );

        $this->dto = $dto = new CarrierServerDto();
        $dto
            ->setAuthNeeded('yes')
            ->setBrand($brandDto)
            ->setCarrier($carrierDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $brand],
            [$carrierDto, $carrier->reveal()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
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

    function it_sets_brand_when_not_new_and_changed_carrierId(
        CarrierInterface $newCarrier
    ) {
        $brand = $this->getInstance(
            Brand::class
        );

        $newCarrierDto = new CarrierDto();
        $newCarrier = $this->getterProphecy(
            $this->getTestDouble(
                Carrier::class,
                true
            ),
            [
                'getId' => 1,
                'getBrand' => $brand,
            ],
            true
        );

        $this
            ->dto
            ->setCarrier($newCarrierDto);

        $this
            ->transformer
            ->appendFixedTransforms([
                [$newCarrierDto, $newCarrier->reveal()]
            ]);

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
            $this->transformer
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
            ->shouldBe(489);
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
