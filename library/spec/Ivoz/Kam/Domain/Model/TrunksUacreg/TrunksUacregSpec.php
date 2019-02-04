<?php

namespace spec\Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class TrunksUacregSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    function let(
        BrandInterface $brand,
        DdiProviderRegistrationInterface $ddiProviderRegistration
    ) {


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
            ->setRegDelay(1);

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject(),
                'ddiProviderRegistration' => $ddiProviderRegistration->getWrappedObject()
            ]
        );

        $brand
            ->getId()
            ->willReturn(1);

        $ddiProviderRegistration
            ->getId()
            ->willReturn(1);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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
