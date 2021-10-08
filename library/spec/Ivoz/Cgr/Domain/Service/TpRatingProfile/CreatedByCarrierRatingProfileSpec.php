<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Service\TpRatingProfile\CreatedByCarrierRatingProfile;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\CreatedByOutgoingRoutingRelCarrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class CreatedByCarrierRatingProfileSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $createByOutgoingRoutingRelCarrier;
    protected $ratingProfile;
    protected $carrier;
    protected $outgoingRoutingRelCarrier;

    public function let()
    {
        $this->createByOutgoingRoutingRelCarrier = $this->getTestDouble(
            CreatedByOutgoingRoutingRelCarrier::class,
            true
        );

        $this->beConstructedWith(
            $this->createByOutgoingRoutingRelCarrier
        );
    }

    protected function prepareExecution()
    {
        $this->ratingProfile = $this->getTestDouble(
            RatingProfileInterface::class,
            true
        );

        $this->carrier = $this->getTestDouble(
            CarrierInterface::class,
            true
        );

        $this->outgoingRoutingRelCarrier = $this->getTestDouble(
            OutgoingRoutingRelCarrierInterface::class,
            true
        );

        $this->getterProphecy(
            $this->ratingProfile,
            [
                'getCarrier' => $this->carrier
            ],
            false
        );

        $this
            ->resetProphecies(
                $this->carrier,
                'getOutgoingRoutingsRelCarriers'
            );

        $this->getterProphecy(
            $this->carrier,
            [
                'getOutgoingRoutingsRelCarriers' => [$this->outgoingRoutingRelCarrier]
            ],
            false
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreatedByCarrierRatingProfile::class);
    }

    function it_does_nothing_without_carrier()
    {
        $this->prepareExecution();

        $this
            ->ratingProfile
            ->getCarrier()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->carrier
            ->getOutgoingRoutingsRelCarriers()
            ->shouldNotBeCalled();

        $this->execute($this->ratingProfile);
    }

    function it_fetches_carrier_rel_outgoingRoutings()
    {
        $this->prepareExecution();

        $this
            ->carrier
            ->getOutgoingRoutingsRelCarriers()
            ->willReturn([])
            ->shouldBeCalled();

        $this->execute($this->ratingProfile);
    }

    function it_calls_createByOutgoingRoutingRelCarrier_collaborator()
    {
        $this->prepareExecution();

        $this
            ->createByOutgoingRoutingRelCarrier
            ->execute($this->outgoingRoutingRelCarrier)
            ->shouldBeCalled();

        $this->execute($this->ratingProfile);
    }
}
