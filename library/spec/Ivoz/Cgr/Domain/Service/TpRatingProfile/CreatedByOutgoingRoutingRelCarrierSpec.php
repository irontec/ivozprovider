<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\CreatedByOutgoingRoutingRelCarrier;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CreatedByOutgoingRoutingRelCarrierSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $outgoingRoutingRelCarrier;
    protected $carrier;
    protected $outgoingRouting;
    protected $ratingProfile;
    protected $carrierTpRatingProfile;
    protected $outgoingRoutingTpRatingProfile;
    protected $lcrTpRatingProfileDto;

    public function let()
    {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class
        );

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    protected function prepareExecution()
    {
        $this->outgoingRoutingRelCarrier = $this->getTestDouble(
            OutgoingRoutingRelCarrierInterface::class,
            false
        );

        $this->carrier = $this->getTestDouble(
            CarrierInterface::class,
            false
        );

        $this->outgoingRouting = $this->getTestDouble(
            OutgoingRoutingInterface::class,
            false
        );

        $this->ratingProfile = $this->getTestDouble(
            RatingProfileInterface::class,
            false
        );

        $this->carrierTpRatingProfile = $this->getTestDouble(
            TpRatingProfileInterface::class,
            false
        );

        $this->outgoingRoutingTpRatingProfile = $this->getTestDouble(
            TpRatingProfileInterface::class,
            false
        );

        $this->lcrTpRatingProfileDto = $this->getTestDouble(
            TpRatingProfileDto::class,
            false
        );

        $this->getterProphecy(
            $this->outgoingRoutingRelCarrier,
            [
                'getCarrier' => $this->carrier,
                'getOutgoingRouting' => $this->outgoingRouting,
                'getTpRatingProfiles' => $this->ratingProfile,
                'getTpRatingProfiles' => function () {
                    return [
                        [Argument::any()],
                        [$this->outgoingRoutingTpRatingProfile]
                    ];
                },
                'getId' => 1
            ],
            false
        );

        $this->getterProphecy(
            $this->carrier,
            [
                  'getRatingProfiles' => [$this->ratingProfile]
              ],
            false
        );

        $this->getterProphecy(
            $this->ratingProfile,
            [
                'getCgrRatingProfile' => $this->carrierTpRatingProfile,
                'getId' => 1
            ],
            false
        );

        $this->getterProphecy(
            $this->carrierTpRatingProfile,
            [
                'getTpid' => 'b1',
                'getTenant' => 'b1',
                'getSubject' => 'c1',
                'getActivationTime' => '2019-01-02 23:00:00',
                'getRatingPlanTag' => 'b1rp1',
            ],
            false
        );

        $this->getterProphecy(
            $this->outgoingRouting,
            [
                'getCgrRpCategory' => 'lcr_profile1'
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->lcrTpRatingProfileDto,
            [
                'setTpid' => Argument::any(),
                'setTenant' => Argument::any(),
                'setCategory' => Argument::any(),
                'setSubject' => Argument::any(),
                'setActivationTime' => Argument::any(),
                'setRatingPlanTag' => Argument::any(),
                'setRatingProfileId' => Argument::any(),
                'setOutgoingRoutingRelCarrierId' => Argument::any(),
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto(
                $this->outgoingRoutingTpRatingProfile
            )
            ->willReturn(
                $this->lcrTpRatingProfileDto
            );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            CreatedByOutgoingRoutingRelCarrier::class
        );
    }

    function it_creates_tpRatingProfile()
    {
        $this->prepareExecution();

        $this->entityTools
            ->persistDto(
                $this->lcrTpRatingProfileDto,
                $this->outgoingRoutingTpRatingProfile,
                false
            )
            ->shouldBeCalled();

        $this->execute(
            $this->outgoingRoutingRelCarrier
        );
    }
}
