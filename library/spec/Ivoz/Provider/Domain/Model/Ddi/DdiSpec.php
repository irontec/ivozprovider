<?php

namespace spec\Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class DdiSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var DdiDto
     */
    protected $dto;

    /**
     * @var PeeringContractInterface
     */
    protected $peeringContract;

    function let(
        CountryInterface $country,
        PeeringContractInterface $peeringContract,
        BrandInterface $brand
    ) {
        $this->peeringContract = $peeringContract;

        $this->dto = $dto = new DdiDto();
        $dto
            ->setDdi('123')
            ->setRecordCalls('none')
            ->setBillInboundCalls(0);

        $this->hydrate(
            $dto,
            [
                'country' => $country->getWrappedObject(),
                'peeringContract' => $peeringContract->getWrappedObject(),
                'brand' =>  $brand->getWrappedObject()
            ]
        );

        $country
            ->getCountryCode()
            ->willReturn('34');

        $country
            ->getId()
            ->willReturn(1);

        $this->beConstructedThrough('fromDto', [$dto]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Ddi::class);
    }

    function it_throws_exception_on_invalid_ddi()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setDdi', ['$123']);

        $this
            ->shouldThrow('\Exception')
            ->during('setDdi', ['94 600 20 55']);
    }

    function it_accepts_valid_ddis()
    {
        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['946002055']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['112']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setDdi', ['999']);
    }

    function it_sets_standarized_number()
    {
        $this
            ->getDdie164()
            ->shouldBe('34123');
    }

    function it_ensures_externally_rated_when_bill_inbound_calls_is_true() {
        $dto = clone $this->dto;
        $dto
            ->setBillInboundCalls(1);

        $this
            ->peeringContract
            ->getExternallyRated()
            ->willReturn(false);

        $this
            ->peeringContract
            ->getId()
            ->willReturn(1);

        $exception = new \Exception(
            'Inbound Calls cannot be billed as PeeringContract is not externally rated',
            90000
        );

        $this
            ->shouldThrow($exception)
            ->during(
                'updateFromDto',
                [$dto]
            );
    }
}
