<?php

namespace spec\Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class TrunksUacregSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $brandDto = new BrandDto();
        $brand = $this->getTestDouble(Brand::class);
        $brand
            ->getId()
            ->willReturn(1);

        $ddiProviderRegistrationDto = new DdiProviderRegistrationDto();
        $ddiProviderRegistration = $this->getTestDouble(DdiProviderRegistration::class);
        $ddiProviderRegistration
            ->getId()
            ->willReturn(1);

        $this->dto = $dto = new TrunksUacregDto();
        $dto->setLUuid('')
            ->setLUsername('')
            ->setLDomain('')
            ->setRUsername('')
            ->setRDomain('')
            ->setRealm('')
            ->setAuthUsername('')
            ->setAuthPassword('')
            ->setAuthProxy('sips:127.0.0.1')
            ->setExpires(1)
            ->setFlags(1)
            ->setRegDelay(1)
            ->setBrand($brandDto)
            ->setDdiProviderRegistration($ddiProviderRegistrationDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $brand->reveal()],
            [$ddiProviderRegistrationDto, $ddiProviderRegistration->reveal()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TrunksUacreg::class);
    }

    function it_throws_exception_on_invalid_authproxy()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setAuthProxy', ['127.0.0.1']);

        $this
            ->shouldThrow('\Exception')
            ->during('setAuthProxy', ['google.es']);

        $this
            ->shouldThrow('\Exception')
            ->during('setAuthProxy', ['sip:']);
    }

    function it_accepts_valid_authproxy()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setAuthProxy', ['sip:8.8.8.8']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setAuthProxy', ['sips:8.8.8.8']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setAuthProxy', ['sips:google.es']);
    }
}
