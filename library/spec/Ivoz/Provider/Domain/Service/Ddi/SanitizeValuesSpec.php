<?php

namespace spec\Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use Ivoz\Provider\Domain\Service\Ddi\SanitizeValues;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SanitizeValuesSpec extends ObjectBehavior
{
    /**
     * @var DdiInterface
     */
    protected $entity;

    /**
     * @var CountryInterface
     */
    protected $country;

    function let(
        DdiInterface $entity,
        CountryInterface $country
    ) {
        $this->entity = $entity;
        $this
            ->entity
            ->getDdi()
            ->willReturn('123456');

        $this->country = $country;
        $this
            ->country
            ->getCallingCode()
            ->willReturn(34);

        $this
            ->entity
            ->getCountry()
            ->willReturn($this->country);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SanitizeValues::class);
    }

    function it_sets_standarized_number()
    {
        $this
            ->entity
            ->setDdie164('34123456')
            ->shouldBeCalled();

        $this
            ->entity
            ->getBillInboundCalls()
            ->willReturn(false);

        $this->execute($this->entity, true);
    }

    function it_ensures_externally_rated_when_bill_inbound_calls_is_true(
        PeeringContractInterface $peeringContract
    ) {
        $this
            ->entity
            ->setDdie164(Argument::any())
            ->shouldBeCalled();

        $this
            ->entity
            ->getBillInboundCalls()
            ->willReturn(true);

        $peeringContract
            ->getExternallyRated()
            ->willReturn(false);

        $this
            ->entity
            ->getPeeringContract()
            ->willReturn($peeringContract);

        $message = 'Inbound Calls cannot be billed as PeeringContract is not externally rated';
        $exception = new \Exception($message, 90000);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, true]);
    }
}
